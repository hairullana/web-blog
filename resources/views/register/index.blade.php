@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
  <div class="col-lg-5">
    <main class="form-registration">
      <h1 class="text-center h3 mb-3 fw-normal">Registration Form</h1>
      <form action="/register" method="post">
        @csrf
        <div class="form-floating">
          <input type="text" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" name="name" placeholder="full name" required value="{{ old('name') }}">
          <label for="name">Full name</label>
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="usernmame" required value="{{ old('username') }}">
          <label for="username">Username</label>
          @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" required value="{{ old('email') }}">
          <label for="email">Email address</label>
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" name="password" placeholder="password" required>
          <label for="password">Password</label>
          @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
    
        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
      </form>

      <div class="d-block text-center mt-3">
        <small>Already registered? <a href="/register">Login!</a></small>
      </div>
    </main>
  </div>
</div>

@endsection