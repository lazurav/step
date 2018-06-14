<?php

namespace App\Http\Controllers\adminus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class controllerDashboard extends Controller
{
    public function index(){
    	return view('adminus.index');
    }

    public function statistic(){
    	return view('adminus.statistic');
    }
}
