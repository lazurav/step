<?php

namespace App\modelBook;

use Illuminate\Database\Eloquent\Model;

class Janre extends Model
{
	protected $fillable=['name', 'created_at', 'updated_at'];
    //
    public function book() {
        return $this->belongsToMany(
            app\modelBook\Janre,
            'book_to_janre',
            'book_id',
            'janre_id'
        );
    }
}
