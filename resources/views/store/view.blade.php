@extends('layouts.main')

@section('heading')
<div class="post-heading">
    <h1>{{ $post->title }}</h1>
    <h2 class="subheading">{{ $post->short_desc }}</h2>
    <span class="meta">Posted by
      <a href="#">{{ $post->author }}</a>
      on {{ date('F j, Y', strtotime($post->created_at)) }}</span>
</div>
@endsection

@section('content')
<article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          {!! $post->description !!}
        </div>
      </div>
    </div>
</article>
@endsection