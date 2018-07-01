<?php

namespace App\Http\Controllers\adminus\book;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modelBook\Janre;
use DB;


class controllerJanre extends Controller
{
    //
    public function index()
    {
    	
    	$data['janres'] = DB::select ('select * from janres', [1]);
    	
    	return view('adminus.book.janres', $data);
    }
    public function addJanre(Request $request)
    { 
        Janre::create($request->all());

    return redirect()->route('book/janres.index');
    }
}
