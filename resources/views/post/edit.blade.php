@extends('admin.main')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Post</h1>

    <nav class="navbar navbar-expand navbar-light bg-white">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ url('post') }}">View All Posts</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('post/create') }}">Create New Post</a></li>
        </ul>
    </nav>

    <div class="panel-body">
        <!-- Form errors -->
        @include('common.errors')
        
        {!! Form::model($post, ['route' => ['post.update', $post->id], 'method' => 'put', 'files' => 'true']) !!}

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
        
        {!! Form::submit('Save', ['class' => 'secondary-cart-btn']) !!}
        {!! Form::close() !!}

    </div>
@endsection