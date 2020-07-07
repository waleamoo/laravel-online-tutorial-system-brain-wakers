<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Comment;
use App\Course;
use App\Enrollment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\User;
use App\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use \Validator;

class HomeController extends Controller
{
    public function pagenotfound(){
        return view('errors.503');
    }

    public function index(){
        return view('user.index');
    }

    // function for search autocomplete feature 
    public function autocomplete(Request $request){
        $data = Subject::select("subject_name as name")->where("subject_name", "LIKE", "%{$request->input('search')}%")->get();
        return response()->json($data);
    }

    // function to process search 
    public function getSearchCourse(Request $request){
        if(!empty($request->input('search'))){
            $search = $request->input('search');
            // join the subject and users table 
            $courses = DB::table('subjects')->join('courses', 'courses.subject_id', '=', 'subjects.id')
            ->where("subject_name", "LIKE", "%$search%")
            ->get();

            return view('user.search', ['courses' => $courses]);
        }
    }

    public function getCourses(){
        // fetch the user courses or enrollment 
        //$courses = DB::table('enrollments')->where('user_id', Auth::id())->value('course_id');
        $courses = DB::table('subjects')
        ->join('courses', 'courses.subject_id', '=', 'subjects.id')
        ->join('enrollments', 'enrollments.course_id', '=', 'courses.id')
        ->where('user_id', Auth::id())->get();

        return view('user.course', ['courses' => $courses]);
    }

    public function getClassRoom($id){
        // pass the comments 
        $comments = Comment::where('lecture_id', $id)->get(); // find the lecture id comment 
        return view('user.classroom', [
            'comments' => $comments, 'lecture_id' => $id
        ]);
    }
    
    public function getCart(){
        if(!Session::has('cart')){
            return view('user.cart');
        }

        // if there is a cart 
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('user.cart', ['courses' => $cart->items, 'totalPrice' => $cart->totalPrice]);

        return view('user.cart');
    }

    // function to get course details 
    public function getCourseDetails($id){
        $course = Course::find($id); 
        $subject_name = Subject::find($course->id)->value('subject_name'); // get the subject name of the course 

        $benefits = $course->benefits;
        $benefits = explode("|", $benefits);

        $topics = $course->topics;
        $topics = explode('|', $topics);

        return view('user.course-details', ['course' => $course, 'benefits' => $benefits, 'topics' => $topics, 'subject_name' => $subject_name]);

    }

    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('user.index');
    }

    // function to add course to cart 
    public function getAddToCart(Request $request, $id){
        $course = Course::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        // if the cart has the item id 
        //if($request->session()->get('cart', $course->id)){
            //return redirect()->back()->with('error', 'Course already in cart.');
        //}
        // otherwise increment cart 
        $cart->add($course, $course->id);
        $request->session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Course added to cart.');
    }

    public function getRemoveCourse(Request $request, $id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0) {
            Session::put('cart', $cart);
        }else {
            Session::forget('cart');
        }

        return redirect()->route('user.cart');
    }

    public function getCheckout(){
        if(!Session::has('cart')){
            return view('user.index')->with('error', 'Please login or register');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        // validate if the user has the course already 

        // charge the user // get the order as an hidden input field

        // create a new order 
        $order = new Order();
        //$order->user_id = Auth::id();
        $order->cart = serialize($cart);
        $order->payment_id = strval(time());
        $order->totalPrice = $cart->totalPrice;
        Auth::user()->orders()->save($order);

        // email the user 
        $orders = Auth::user()->orders->sortByDesc('id')->take(1);
        $orders->transform(function ($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        // save them an errollment
        foreach($orders as $nOrder){
            foreach($nOrder->cart->items as $item){
                $enrollment = new Enrollment([
                    'course_id' => $item['item']['id'],
                    'user_id' => Auth::id(),
                    'progress' => '0%'
                ]);
                $enrollment->save();
            }
        }

        // email the user 
        $data = array('orders' => $orders, 'name' => Auth::user()->name, 
        'body' => 'Thanks for studying with Brain Wakers. We hope this will be a worthwhile and rewarding journey for you.');
        Mail::send('email.register', $data, function ($message) {
            $message->from('john@johndoe.com', 'John Doe');
            $message->sender('john@johndoe.com', 'John Doe');
            $message->to(Auth::user()->email, Auth::user()->name);
            $message->cc('admin@brainwakers.com', 'Admin');
            //$message->bcc('john@johndoe.com', 'John Doe');
            //$message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Congrats ' . Auth::user()->name);
            //$message->priority(3);
            //$message->attach('pathToFile');
        });

        // forget the session 
        Session::forget('cart');
        
        $courses = DB::table('subjects')
        ->join('courses', 'courses.subject_id', '=', 'subjects.id')
        ->join('enrollments', 'enrollments.course_id', '=', 'courses.id')
        ->where('user_id', Auth::id())->get();
        return redirect()->route('user.course', ['courses' => $courses])->with('success', 'Welcome aboard');

    }

    // comment section 
    public function postComment(Request $request){
        // validate the request 
        $validation = Validator::make($request->all(), [
            'comment' => 'required',
            'select_file' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // error array and sucess message 
        if($validation->passes()){
            if($request->hasFile('select_file')){
                $fileNameWithExt = $request->file('select_file')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('select_file')->getClientOriginalExtension();
                $fileNameToStore = $fileName . '-' . time() . '.' . $extension;
                $request->file('select_file')->move('images', $fileNameToStore);
            }else{
                $fileNameToStore = '';
            }
            $comment = new Comment([
                'comment_body' => $request->get('comment'),
                'comment_image' => $fileNameToStore,
                'lecture_id' => $request->get('lecture_id'),
                'user_id' => Auth::id()
            ]);
            $comment->save();

            return back()->with('success', 'Comment inserted');
        }else{
            return back()->withErrors($validation);
            
        }
    }

    public function fetchComment(Request $request){
        if(!empty($request->get('searchComment'))){
            $search = $request->get('searchComment');
            $comments = Comment::where("comment_body", "like",  "%$search%")
            ->orderBy('id', 'desc')
            ->get();
            return view('user.classroom', ['comments' => $comments]);
        }else{
            $comments = Comment::orderBy('id', 'desc')->get();            
            return view('user.classroom', ['comments' => $comments]);
        }
    }


}
