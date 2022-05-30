@extends('layouts.blog')

@section('content')
  <!-- Blog Start -->
  <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container py-5">
          <div class="row g-5">
              <!-- Blog list Start -->
              <div class="col-lg-8">
                  <div class="row g-5">
                    @foreach ($posts as $post) 
                      <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                          <div class="blog-item bg-light rounded overflow-hidden">
                              <div class="blog-img position-relative overflow-hidden">
                                  <img class="img-fluid" src="/img/blog-1.jpg" alt="">
                                  <a class="opacity-75 text-decoration-none position-absolute top-0 start-0 bg-dark text-white rounded-end mt-5 py-2 px-4" href="/category/{{ $post->category->slug }}">{{ $post->category->name }}</a>
                              </div>
                              <div class="p-4">
                                  <div class="d-flex mb-3">
                                      <small class="me-3"><i class="bi bi-people text-primary me-2"></i>{{ $post->author->username }}</small>
                                      <small><i class="bi bi-calendar3 text-primary me-2"></i>{{ $post->created_at->diffForHumans() }}</small>
                                  </div>
                                  <h4 class="mb-3">{{ $post->title }}</h4>
                                  <p>{{ $post->excerpt }}</p>
                                  <a href="/post/{{ $post->slug }}" class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                              </div>
                          </div>
                      </div>
                    @endforeach
                      <div class="col-12 wow slideInUp" data-wow-delay="0.1s">
                          <nav aria-label="Page navigation">
                            {{ $posts->links() }}
                          </nav>
                      </div>
                  </div>
              </div>
              <!-- Blog list End -->
  
              <!-- Sidebar Start -->
              <div class="col-lg-4">
                  <!-- Search Form Start -->
                  <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                      <div class="input-group">
                          <input type="text" class="form-control p-3" placeholder="Keyword">
                          <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                      </div>
                  </div>
                  <!-- Search Form End -->
  
                  <!-- Category Start -->
                  <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                      <div class="section-title section-title-sm position-relative pb-3 mb-4">
                          <h3 class="mb-0">Categories</h3>
                      </div>
                      <div class="link-animated d-flex flex-column justify-content-start">
                        @foreach ($categories as $category)  
                          <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2 text-decoration-none" href="/category/{{ $category->slug }}"><i class="bi bi-arrow-right me-2"></i>{{ $category->name }}</a>
                        @endforeach
                      </div>
                  </div>
  
                  {{-- popular post --}}
                  <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                      <div class="section-title section-title-sm position-relative pb-3 mb-4">
                          <h3 class="mb-0">Popular Post</h3>
                      </div>
                      @foreach ($popularPost as $item)
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="/img/blog-1.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <a href="/post/{{ $item->slug }}" class="text-decoration-none h6 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">{{ $item->title }}</a>
                        </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div>    
@endsection