<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function dashboard(Request $req)
    {
        return view('business.businessDashboard');
    }
}
