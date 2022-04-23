{{-- @dd($posts) --}}

@extends('layouts.main')

@section('container')
  <h1 class="mb-3 text-center">{{ $title }}</h1>

  {{-- searching --}}
  <div class="row justify-content-center mb-3">
    <div class="col-6">
      <form action="/posts">
        <div class="input-group mb-3">
          @if(request('category'))
            <input type="hidden" value="{{ request('category') }}" name="category">
          @endif
          @if(request('author'))
            <input type="hidden" value="{{ request('author') }}" name="author">
          @endif
          <input type="text" class="form-control" placeholder="Keywords" name="search" value="{{ request('search') }}">
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </form>
    </div>
  </div>

  @if($posts->count())
    <div class="card mb-3">
      @if ($posts[0]->image)
        <div style="max-height:350px;overflow:hidden;">
          <img src="{{ asset('storage/' . $posts[0]->image) }}" class="img-fluid mt-3" alt="{{ $posts[0]->category->name }}">
        </div>
      @else
        <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="img-fluid mt-3" alt="{{ $posts[0]->category->name }}">
      @endif
      <div class="card-body text-center">
        <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>

        <small class="text-muted">By <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}</small>

        <p class="card-text">{{ $posts[0]->excerpt }}</p>

        <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Readmore</a>
      </div>
    </div>


    <div class="container">
      <div class="row">
        @foreach ($posts->skip(1) as $post)
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="position-absolute px-3 py-2 text-white" style="background:rgba(0,0,0,0.7)"><a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none text-white">{{ $post->category->name }}</a></div>
              @if ($post->image)
                  <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
              @else
                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
              @endif
              <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <small class="text-muted">By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }}</small>
                <p class="card-text">{{ $post->excerpt }}</p>
                <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Readmore</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @else
    <h3 class="text-center">Post not found.</h3>
  @endif

  <div class="d-flex justify-content-center">
    {{ $posts->links() }}
  </div>

@endsection