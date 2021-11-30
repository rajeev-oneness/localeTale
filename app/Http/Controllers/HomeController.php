<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch (Auth::user()->user_role) {
            case 1:
                return redirect('admin/dashboard');break;
            case 2:
                return redirect('business/dashboard');break;
            case 3:
                return view('home');
        }
    }

    public function logout(Request $req)
    {
        auth()->guard()->logout();
        $req->session()->invalidate();
        return redirect('/');
    }
}
