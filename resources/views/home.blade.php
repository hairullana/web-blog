@extends('layouts.main')

@section('container')
<div class="container">
  <h1 class="mb-3 text-center">Blog Post</h1>
  <div class="row">
    @foreach ($posts as $post)
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="position-absolute px-3 py-2 text-white"><a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none text-white">{{ $post->category->name }}</a></div>
          <img src="https://source.unsplash.com/500x400?news" class="img-fluid mt-3">
          <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <small class="text-muted">By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> {{ $post->created_at }}</small>
            <p class="card-text">{{ $post->excerpt }}</p>
            <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Readmore</a>
          </div>
        </div>
      </div>
    @endforeach

    <div class="card-footer pb-3 pt-3 d-flex justify-content-center">
      {{ $posts->links() }}
    </div>
  </div>
</div>
@endsection