@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Create New Category</h1>

    <nav class="navbar navbar-expand navbar-light bg-white">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('post.index') }}">View All Posts</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('post.create') }}">Create New Post</a></li>
        </ul>
    </nav>

    @if (Session::has('post_create'))
        <div class="alert alert-success">
            <em>{!! session('post_create') !!}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="panel-body">
        <!-- Form errors -->
        @include('common.errors')
        
        {!! Form::open(['route' => 'post.store', 'files' => 'true']) !!}

        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', $categories, ['class'=>'form-control']) !!}
        
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
        
        {!! Form::label('author', 'Author:') !!}
        {!! Form::text('author', null, ['class'=>'form-control']) !!}
        
        {!! Form::label('image', 'Image:') !!}
        {!! Form::file('image', null, ['class'=>'form-control']) !!}
        
        {!! Form::label('short_desc', 'Short description:') !!}
        {!! Form::text('short_desc', null, ['class'=>'form-control']) !!}
        
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
        
        {!! Form::submit('Create Post', ['class' => 'secondary-cart-btn']) !!}
        {!! Form::close() !!}
    </div>
@endsection