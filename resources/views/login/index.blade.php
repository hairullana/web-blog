@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
  <div class="col-md-5">
    <main class="form-signin">
      <h1 class="text-center h3 mb-3 fw-normal">Please login</h1>

      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @if(session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <form action="/login" method="post">
        @csrf
        <div class="form-floating">
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" required value="{{ @old('email') }}" autofocus>
          <label for="email">Email address</label>
          @error('email')
            <div class="invalid-feedback text-danger">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
          <label for="password">Password</label>
          @error('password')
            <div class="invalid-feedback text-danger">
              {{ $message }}
            </div>
          @enderror
        </div>
    
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
      </form>

      <div class="d-block text-center mt-3">
        <small>Not registered? <a href="/register">Register now!</a></small>
      </div>
    </main>
  </div>
</div>

@endsection