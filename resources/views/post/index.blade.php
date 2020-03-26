@extends('admin.main')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Posts</h1>

    <nav class="navbar navbar-expand navbar-light bg-white">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ url('post') }}">View All Posts</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('post/create') }}">Create New Post</a></li>
        </ul>
    </nav>

    @if (Session::has('post_update'))
    <div class="alert alert-success">
        <em>{!! session('post_update') !!}</em>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (Session::has('post_delete'))
    <div class="alert alert-success">
        <em>{!! session('post_delete') !!}</em>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

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
                            <td><a href="{{ url('post/' . $post->id . '/edit') }}">Edit</a></td>
                            <td>
                                {!! Form::open(['url' => 'post/' . $post->id, 'method' => 'DELETE']) !!}
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
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