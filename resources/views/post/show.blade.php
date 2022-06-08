@extends('layouts.blog')

@section('content')
  <div class="mb-5">
    @if ($post->image)
      <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
    @else
      <img src="{{ file_exists(public_path('storage/images/posts/' . $post->id . '.jpg')) ? url('storage/images/posts/' . $post->id . '.jpg') : 'http://ngeewap.xtgem.com/files/hl.jpg' }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
    @endif
    <h1>{{ $post->title }}</h1>
    <p><i class="bi bi-person"></i> <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> <i class="bi bi-calendar3"></i> {{ $post->created_at->diffForHumans() }} <i class="bi bi-tag"></i> <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>


    <article class="my-3 text-justify">
      {!! $post->body !!}
    </article>
    
    <div class="mb-5">
      <div class="section-title section-title-sm position-relative pb-3 mb-4">
          <h3 class="mb-0">3 Comments</h3>
      </div>
      <div class="d-flex mb-4">
          <img src="/img/user.jpg" class="img-fluid rounded" style="width: 45px; height: 45px;">
          <div class="ps-3">
              <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
              <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                  accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
              <button class="btn btn-sm btn-light">Reply</button>
          </div>
      </div>
      <div class="d-flex mb-4">
          <img src="/img/user.jpg" class="img-fluid rounded" style="width: 45px; height: 45px;">
          <div class="ps-3">
              <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
              <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                  accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
              <button class="btn btn-sm btn-light">Reply</button>
          </div>
      </div>
      <div class="d-flex ms-5 mb-4">
          <img src="/img/user.jpg" class="img-fluid rounded" style="width: 45px; height: 45px;">
          <div class="ps-3">
              <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
              <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                  accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
              <button class="btn btn-sm btn-light">Reply</button>
          </div>
      </div>
    </div>
  <!-- Comment List End -->

  <!-- Comment Form Start -->
    <div class="bg-light rounded p-5">
      <div class="section-title section-title-sm position-relative pb-3 mb-4">
          <h3 class="mb-0">Leave A Comment</h3>
      </div>
      <form>
          <div class="row g-3">
              <div class="col-12 col-sm-6">
                  <input type="text" class="form-control bg-white border-0" placeholder="Your Name" style="height: 55px;">
              </div>
              <div class="col-12 col-sm-6">
                  <input type="email" class="form-control bg-white border-0" placeholder="Your Email" style="height: 55px;">
              </div>
              <div class="col-12">
                  <input type="text" class="form-control bg-white border-0" placeholder="Website" style="height: 55px;">
              </div>
              <div class="col-12">
                  <textarea class="form-control bg-white border-0" rows="5" placeholder="Comment"></textarea>
              </div>
              <div class="col-12">
                  <button class="btn btn-primary w-100 py-3" type="submit">Leave Your Comment</button>
              </div>
          </div>
      </form>
    </div>
  </div>
@endsection