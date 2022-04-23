@extends('layouts.main')

@section('container')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 mb-5">
      <h2>{{ $post->title }}</h2>
      <p>By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>

      @if ($post->image)
          <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
      @else
        <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
      @endif

      <article class="my-3">
        {!! $post->body !!}
      </article>
      
        <a href="/posts" class="text-decoration-none d-block">Back to Posts</a>
      </div>
    </div>
  </div>


@endsection