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
  'namespace' => 'adminus',
  'middleware' => ['auth']
],
      function (){
        Route::get('/','controllerDashboard@index')->name('adminus.index');
        Route::get('/statistic','controllerDashboard@statistic')->name('adminus.statistic');
        Route::get('/post','controllerPost@index')->name('post.index');
      }
);
