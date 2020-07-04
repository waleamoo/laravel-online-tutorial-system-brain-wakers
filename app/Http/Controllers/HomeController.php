<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Course;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
        return view('user.course');
    }

    public function getClassRoom(){
        return view('user.classroom');
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
            return view('user.index');
        }

        // create a new order 

        // charge the user 

        // email the user 

        // forget the session 


    }


}
