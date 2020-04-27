@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Post</h1>

    <nav class="navbar navbar-expand navbar-light bg-white">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('post.index') }}">View All Posts</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('post.create') }}">Create Post</a></li>
        </ul>
    </nav>

    <!-- Form errors -->
    @include('common.messages')

    {!! Form::model($post, ['route' => ['post.update', $post->id], 'method' => 'put', 'files' => true]) !!}

    <div class="form-group">
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', $categories, null, ['class'=>'form-control', 'required' => '']) !!}
    </div>

    <div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class'=>'form-control', 'required' => '']) !!}
    </div>

    <div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class'=>'form-control', 'required' => '', 'minlength' => '10', 'maxlength' => '255']) !!}
    </div>

    <div class="form-group">
    {!! Form::label('author', 'Author:') !!}
    {!! Form::text('author', null, ['class'=>'form-control', 'required' => '']) !!}
    </div>

    <div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image', ['class'=>'form-control-file']) !!}
    </div>
    <img src="{{ Storage::url($post->image) }}">

    <div class="form-group">
    {!! Form::label('short_desc', 'Short description:') !!}
    {!! Form::text('short_desc', null, ['class'=>'form-control', 'required' => '']) !!}
    </div>

    <div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control', 'required' => '']) !!}
    </div>

    <div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}
@endsection