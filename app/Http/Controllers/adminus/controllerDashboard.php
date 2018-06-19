<?php

namespace App\Http\Controllers\adminus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;


class controllerDashboard extends Controller
{
    public function index()
    {
    	
    	$dataSet = array('title' => 'Work title');
    	$dataSet['users'] = DB::select ('select * from users ', [1]);



    	return view('adminus.index', $dataSet);
    }

    public function statistic()
    {
    	return view('adminus.statistic');
    }
}