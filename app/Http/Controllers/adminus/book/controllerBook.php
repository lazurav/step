<?php

namespace App\Http\Controllers\adminus\book;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modelBook\Book;
use App\modelBook\Author;
use App\modelBook\Janre;
use DB;

class controllerBook extends Controller
{
      public function books()
    {
    	
    	$books = Book::all();
      $data['books'] = $books;
      foreach ($books as $book) {
        $data['authors'] = $book->author();
        $data['janres'] = $book->janre();
      }

      //$book123 = Book::find(13)->author()->attach(10);
      //$book123 = Book::find(13)->author()->detach(10);

      $data['authorNames'] = Author::all()->sortBy('name');
      //var_dump($data['authorNames']);

      $data['janreNames'] = Janre::all()->sortBy('name');
      //var_dump($data['janreNames']);


    //

    	return view('adminus.book.books', $data);
    }

     public function book()
    {
    	
    	
    	$data['book'] = DB::select ('select * from books WHERE `ID` = 1');
    	
    	return view('adminus.book.book', $data);
    }

     public function addBook(Request $request)
    {

      $newBook = Book::create($request->all());
      $lastBookId = $newBook->id;

      $authorIDS = $_POST['author'];
      foreach ($authorIDS as $authorID) {
        $authorBook = Book::find($lastBookId)->author()->attach($authorID);
      }

      $janreIDS = $_POST['janre'];
      foreach ($janreIDS as $janreID) {
        $bookJanre = Book::find($lastBookId)->janre()->attach($janreID);
      }

      
      //return redirect()->route('book/books.index');
      var_dump ($_POST);
      //return view('adminus.book.book');
    }

    public function deleteBook(Request $request)
    {

      $bookID = $_POST['id'];
      $authorBook = Book::find($bookID)->author()->detach();
      $janreBook = Book::find($bookID)->janre()->detach();
      $deleteBook = Book::find($bookID)->delete();


      //var_dump ($_POST);
      return redirect()->route('book/books.index');
    }

}
