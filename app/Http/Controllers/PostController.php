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

    private function getCategoriesForSelect()
    {
        $categories = [];

        foreach (Category::all() as $category) {
            $categories[$category->id] = $category->name;
        }

        return $categories;
    }

    private function deleteImageFile($filename)
    {
        Storage::delete($filename);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();

        return view('admin.post.index')
            ->with('posts', $posts);
    }

    public function create()
    {
        return view('admin.post.create')
            ->with('categories', $this->getCategoriesForSelect());
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'title' => 'required|max:100|min:10',
            'author' => 'required|max:20|min:3',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'short_desc' => 'required|max:200|min:30',
            'description' => 'required|max:4000000000|min:100',
            'slug' => 'required|alpha_dash|max:255|min:10|unique:posts,slug'
        ]);

        $path = Storage::putFile(Config::get('app.images_dir'), $request->file('image'));

        $post = new Post;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->author = $request->author;
        $post->image = $path;
        $post->short_desc = $request->short_desc;
        $post->description = $request->description;
        $post->slug = $request->slug;
        $post->save();

        Session::flash('success', 'New post was created');

        return redirect()->route('post.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.post.edit')
            ->with('post', $post)
            ->with('categories', $this->getCategoriesForSelect());
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'title' => 'required|max:100|min:10',
            'author' => 'required|max:20|min:3',
            'image' => 'mimes:jpg,jpeg,png,gif',
            'short_desc' => 'required|max:200|min:30',
            'description' => 'required|max:4000000000|min:100',
            'slug' => 'required|alpha_dash|max:255|min:10|unique:posts,slug,' . $id
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
        $post->slug = $request->slug;
        $post->save();

        if (!empty($oldfile))
            $this->deleteImageFile($oldfile);

        Session::flash('success', 'Post was updated');

        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        $this->deleteImageFile($post->image);
        Session::flash('success', 'Post was deleted');
        return redirect()->route('post.index');
    }
}
