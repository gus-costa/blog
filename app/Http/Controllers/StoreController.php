<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class StoreController extends Controller
{
    public function index(){
        return view('store.index')
            ->with('posts', Post::orderBy('created_at','DESC')->get());
    }

    public function getView($id){
        return view('store.view')
            ->with('post', Post::find($id));
    }
}
