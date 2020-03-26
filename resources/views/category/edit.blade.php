@extends('admin.main')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Category</h1>

    <nav class="navbar navbar-expand navbar-light bg-white">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="">View All categories</a></li>
            <li class="nav-item"><a class="nav-link" href="category/create">Create New Category</a></li>
        </ul>
    </nav>

    <div class="panel-body">
        <!-- Form errors -->
        @include('common.errors')
        
        {!! Form::model($categories, ['route' => ['category.update', $categories->id], 'method' => 'put']) !!}
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! Form::submit('Save', ['class' => 'secondary-cart-btn']) !!}
        {!! Form::close() !!}
    </div>
@endsection