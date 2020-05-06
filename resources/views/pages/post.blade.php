@extends('layouts.main')

@section('title', $post->title . ' |')

@section('stylesheets')
<style type="text/css">
    .author-info>small {
        font-size: 0.8rem;
    }
</style>
@endsection

@section('heading')
<header class="masthead" style="background-image: url('{{ Storage::url($post->image) }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-heading">
                    <h1>{{ $post->title }}</h1>
                    <h2 class="subheading">{{ $post->short_desc }}</h2>
                    <span class="meta">Posted by
                    <a href="#">{{ $post->author->name }}</a>
                    on {{ date('F j, Y', strtotime($post->created_at)) }}</span>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                {{ $post->html_content }}
            </div>
        </div>
    </div>
</article>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <hr>
            <h3>Comments 
                @if ($post->approved_comments->count() > 0)
                <small>{{$post->approved_comments->count()}} total</small>
                @endif
            </h3>
            @foreach ($post->approved_comments as $comment)
            <div class="comment mb-4">
                <div class="author-info mb-2">
                    <strong>{{ $comment->name }}</strong>
                    <small class="text-muted m-0 d-block">{{ date('F j, Y h:iA', strtotime($comment->created_at)) }}</small>
                </div>
                <div class="comment-content">{{ $comment->comment }}</div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div id="comment-form" class="col-lg-8 col-md-10 mx-auto">
            {{ Form::open(['route' => ['comments.store', $post], 'method' => 'POST']) }}
            <div class="row">
                <div class="control-group col-md-6">
                    <div class="form-group floating-label-form-group controls">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                    </div>
                </div>
                <div class="control-group col-md-6">
                    <div class="form-group floating-label-form-group controls">
                        {{ Form::label('email', 'E-mail') }}
                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) }}
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                {{ Form::label('comment', 'Comment') }}
                {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Comment']) }}
                </div>
            </div>
            <br>
            <div class="form-group">
            {{ Form::submit('Post Comment', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
    </div>
</div>
@endsection