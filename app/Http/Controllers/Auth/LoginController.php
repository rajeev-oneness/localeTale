<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User, Hash;

class LoginController extends Controller
{
    // use AuthenticatesUsers;

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

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function adminLoginView(Request $req)
    {
        return view('auth.adminLogin');
    }

    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email',$req->email)->first();
        if($user){
            if(Hash::check($req->password,$user->password)){
                if($user->status == 1){
                    auth()->login($user);
                    return redirect()->intended('/home');
                }
                $errors['email'] = 'this account has been blocked';
                return back()->withErrors($errors)->withInput($req->all());
            }
            $errors['password'] = 'you have entered wrong password';
            return back()->withErrors($errors)->withInput($req->all());
        }
        $errors['email'] = 'this email is not register with us';
        return back()->withErrors($errors)->withInput($req->all());
    }

    public function logout(Request $req)
    {
        auth()->guard()->logout();
        $req->session()->invalidate();
        return redirect('/');
    }
}
