<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Session, Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        // for confirm Password middleware is : "password.confirm"
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
                return redirect('customer/dashboard');break;
        }
        return view('home');
    }
}
