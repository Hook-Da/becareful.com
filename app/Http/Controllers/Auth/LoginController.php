<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;
use Illuminate\Http\Request;


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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function getLogin(){
        return view('auth.login');
    }
    protected function postLogin(Request $request){
        $this->validate($request,[
            'email'     =>'required|email|max:255',
            'password'  =>'required|max:255'
            ]);
        if(Auth::attempt(['email' => $request->email,'password'=>$request->password])){
            return redirect('/');
        }
        return 'Oooops something went wrong';
    }
    public function getLogout() {
          Auth::logout();
          return redirect('auth/login');
        }
}

