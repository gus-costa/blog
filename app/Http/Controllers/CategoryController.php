<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $categories = Category::all();

        return view('admin.category.index')
            ->with('categories', $categories);
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('category.create')
                ->withInput()
                ->withErrors($validator);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        Session::flash('success','New category is created');    

        return redirect()->route('category.index');
    }

    public function edit($id){
        $categories = Category::findOrFail($id);
        return view('admin.category.edit')
            ->with('categories', $categories);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3'
        ]);

        $category = Category::find($id);

        if ($validator->fails()) {
            return redirect('category/' . $category->id . '/edit')
                ->route('category.edit', ['category' => $category->id])
                ->withInput()
                ->withErrors($validator);
        }

        $category->name = $request->Input('name');
        $category->save();

        Session::flash('success','Category was updated');    

        return redirect()->route('category.index');
    }

    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
        Session::flash('success','Category was deleted');    
        return redirect()->route('category.index');
    }
}
