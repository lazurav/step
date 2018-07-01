<?php

namespace App\Http\Controllers\adminus\book;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modelBook\Author;

use DB;

class controllerAuthor extends Controller
{

	public function index()
    {
    	
    	$dataSet['authors'] = DB::select ('select * from authors', [1]);
    	
    	return view('adminus.book.authors', $dataSet);
    }
    public function addAuthor(Request $request)
    { 
        Author::create($request->all());

    return redirect()->route('book/authors.index');
    }
}
