@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Posts</h1>

    <nav class="navbar navbar-expand navbar-light bg-white">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('post.index') }}">View All Posts</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('post.create') }}">Create New Post</a></li>
        </ul>
    </nav>

    @include('common.messages')

    @if (count($posts) > 0)
        <div class="card">
            <div class="card-header">
                All Posts
            </div>
            <div class="card-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Title</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td><a href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a></td>
                            <td>
                                {!! Form::open(['route' => ['post.destroy', $post->id], 'method' => 'DELETE']) !!}
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