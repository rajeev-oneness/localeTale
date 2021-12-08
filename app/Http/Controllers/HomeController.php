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
                return redirect(route('admin.dashboard'));break;
            case 2:
                return redirect(route('business.dashboard'));break;
            case 3:
                return redirect(route('customer.dashboard'));break;
            default : 
                return view('home');
        }
        return view('home');
    }
}
