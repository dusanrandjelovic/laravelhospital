<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class ManagementLoginController extends Controller
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

    public function showLoginForm(){
    return view('auth.management-login');
  }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   //   protected $redirectTo = '/home';

    protected $redirectTo;
    public function redirectTo()
    {
        switch(Auth::user()->role_id){
            case 1:
            $this->redirectTo = '/admin';
            return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo = '/lekar';
                return $this->redirectTo;
                break;
            case 3:
                $this->redirectTo = '/asistent';
                return $this->redirectTo;
                break;
            case 4:
                $this->redirectTo = '/tester';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }

        // return $next($request);
    }







    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     //   $this->middleware('guest')->except('logout');
    }
}
