<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Config;
use App\Category;
use App\Post;
use App\Tag;
use Auth;
use Purifier;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getCategoriesForSelect()
    {
        return Category::all()->pluck('name', 'id');
    }

    private function getTagsForSelect()
    {
        return Tag::all()->pluck('name', 'id');
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
            ->with('categories', $this->getCategoriesForSelect())
            ->with('tags', $this->getTagsForSelect());
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'title' => 'required|max:100|min:10',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'short_desc' => 'required|max:200|min:30',
            'description' => 'required|max:4000000000|min:100',
            'slug' => 'required|alpha_dash|max:255|min:10|unique:posts,slug',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        $path = Storage::putFile(Config::get('app.images_dir'), $request->file('image'));

        $post = new Post;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->author_id = Auth::user()->id;
        $post->image = $path;
        $post->short_desc = $request->short_desc;
        $post->description = Purifier::clean($request->description);
        $post->slug = $request->slug;
        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'New post was created');

        return redirect()->route('post.index');
    }

    public function edit(Post $post)
    {
        return view('admin.post.edit')
            ->with('post', $post)
            ->with('categories', $this->getCategoriesForSelect())
            ->with('tags', $this->getTagsForSelect());
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'title' => 'required|max:100|min:10',
            'image' => 'mimes:jpg,jpeg,png,gif',
            'short_desc' => 'required|max:200|min:30',
            'description' => 'required|max:4000000000|min:100',
            'slug' => 'required|alpha_dash|max:255|min:10|unique:posts,slug,' . $post->id,
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        $oldfile = null;

        if (!empty($request->file('image'))) {
            $path = Storage::putFile(Config::get('app.images_dir'), $request->file('image'));
            $oldfile = $post->image;
            $post->image = $path;
        }

        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->short_desc = $request->short_desc;
        $post->description = Purifier::clean($request->description);
        $post->slug = $request->slug;
        $post->save();

        $post->tags()->sync($request->tags ?? []);

        if (!empty($oldfile))
            $this->deleteImageFile($oldfile);

        Session::flash('success', 'Post was updated');

        return redirect()->route('post.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        $this->deleteImageFile($post->image);
        Session::flash('success', 'Post was deleted');
        return redirect()->route('post.index');
    }
}
