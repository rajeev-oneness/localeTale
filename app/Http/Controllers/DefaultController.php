<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function welcome(Request $req)
    {
        return view('welcome');
    }
}
