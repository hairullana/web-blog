@extends('dashboard.layouts.main')

@section('container')
  <div class="container">
    <div class="row">
      <div class="col-lg-8 my-3">
      <h2>{{ $post->title }}</h2>
      
      <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back to my posts</a>
      <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
      <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
      </form>

      @if ($post->image)
        <div style="max-height:350px;overflow:hidden;">
          <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
        </div>
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