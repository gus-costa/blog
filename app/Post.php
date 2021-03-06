<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'author_id',
        'image',
        'short_desc',
        'description'
    ];

    protected $appends = ['html_content'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getApprovedCommentsAttribute()
    {
        return $this->comments()->where('approved', true)->orderBy('created_at')->get();
    }

    public function getHtmlContentAttribute()
    {
        return \Illuminate\Mail\Markdown::parse($this->description);
    }
}
