<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request; // use this type of Request 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:3|max:50',
            'surname' => 'required|string|min:3|max:50',
            'address' => 'required|string|max:60',
            'phone' => 'required|numeric|unique:users',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20|',
            'confirm_password' => 'required|min:6|max:20|same:password'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'dob' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_activated' => 0
        ]);
    }

    protected function getRegister(){
        return view('user.register');
    }


    public function register(Request $request)
    {
        // validate the request using custom validation 
        $this->validate($request, [
            'name' => 'required|string|min:3|max:50',
            'surname' => 'required|string|min:3|max:50',
            'address' => 'required|string|max:60',
            'phone' => 'required|numeric|unique:users',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20|',
            'confirm_password' => 'required|min:6|max:20|same:password'
        ]);
        // process the request 
        $input = $request->all();
        $validator = $this->validator($input); // validate the request using built-in validator here
        if($validator->passes()){
            $user = $this->create($input)->toArray();
            $user['link'] = str_random(30);
            DB::table('users_activations')->insert(['id_user' => $user['id'], 'token' => $user['link']]);
            //dd($user);
            Mail::send('email.activation', $user, function ($message) use ($user) {
                $message->from('admin@brainwakers.com', 'Admin');
                $message->sender('john@johndoe.com', 'John Doe');
                $message->to($user['email'], $user['name']);
                //$message->cc('john@johndoe.com', 'John Doe');
                //$message->bcc('john@johndoe.com', 'John Doe');
                //$message->replyTo('john@johndoe.com', 'John Doe');
                $message->subject('Brain Wakers - Activation Code');
                //$message->priority(3);
                //$message->attach('pathToFile');
            });
            return redirect()->route('user.login')
            ->with('success', 'Thanks for registering '. $user['name'] . '. We have sent activation code to ' . $user['email']);
        }

        return redirect()->back()->with('warning', 'Please fill all fields');
    }

    public function userActivation($token){
        $check = DB::table('users_activations')->where('token', $token)->first();
        if(!is_null($check)){
            $user = User::find($check->id_user);
            if($user->is_activated == 1){
                return redirect()->route('user.login')->with('success', 'User activated');
            }
            $user->update(['is_activated' => 1]);
            DB::table('users_activations')->where('token', $token)->delete();
            return redirect()->route('user.login')->with('success', 'User activated successfully');
        }

        return redirect()->route('user.login')->with('warning', 'Your token is invalid');
    }

    // codes for resend activattion code

    public function getResendForm(){
        return view('user.active');
    }

    public function postResendForm(Request $request){
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);

        $check = DB::table('users')->where('email', $request->get('email'))->first();
        if(!is_null($check)){
            $user = DB::table('users')
            ->join('users_activations', 'users_activations.id_user', '=', 'users.id')
            ->where('users.id', $check->id)->get();
            
            if($user[0]->is_activated == 0){
                $data = array('email' => $user[0]->email, 'name' => $user[0]->name, 'token' => $user[0]->token);
                Mail::send('email.resend', $data, function ($message) use ($data) {
                    $message->from('admin@brainwakers.com', 'Admin');
                    $message->sender('admin@brainwakers.com', 'Admin');
                    $message->to($data['email'], $data['name']);
                    $message->subject('Brain Wakers - Activation Code');
                });

                return redirect()->route('getActive')->with('success', 'Activation link has been resent to ' . $request->get('email'));
            }

            return redirect()->route('user.login')->with('success', 'Your email has already been activated. Instead use the password reset link to reset your password.');
            //return redirect()->route('getActive')->with('success', 'We have it');
        }else{
            return redirect()->route('getActive')->with('error', 'Your email ' . $request->get('email') . ' does not match any of our records');
        }
    }


}
