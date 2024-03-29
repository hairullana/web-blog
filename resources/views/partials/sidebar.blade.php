<!-- Search Form Start -->
<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
    <form action="">
        <div class="input-group" action="{{ route('index') }}#listPost">
            @if (request()->has('category'))
                <input type="hidden" name="category" value="{{ request()->get('category') }}">
            @endif
            <input type="text" name="search" class="form-control p-3" placeholder="Keyword" value="{{ request()->get('search') }}">
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
        </div>
    </form>
</div>
<!-- Search Form End -->

<!-- Category Start -->
<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
    <div class="section-title section-title-sm position-relative pb-3 mb-4">
        <h3 class="mb-0">Categories</h3>
    </div>
    <div class="link-animated d-flex flex-column justify-content-start">
    @foreach ($categories as $category)  
        <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2 text-decoration-none" href="{{ route('index') }}/?category={{ $category->slug }}"><i class="bi bi-arrow-right me-2"></i>{{ $category->name }}</a>
    @endforeach
    </div>
</div>

{{-- popular post --}}
<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
    <div class="section-title section-title-sm position-relative pb-3 mb-4">
        <h3 class="mb-0">Popular Post</h3>
    </div>
    @foreach ($popularPost as $item)
    <div class="d-flex rounded overflow-hidden mb-3 w-100 bg-light">
        <img class="img-fluid" src="{{ file_exists(public_path('storage/images/posts/' . $item->id . '.jpg')) ? url('storage/images/posts/' . $item->id . '.jpg') : 'https://icon-library.com/images/no-image-icon/no-image-icon-0.jpg' }}" style="width: 100px; height: 100px; object-fit: cover;">
        <a href="/post/{{ $item->slug }}" class="text-decoration-none h6 fw-semi-bold d-flex align-items-center px-3 mb-0">{{ $item->title }}</a>
    </div>
    @endforeach
</div>