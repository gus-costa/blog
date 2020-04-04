<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Session;
use Config;
use App\Category;
use App\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getCategoriesForSelect(){
        $categories = [];

        foreach (Category::all() as $category) {
            $categories[$category->id] = $category->name;
        }

        return $categories;
    }

    private function deleteImageFile($filename){
        Storage::delete($filename);
    }

    public function index(){
        $posts = Post::all();

        return view('admin.post.index')
            ->with('posts', $posts);
    }

    public function create(){
        return view('admin.post.create')
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
            return redirect()
                ->route('post.create')
                ->withInput()
                ->withErrors($validator);
        }

        $path = Storage::putFile(Config::get('app.images_dir'), $request->file('image'));

        $post = new Post;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->author = $request->author;
        $post->image = $path;
        $post->short_desc = $request->short_desc;
        $post->description = $request->description;
        $post->save();

        Session::flash('post_create','New post was created');    

        return redirect()->route('post.create');
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        return view('admin.post.edit')
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
            return redirect()
                ->route('post.edit', ['post' => $post->id])
                ->withInput()
                ->withErrors($validator);
        }

        $oldfile = null;

        if (!empty($request->file('image'))) {
            $path = Storage::putFile(Config::get('app.images_dir'), $request->file('image'));
            $oldfile = $post->image;
            $post->image = $path;
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

        return redirect()->route('post.index');
    }

    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        $this->deleteImageFile($post->image);
        Session::flash('post_delete','Post was deleted');    
        return redirect()->route('post.index');
    }
}
