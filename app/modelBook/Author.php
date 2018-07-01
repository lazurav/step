<?php

namespace App\modelBook;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	protected $fillable=['id', 'name', 'created_at', 'updated_at'];

    //
     public function book() {
        return $this->belongsToMany(
            app\modelBook\Book,
            'book_to_author',
            'author_id',
            'book_id'
        );
    }


}
