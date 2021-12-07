<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User, Hash;
use Illuminate\Support\Facades\Route;

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

    public function userLoginView(Request $req)
    {
        $pageTitle = 'Customer Login';$userRole = 3;
        switch (Route::currentRouteName()) {
            case 'admin.login': $pageTitle = 'Admin Login'; $userRole = 1; break;
            case 'b2b.login': $pageTitle = 'Business Login'; $userRole = 2; break;
            case 'customer.login': $pageTitle = 'Customer Login'; $userRole = 3; break;
        }
        return view('auth..login.userLoginView',compact('pageTitle','userRole'));
    }

    public function login(Request $req)
    {
        $req->validate([
            'user_role' => 'required|in:admin,business,customer',
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $userRole = 3;
        switch ($req->user_role) {
            case 'admin':$userRole = 1;break;
            case 'business':$userRole = 2;break;
            case 'customer':$userRole = 3;break;
        }
        $user = User::where('email',$req->email)->where('user_role',$userRole)->first();
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
