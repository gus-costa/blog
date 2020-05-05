@extends('layouts.admin')

@section('title', '| Comments')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Comments</h1>
    @include('common.messages')

    @if (count($comments) > 0)
        <div class="card">
            <div class="card-header">
                Pending approval
            </div>
            <div class="card-body">
                <table class="table table-striped task-table">
                    <colgroup>
                        <col>
                        <col>
                        <col>
                        <col style="width: 90px">
                        <col style="width: 90px">
                    </colgroup>
                    <thead>
                        <th>Post</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Comment</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                        <tr>
                            <td><a href="{{ route('post.view', ['slug' => $comment->post->slug]) }}" target="_blank">{{ $comment->post->title }}</a></td>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->comment }}</td>
                            <td>
                                {!! Form::open(['route' => ['comments.approve', $comment->id], 'method' => 'POST']) !!}
                                <button class="btn btn-success" type="submit">Approve</button>
                                {!! Form::close() !!}
                            </td>
                            <td>
                                {!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) !!}
                                <button class="btn btn-danger" type="submit">Delete</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p class="text-center">There are no comments pending approval.</p>
    @endif
@endsection