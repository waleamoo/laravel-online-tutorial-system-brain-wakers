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
use App\Reply;
use App\User;
use App\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use \Validator;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getDashboard(){
        $users = User::all();
        $user_count = count($users);
        return view('admin.dashboard', ['count' => $user_count]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route("admin.login")->with('success', 'Logout successful.');
    }

    public function postAddLecture(Request $request){

        $this->validate($request, [
            'subject' => 'required',
            'course' => 'required',
            'topic' => 'required',
            'sub_topic' => 'required',
            'link' => 'required'
        ]);
        $lecture = new Lecture([
            'subject_id' => $request['subject'],
            'course_id' => $request['course'],
            'topic' => $request['topic'],
            'sub_topic' => $request['sub_topic'],
            'video' => $request['link']
        ]);
        //dd($lecture);
        $lecture->save();
        return redirect()->back()->with('success', 'Lecture added.');
    }

    public function getComment(){
        $comments = DB::table('comments')
        ->join('replies', 'replies.comment_id', '=', 'comments.id')->get();
        return view('admin.comment', ['comments' => $comments ]);
    }

    public function postReply(Request $request){

        
        $this->validate($request, [
            'reply' => 'required',
            'select_file' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        

        if($request->hasFile('select_file')){
            $fileNameWithExt = $request->file('select_file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('select_file')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '-' . time() . '.' . $extension;
            $request->file('select_file')->move('images', $fileNameToStore);
        }else{
            $fileNameToStore = '';
        }

        $reply = new Reply([
            'reply_body' => $request->input('reply'),
            'reply_image' => $fileNameToStore,
            'comment_id' => $request->input('comment_id')
        ]);
        $reply->save();
        return redirect()->route('admin.comment')->with('success', 'Reply sent.');

    }

    public function postAddSubject(Request $request){
        $this->validate($request, [
            'subject_name' => 'required'
        ]);
        $subject = new Subject([
            'subject_name' => $request->get('subject_name')
        ]);
        $subject->save();
        return redirect()->back()->with('success', 'Subject added');
    }

    public function getCourse(){
        $courses = Course::all();
        return view('admin.course', ['courses' => $courses]);
    }
    
    public function postCourse(Request $request){
        $this->validate($request, [
            'course_name' => 'required',
            'fee' => 'required|numeric',
            'subject' => 'required',
            'benefits' => 'required',
            'tutor' => 'required',
            'topics' => 'required'
        ]);
        $course = new Course([
            'course_name' => $request['course_name'],
            'fee' => $request['fee'],
            'subject_id' => $request['subject'],
            'benefits' => $request['benefits'],
            'tutor' => $request['tutor'],
            'topics' => $request['topics']
        ]);
        $course->save();
        return redirect()->back()->with('success', 'Course created');
    }

    public function postUpdateCourse(Request $request){
        $this->validate($request, [
            'fee' => 'required|numeric',
            'benefits' => 'required',
            'tutor' => 'required',
            'topics' => 'required'
        ]);
        DB::update('update courses set fee = ?, benefits = ?, tutor = ?, topics = ? where id = ?', 
        [$request['fee'], $request['benefits'], $request['tutor'], $request['topics'], $request['id']]);
        return redirect()->back()->with('success', 'Course updated');
    }

    public function getEditCourse(Request $request, $id){
        $course = Course::find($id);
        return view('admin.update-course', ['course' => $course]);
    }

    public function getDeleteCourse($id){
        DB::delete('delete from courses where id = ?', [$id]);
        return redirect()->back()->with('success', 'Course deleted');
    }

    public function getDeleteSubject($id){
        DB::delete('delete from subjects where id = ?', [$id]);
        return redirect()->back()->with('success', 'Subject deleted');
    }

    // crud for lectures
    public function getLecture(){
        $lectures = Lecture::orderBy('id', 'desc')->get();
        return view('admin.lecture', ['lectures' => $lectures]);
    }

    public function getDeleteLecture($id){
        DB::delete('delete from lectures where id = ?', [$id]);
        return redirect()->back()->with('success', 'Lecture deleted');
    }

    public function getEditLecture($id){
        $lecture = Lecture::find($id);
        return view('admin.update-lecture', ['lecture' => $lecture]);
    }

    public function postUpdateLecture(Request $request){
        $this->validate($request, [
            'topic' => 'required',
            'sub_topic' => 'required',
            'video' => 'required'
        ]);

        DB::update('update lectures set topic = ?, sub_topic = ?, video = ? where id = ?', 
        [$request['topic'], $request['sub_topic'], $request['video'], $request['id']]);
        return redirect()->back()->with('success', 'Lecture updated');

    }

    public function fetch(){

        $select = $_GET['select'];
        $value = $_GET['value'];

        $data = DB::table('courses')->where('subject_id', $value)->get();
        $output = '<option value="">Select course...</option>';
        foreach($data as $row){
            $output .= '<option value="' . $row->id . '">' . $row->course_name .'</option>';
        }
        echo $output;
        
    }

    public function fetchTopics(){
        $value = $_GET['value']; // subject_id

        $data = DB::table('courses')->where('subject_id', $value)->value('topics');

        $data = explode("|", $data);

        $output = '<option value="">Select topic...</option>';
        foreach($data as $row){
            $output .= '<option value="' . $row . '">' . $row .'</option>';
        }
        echo $output;
    }

}
