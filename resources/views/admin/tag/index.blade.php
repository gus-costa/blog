@extends('layouts.admin')

@section('title', '| Tags')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Tags</h1>

    @include('common.messages')

    <div class="card">
        @isset($tag)
        <div class="card-header">Edit Tag</div>
        @else
        <div class="card-header">New Tag</div>
        @endisset
        <div class="card-body">
            @isset($tag)
            {{ Form::model($tag, ['route' => ['tag.update', $tag->id], 'method' => 'PUT'] )}}
            @else
            {{ Form::open(['route' => 'tag.store', 'method' => 'POST'] )}}
            @endisset
            <div class="form-group">
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
            @isset($tag)
            {{ Form::submit('Save', ['class' => 'btn btn-primary'])}}
            @else
            {{ Form::submit('Create', ['class' => 'btn btn-primary'])}}
            @endisset
            {{ Form::close() }}
        </div>
    </div>

    @if (count($tags) > 0)
        <div class="card">
            <div class="card-header">
                All Tags
            </div>
            <div class="card-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Name</th>
                        <th># Posts</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->posts->count() }}</td>
                            <td><a href="{{ route('tag.edit', ['tag' => $tag->id]) }}">Edit</a></td>
                            <td>
                                {!! Form::open(['route' => ['tag.destroy', $tag->id], 'method' => 'DELETE']) !!}
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