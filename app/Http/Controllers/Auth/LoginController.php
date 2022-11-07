<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        if(Auth::attempt(array('user_id'=>$request->user_id, 'password'=>$request->password))){
            switch(Auth::user()->account_role){
                case 'admin':
                    return redirect()->route('adminHome');
                case 'student':
                    return redirect()->route('stud.request');
                default:
                    return redirect()->route('home');
            }
        }else{
            return throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }
    }
}
