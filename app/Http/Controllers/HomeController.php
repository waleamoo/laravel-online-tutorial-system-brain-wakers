<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Comment;
use App\Course;
use App\Enrollment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Lecture;
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
    public function pagenotfound()
    {
        return view('errors.503');
    }

    public function index()
    {
        return view('user.index');
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function postContact(Request $request)
    {

        // validate first 
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'phone' => 'required|max:20',
            'email' => 'required|email|max:100',
            'msg' => 'required|max:255'
        ]);

        if ($validation->passes()) {
            $name = $request->get('name');
            $phone = $request->get('phone');
            $email = $request->get('email');
            $content = $request->get('msg');

            DB::insert('insert into contacts (name, phone, email, message) values (?, ?, ?, ?)', [$name, $phone, $email, $content]);

            /*
            $data = array('name' => $name, 'phone' => $phone, 'email' => $email, 'content' => $content);
            Mail::send('email.contact', $data, function ($message) {
            $message->from('admin@brainwakers.com', 'Admin');
            $message->sender('admin@brainwakers.com', 'Admin');
            $message->to($data['email'], $data['name']);
            $message->cc('admin@brainwakers.com', 'Admin');
            //$message->bcc('john@johndoe.com', 'John Doe');
            $message->replyTo('admin@brainwakers.com', 'Admin');
            $message->subject('Inquiry Message');
            //$message->priority(3);
            //$message->attach('pathToFile');
            
        });*/
            return redirect()->route('user.contact')->with('success', 'Your email has been sent.');
        } else {
            return back()->withErrors($validation);
        }
    }

    public function services()
    {
        return view('user.services');
    }

    public function getReview()
    {
        return view('user.review');
    }

    public function postReview(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'review' => 'required|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'rating' => 'required'
        ]);

        $name = $request->input('name');
        $review = $request->input('review');

        if ($request->hasFile('picture')) {
            $fileNameWithExt = $request->file('picture')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '-' . time() . '.' . $extension;
            $request->file('picture')->move('images', $fileNameToStore);
        }
        $pic = $fileNameToStore;
        $rating = $request->input('rating');

        DB::insert('insert into reviews (name, review, pic, rating) values (?, ?, ?, ?)', [$name, $review, $pic, $rating]);

        return redirect()->route('user.review')->with('success', 'Review submitted. Thanks for your feedback.');
    }

    // function for search autocomplete feature 
    public function autocomplete(Request $request)
    {
        $data = Subject::select("subject_name as name")->where("subject_name", "LIKE", "%{$request->input('search')}%")->get();
        return response()->json($data);
    }

    // function to process search 
    public function getSearchCourse(Request $request)
    {
        if (!empty($request->input('search'))) {
            $search = $request->input('search');
            // join the subject and users table 
            $courses = DB::table('subjects')->join('courses', 'courses.subject_id', '=', 'subjects.id')
                ->where("subject_name", "LIKE", "%$search%")
                ->get();

            return view('user.search', ['courses' => $courses]);
        }
    }

    public function getCourses()
    {
        // fetch the user courses or enrollment 
        //$courses = DB::table('enrollments')->where('user_id', Auth::id())->value('course_id');
        $courses = DB::table('subjects')
            ->join('courses', 'courses.subject_id', '=', 'subjects.id')
            ->join('enrollments', 'enrollments.course_id', '=', 'courses.id')
            ->where('user_id', Auth::id())->get();

        return view('user.course', ['courses' => $courses]);
    }

    public function getClassRoom($lecture_id)
    { // lecuture_id suppose to be course_id
        // validate user classroom course
        $enrollment = DB::table('enrollments')->select('*') // AND CLAUSE
            ->where('course_id', $lecture_id)
            ->where(function ($q) {
                $q->where('user_id', Auth::id());
            })->get();
        //dd(count($enrollment));
        if (count($enrollment) > 0) {
            $tutorial = Lecture::find($lecture_id);
            // pass the comments 
            $comments = Comment::orderBy('id', 'desc')->where('lecture_id', $lecture_id)->get(); // tutorial and lec

            $lectures = Lecture::where('course_id', $lecture_id)->get();

            return view('user.classroom', [
                'comments' => $comments, 'lecture_id' => $lecture_id, 'lectures' => $lectures, 'tutorial' => $tutorial
            ]);
        } else {
            return redirect()->route('user.index')->with('error', 'You are not enrolled.');
        }
    }

    public function getTopic($lecture_id, $tutorial_id)
    {
        $tutorial = Lecture::find($tutorial_id);

        $enrollment = DB::table('enrollments')->select('*') // AND CLAUSE
            ->where('course_id', $lecture_id)
            ->where(function ($q) {
                $q->where('user_id', Auth::id());
            })->get();
        //dd(count($enrollment));
        if (count($enrollment) > 0) {
            // pass the comments 
            $comments = Comment::orderBy('id', 'desc')->where('lecture_id', $lecture_id)->get();

            $lectures = Lecture::where('course_id', $lecture_id)->get();


            return view('user.classroom', [
                'comments' => $comments, 'lecture_id' => $lecture_id, 'lectures' => $lectures, 'tutorial' => $tutorial
            ]);
        } else {
            return redirect()->route('user.index')->with('error', 'You are not enrolled.');
        }
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('user.cart');
        }

        // if there is a cart 
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('user.cart', ['courses' => $cart->items, 'totalPrice' => $cart->totalPrice]);

        return view('user.cart');
    }

    // function to get course details 
    public function getCourseDetails($sub_id, $id)
    {
        $course = Course::find($id); // 3

        $subject_name = Subject::find($sub_id)->value('subject_name'); // get the subject name of the course 

        $benefits = $course->benefits;
        $benefits = explode("|", $benefits);

        $topics = $course->topics;
        $topics = explode('|', $topics);

        return view('user.course-details', ['course' => $course, 'benefits' => $benefits, 'topics' => $topics, 'subject_name' => $subject_name]);
    }



    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('user.index');
    }

    // function to add course to cart 
    public function getAddToCart(Request $request, $id)
    {
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

    public function getRemoveCourse(Request $request, $id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('user.cart');
    }

    public function getCheckout(Request $request)
    {

        switch ($request->method()) {
            case 'POST':
                // do anything in 'post request';
                
                if (!Session::has('cart')) {
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
                $orders->transform(function ($order, $key) {
                    $order->cart = unserialize($order->cart);
                    return $order;
                });

                // save them an errollment
                foreach ($orders as $nOrder) {
                    foreach ($nOrder->cart->items as $item) {
                        $enrollment = new Enrollment([
                            'course_id' => $item['item']['id'],
                            'user_id' => Auth::id(),
                            'progress' => '0%'
                        ]);
                        $enrollment->save();
                    }
                }

                // email the user 
                $data = array(
                    'orders' => $orders, 'name' => Auth::user()->name,
                    'body' => 'Thanks for studying with Brain Wakers. We hope this will be a worthwhile and rewarding journey for you.'
                );
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
            break;
            case 'GET':
                return redirect()->route('user.index')->with('error', 'Invalid request.');
                break;

            default:
                return redirect()->route('user.index')->with('error', 'Invalid request.');
                break;
        }
    }

    // comment section 
    public function postComment(Request $request)
    {
        // validate the request 
        $validation = Validator::make($request->all(), [
            'comment' => 'required',
            'select_file' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // error array and sucess message 
        if ($validation->passes()) {
            if ($request->hasFile('select_file')) {
                $fileNameWithExt = $request->file('select_file')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('select_file')->getClientOriginalExtension();
                $fileNameToStore = $fileName . '-' . time() . '.' . $extension;
                $request->file('select_file')->move('images', $fileNameToStore);
            } else {
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
        } else {
            return back()->withErrors($validation);
        }
    }

    public function fetchComment(Request $request)
    {
        if (!empty($request->get('searchComment'))) {
            $search = $request->get('searchComment');
            $comments = Comment::where("comment_body", "like",  "%$search%")
                ->orderBy('id', 'desc')
                ->get();
            return view('user.classroom', ['comments' => $comments]);
        } else {
            $comments = Comment::orderBy('id', 'desc')->get();
            return view('user.classroom', ['comments' => $comments]);
        }
    }
}
