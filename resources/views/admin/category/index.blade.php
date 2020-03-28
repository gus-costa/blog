@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Category Control</h1>

    <nav class="navbar navbar-expand navbar-light bg-white">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('category.index') }}">View All categories</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('category.create') }}">Create New Category</a></li>
        </ul>
    </nav>

    @if (Session::has('category_update'))
    <div class="alert alert-success">
        <em>{!! session('category_update') !!}</em>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (Session::has('category_delete'))
    <div class="alert alert-success">
        <em>{!! session('category_delete') !!}</em>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (count($categories) > 0)
        <div class="card">
            <div class="card-header">
                All Categories
            </div>
            <div class="card-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Category</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td><a href="{{ route('category.edit', ['category' => $category->id]) }}">Edit</a></td>
                            <td>
                                {!! Form::open(['route' => ['category.destroy', $category->id], 'method' => 'DELETE']) !!}
                                {!! csrf_field() !!}
                                <button class="btn btn-danger" type="submit">Delete</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection