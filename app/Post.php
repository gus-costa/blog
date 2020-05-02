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

    protected $appends = ['html_content'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function getHtmlContentAttribute() {
        return \Illuminate\Mail\Markdown::parse($this->description);
    }
}
