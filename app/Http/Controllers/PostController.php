<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use File;
use App\Category;
use App\Post;

class PostController extends Controller
{
    private function getCategoriesForSelect(){
        $categories = [];

        foreach (Category::all() as $category) {
            $categories[$category->id] = $category->name;
        }

        return $categories;
    }

    private function deleteImageFile($filename){
        File::delete('img/posts/'.$filename);
    }

    public function index(){
        $posts = Post::all();

        return view('post.index')
            ->with('posts', $posts);
    }

    public function create(){
        return view('post.create')
            ->with('categories', $this->getCategoriesForSelect());
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'title' => 'required|max:20|min:3',
            'author' => 'required|max:20|min:3',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'short_desc' => 'required|max:50|min:10',
            'description' => 'required|max:1000|min:50'
        ]);

        if ($validator->fails()) {
            return redirect('post/create')
                ->withInput()
                ->withErrors($validator);
        }

        $image = $request->file('image');
        $upload = 'img/posts/';
        $filename = time().$image->getClientOriginalName();
        $path = move_uploaded_file($image->getPathName(), $upload.$filename);

        $post = new Post;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->author = $request->author;
        $post->image = $filename;
        $post->short_desc = $request->short_desc;
        $post->description = $request->description;
        $post->save();

        Session::flash('post_create','New post was created');    

        return redirect('post/create');
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        return view('post.edit')
            ->with('post', $post)
            ->with('categories', $this->getCategoriesForSelect());
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'title' => 'required|max:20|min:3',
            'author' => 'required|max:20|min:3',
            'image' => 'mimes:jpg,jpeg,png,gif',
            'short_desc' => 'required|max:50|min:10',
            'description' => 'required|max:1000|min:50'
        ]);

        $post = Post::find($id);

        if ($validator->fails()) {
            return redirect('post/'.$post->id.'/edit')
                ->withInput()
                ->withErrors($validator);
        }

        $oldfile = null;

        if (!empty($request->file('image'))){
            $image = $request->file('image');
            $upload = 'img/posts/';
            $filename = time().$image->getClientOriginalName();
            $path = move_uploaded_file($image->getPathName(), $upload.$filename);
            $oldfile = $post->image;
            $post->image = $filename;
        }

        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->author = $request->author;
        $post->short_desc = $request->short_desc;
        $post->description = $request->description;
        $post->save();

        if (!empty($oldfile))
            $this->deleteImageFile($oldfile);

        Session::flash('post_update','Post was updated');    

        return redirect('post');
    }

    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        $this->deleteImageFile($post->image);
        Session::flash('post_delete','Post was deleted');    
        return redirect('post');
    }
}
