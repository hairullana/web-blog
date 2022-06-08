@extends('layouts.blog')

@section('content')
  @foreach ($posts as $post) 
    <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
        <div class="blog-item bg-light rounded overflow-hidden">
            <div class="blog-img position-relative overflow-hidden">
                <img class="img-fluid" src="{{ file_exists(public_path('storage/images/posts/' . $post->id . '.jpg')) ? url('storage/images/posts/' . $post->id . '.jpg') : 'http://ngeewap.xtgem.com/files/hl.jpg' }}" alt="">
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
  <div class="col-12">
      <nav aria-label="Page navigation">
        {{ $posts->links() }}
      </nav>
  </div>

  @push('scripts')
    <script>
      if({{ request()->hasAny('search', 'category') }}){
        document.getElementById('content-wrap').scrollIntoView();
      }
    </script>
  @endpush
@endsection