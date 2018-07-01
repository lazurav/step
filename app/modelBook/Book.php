<?php

namespace App\modelBook;

use Illuminate\Database\Eloquent\Model;
use App\modelBook\Book;

class Book extends Model
{
    //
	protected $fillable=['title', 'price', 'pages', 'year', 'lang', 'status', 'created_at', 'updated_at'];

    public function author() {
        return $this->belongsToMany('App\modelBook\Author', 'author_book');
    }

    public function janre() {
        return $this->belongsToMany('App\modelBook\Janre', 'book_janre');
    }


}
