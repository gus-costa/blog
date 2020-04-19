@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Category</h1>

    <nav class="navbar navbar-expand navbar-light bg-white">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('category.index') }}">View All categories</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('category.create') }}">Create Category</a></li>
        </ul>
    </nav>

    <!-- Form errors -->
    @include('common.messages')

    {!! Form::model($categories, ['route' => ['category.update', $categories->id], 'method' => 'put']) !!}

    <div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    </div>

    {!! Form::close() !!}
@endsection