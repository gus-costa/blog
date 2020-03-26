<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'author',
        'image',
        'short_desc',
        'description'
    ];

    public function category(){
        return $this->belongsTo('category');
    }
}
