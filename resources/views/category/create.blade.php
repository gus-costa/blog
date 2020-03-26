@extends('admin.main')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Create New Category</h1>

    <nav class="navbar navbar-expand navbar-light bg-white">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ url('category') }}">View All categories</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('category/create') }}">Create New Category</a></li>
        </ul>
    </nav>

    @if (Session::has('category_create'))
        <div class="alert alert-success">
            <em>{!! session('category_create') !!}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="panel-body">
        <!-- Form errors -->
        @include('common.errors')
        
        {!! Form::open(['url' => 'category']) !!}
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! Form::submit('Create Category', ['class' => 'secondary-cart-btn']) !!}
        {!! Form::close() !!}
    </div>
@endsection