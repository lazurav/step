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
    	// if (isset($_GET['orderBy']) && isset($_GET['sortOrder'])) {
     //    if (isset($_GET['orderBy']) == 'author') {
     //        $books = Book::with([
     //          'author' => function ($query) {
     //          $query->orderBy('name', $_GET['sortOrder']);
     //          }])->with([
     //          'janre' => function ($query) {
     //          $query->orderBy('name', 'asc');
     //          }])->select(DB::raw('books.id, books.title, books.year, books.pages, books.price, books.lang, books.status, a.name as authorname'))->join(
     //            'author_book as ab', 'ab.book_id', '=', 'books.id')->join('authors as a', 'a.id', '=', 'ab.author_id')->orderBy('authorname', $_GET['sortOrder'])->orderBy('title')->get();
     //    } elseif (isset($_GET['orderBy']) == 'janre') {
     //         $books = Book::with([
     //          'author' => function ($query) {
     //          $query->orderBy('name', 'asc');
     //          }])->with([
     //          'janre' => function ($query) {
     //          $query->orderBy('name', $_GET['sortOrder']);
     //          }])->select(DB::raw('books.id, books.title, books.year, books.pages, books.price, books.lang, books.status, j.name as janrename'))->leftjoin('book_janre as bj', 'bj.book_id', '=', 'books.id')->leftjoin('janres as j', 'j.id', '=', 'bj.janre_id')->orderBy('janrename', $_GET['sortOrder'])->orderBy('title')->get();
     //    } else {   
     //      $books = Book::with('author')->with('janre')->orderBy($_GET['orderBy'], $_GET['sortOrder'])->get();
     //    }
     //  } else {
     //  	$books = Book::with([
     //        'author' => function ($query) {
     //        $query->orderBy('name', 'ASC');
     //    }])->with([
     //        'janre' => function ($query) {
     //        $query->orderBy('name', 'ASC');
     //    }])->select(DB::raw('books.id, books.title, books.year, books.pages, books.price, books.lang, books.status, a.name as authorname'))->join(
     //            'author_book as ab', 'ab.book_id', '=', 'books.id')->join('authors as a', 'a.id', '=', 'ab.author_id')->where('a.name', 'Пушкин')->orwhere('a.name', 'Грибоедов')->where('books.price','156')->get();
     //                              //$books = Book::with('author')->with('janre')->select(DB::raw('books.id, books.title, books.year, books.pages, books.price, books.lang, books.status, j.name as janrename, a.name as authorname'))->leftjoin('author_book as ab', 'ab.book_id', '=', 'books.id')->leftjoin('authors as a', 'a.id', '=', 'ab.author_id')->leftjoin('book_janre as bj', 'bj.book_id', '=', 'books.id')->leftjoin('janres as j', 'j.id', '=', 'bj.janre_id')->get();
     //                              // $books = Book::with([
     //                              //     'author' => function ($query) {
     //                              //     $query->orderBy('name', 'ASC');
     //                              // }])->with('janre')->select(DB::raw('books.id, books.title, books.year, books.pages, books.price, books.lang, books.status, a.name as authorname'))->rightjoin('author_book as ab', 'ab.book_id', '=', 'books.id')->rightjoin('authors as a', 'a.id', '=', 'ab.author_id')->orderBy('authorname')->orderBy('title')->get();
     //  }

      $orderBy = 'title';
      $sortOrder = 'asc';
      $data['authorNames'] = Author::all()->sortBy('name');
      //dd($data['authorNames']);
      $data['janreNames'] = Janre::all()->sortBy('name');
      //var_dump($data['janreNames']);
      

      if(isset($_POST['author_id'])){
        $authors_ids = $_POST['author_id'];
        $data['authors_ids'] = $_POST['author_id'];
      } else {
        $authors_ids =  ['8','9','10','11','12','13','14','15','16','17']; // Тут форычем надо просто все существующие ID привязать, это сделано чтобы по-умолчанию все показывалось
      }

      if(isset($_POST['janre_id'])){
        $janres_ids = $_POST['janre_id'];
        $data['janres_ids'] = $_POST['janre_id'];
      } else {
        $janres_ids =  ['8','9','10','11','12','13','14','15','16','17']; // Тут форычем надо просто все существующие ID привязать, это сделано чтобы по-умолчанию все показывалось
      }


      if (isset($_GET['orderBy']) && isset($_GET['sortOrder'])){
        $orderBy = $_GET['orderBy'];
        $sortOrder = $_GET['sortOrder'];
      } 

      $books = Book::with([
            'author' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->with([
            'janre' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->select(DB::raw('books.id, books.title, books.year, books.pages, books.price, books.lang, books.status, a.name as authorname, j.name as janrename'))->join(
                'author_book as ab', 'ab.book_id', '=', 'books.id')->join('authors as a', 'a.id', '=', 'ab.author_id')->join('book_janre as bj', 'bj.book_id', '=', 'books.id')->join('janres as j', 'j.id', '=', 'bj.janre_id')->wherein('a.id',$authors_ids)->wherein('j.id',$janres_ids)->orderBy($orderBy, $sortOrder)->orderBy('title','asc')->get();
       
       $data['books'] = $books;

      // foreach ($books as $book) {
      //   $data['authors'] = '123';//$book->author();
      //   $data['janres'] = '123';//$book->janre();
      //  }

      //$book123 = Book::find(13)->author()->attach(10);
      //$book123 = Book::find(13)->author()->detach(10);
    	return view('adminus.book.books', $data);
    }



    static function sortOrder($f='title', $d = 'ASC') {
        GLOBAL $_SERVER;
        $res = '<a href="?orderBy=' . $f . '&sortOrder='. $d.'">';
        return $res;
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

      
      return redirect()->route('book/books.index');
      //var_dump ($_POST);
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

    public function filterBook()
    {
      var_dump($_POST['author_id']);
    }

}
