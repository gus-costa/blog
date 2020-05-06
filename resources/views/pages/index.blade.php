@extends('layouts.main')

@section('heading')
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Gus Costa</h1>
                    <span class="subheading">Laravel and Angular</span>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
    @foreach ($posts as $post)
    <div class="post-preview">
        <a href="{{ route('post.view', ['post' => $post]) }}">
        <h2 class="post-title">
            {{$post->title}}
        </h2>
        <h3 class="post-subtitle">
            {{$post->short_desc}}
        </h3>
        </a>
        <p class="post-meta">Posted by
        <a href="#">{{$post->author->name}}</a>
        on {{ date('F j, Y', strtotime($post->created_at)) }}</p>
    </div>
    <hr>
    @endforeach
    <!-- Pager -->
    <div class="clearfix">
        @if (!$posts->onFirstPage())
        <a class="btn btn-primary float-left" href="{{ $posts->previousPageUrl() }}">&larr; Newer Posts</a>
        @endif
        @if ($posts->hasMorePages())
        <a class="btn btn-primary float-right" href="{{ $posts->nextPageUrl() }}">Older Posts &rarr;</a>
        @endif
    </div>
</div>
</div>
</div>

@endsection