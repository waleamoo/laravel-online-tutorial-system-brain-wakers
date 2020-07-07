<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/course';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function getLogin()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            // check if the user is activated

            $user = Auth::user();

            //dd($user['is_activated']);
            if (strval($user['is_activated']) == 0) {
                Auth::logout();

                return redirect()->back()->with('warning', 'Please activate your email address');
            }
            return redirect()->route('user.course');
        }
        return redirect()->back()->withInput(['email' => $request->input('email')])
            ->with('warning', 'Your credentials does not match our records');
    }

    public function credentials(Request $request)
    {


        $request['is_activated'] == 1;
        return $request->only('email', 'password', 'is_activated');
    }
}
