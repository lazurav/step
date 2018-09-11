<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/adminus', function () {
//     return view('welcome');
// });




Route::group([
  'prefix' => 'adminus',
  'namespace' => 'adminus'//,
  //'middleware' => ['auth']
],
      function (){
        Route::get('/','controllerDashboard@index')->name('adminus.index');
        Route::get('/statistic','controllerDashboard@statistic')->name('adminus.statistic');
        Route::get('/post','controllerPost@index')->name('post.index');
        Route::get('/book','book\controllerBook@book')->name('book/book.index');
        

        Route::post('/books/add','book\controllerBook@addBook')->name('book/book.add');
        Route::post('/books','book\controllerBook@books')->name('book/books.filter');
        
        Route::get('/books','book\controllerBook@books')->name('book/books.index');
        Route::get('/authors','book\controllerAuthor@index')->name('book/authors.index');
        Route::post('/authors','book\controllerAuthor@addAuthor')->name('book/author.add');
        Route::get('/janres','book\controllerJanre@index')->name('book/janres.index');
        Route::post('/janres','book\controllerJanre@addJanre')->name('book/janre.add');


        // Route::get('book/{slug}', function($slug){
        //   $data ['slug'] =  'Test Slug' . $slug;

        //     //$result =   DB::table('campains')->where('slug', $slug)->get();
        //     // .... call controller etc...
        //   return view('welcome', $data);
        // });

      }
);

Route::group([
  'prefix' => 'adminus',
  'namespace' => 'adminus',
  'middleware' => ['auth']
],
      function (){
        Route::post('/books/del','book\controllerBook@deleteBook')->name('book/book.delete');

      }
);


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
