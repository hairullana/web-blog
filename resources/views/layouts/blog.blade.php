<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="blog, spa, vuejs, laravel" name="keywords">
    <meta content="Single Page Application with VueJs and Laravel" name="description">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    {{-- My CSS --}}
    <link href="/css/blog.css" rel="stylesheet">
    <title>{{ $title }} | HL Blog</title>
  </head>
  <body id="page-container">

    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="{{ route('index') }}" class="navbar-brand p-0">
                <h1 class="m-0"><i class="bi bi-newspaper me-2"></i> Web Blog</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ route('index') }}" class="nav-item nav-link">Home</a>
                    <a href="/dashboard/overview" class="nav-item nav-link">Dashboard</a>
                </div>
            </div>
        </nav>

        @if (Route::currentRouteName() == 'index')
            <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="/img/carousel-1.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Web Blog</h5>
                                <h1 class="display-1 text-white mb-md-4 animated zoomIn">SPA with<br/>Laravel & Vue</h1>
                                <a href="https://github.com/hairullana/web-blog" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Source Code</a>
                                <a href="https://hairullana.github.io" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Coder</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
                <div class="row py-5">
                    <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-4 text-white animated zoomIn">Blog Detail</h1>
                        <a href="{{ route('index') }}" class="text-decoration-none h5 text-white">Back to home</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="container mt-4" id="content-wrap">
        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-8">
                        <div class="row g-5">
                            @yield('content')
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @include('partials.sidebar')
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container">
        <div class="row gx-5">
            <div class="col-lg-8 col-md-12 pt-5 mb-5">
                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                    <h3 class="text-light mb-0">About</h3>
                </div>
                <div class="mb-2 text-justify">
                    Web Blog is a simple blog that I created first with a playlist <a class="text-white" href="https://www.youtube.com/watch?v=HqAMb6kqlLs&list=PLFIM0718LjIWiihbBIq-SWPU6b6x21Q_2" target="_blank">Tutorial Laravel 8 - Web Programming Unpas</a>. After a few months, I wanted try to learn about VueJS. So I implement VueJS to this app only in admin dashboard. Don't be hestiate to clone, contribute, open an issue, give a star or fork if you want on <a class="text-white" href="https://github.com/hairullana/web-blog" target="_blank">https://github.com/hairullana/web-blog</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 pt-5 mb-5">
                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                    <h3 class="text-light mb-0">Links</h3>
                </div>
                <div class="d-flex mb-2">
                    <i class="bi bi-person-circle text-primary me-2"></i>
                    Coder: <a href="https://hairullana.github.io" class="text-white mb-0">Hairul Lana</a>
                </div>
                <div class="d-flex mb-2">
                    <i class="bi bi-code-slash text-primary me-2"></i>
                    Source Code: <a href="https://github.com/hairullana/web-blog" class="text-white mb-0">Web Blog</a>
                </div>
                <div class="d-flex mt-4">
                    <a class="btn btn-primary btn-square me-2" href="//github.com/hairullana"><i class="bi-github fw-normal"></i></a>
                    <a class="btn btn-primary btn-square me-2" href="//instagram.com/hairullana_"><i class="bi-instagram fw-normal"></i></a>
                    <a class="btn btn-primary btn-square me-2" href="//facebook.com/hairullana99"><i class="bi-facebook fw-normal"></i></a>
                    <a class="btn btn-primary btn-square" href="//linkedin.com/in/hairullana"><i class="bi-linkedin fw-normal"></i></a>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="container-fluid text-white" style="background: #061429;">
        <div class="container text-center">
            <div class="row justify-content-end">
                <div class="col">
                    <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                        <p class="mb-0">&copy; <a class="text-white border-bottom" href="#">Web Blog</a>. All Rights Reserved. Designed by <a class="text-white border-bottom" href="https://htmlcodex.com">HTML Codex</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')

    {{-- javascript --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
  </body>
</html>