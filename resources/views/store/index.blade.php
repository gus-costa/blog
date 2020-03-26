@extends('layouts.main')

@section('heading')
<div class="site-heading">
    <h1>Gus Costa</h1>
    <span class="subheading">Laravel and Angular</span>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
    @foreach ($posts as $post)
    <div class="post-preview">
        <a href="{{ url('view/'.$post->id) }}">
        <h2 class="post-title">
            {{$post->title}}
        </h2>
        <h3 class="post-subtitle">
            {{$post->short_desc}}
        </h3>
        </a>
        <p class="post-meta">Posted by
        <a href="#">{{$post->author}}</a>
        on {{ date('F j, Y', strtotime($post->created_at)) }}</p>
    </div>
    <hr>
    @endforeach
    <!-- Pager -->
    <div class="clearfix">
        <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
    </div>
</div>
</div>
</div>

@endsection