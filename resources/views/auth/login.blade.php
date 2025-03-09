@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
      <div class="col-md-6">
          <div class="card border-0 shadow-lg">
              <div class="card-body p-5">
                  <div class="text-center mb-4">
                      <h2 class="fw-bold">Login</h2>
                      <p class="text-muted">Masuk untuk melanjutkan donasi</p>
                  </div>
                  
                  @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  @endif
                  
                  @if(session('error'))
                  <div class="alert alert-danger">
                      {{ session('error') }}
                  </div>
                  @endif
                  
                  <form action="{{ route('login') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <div class="input-group">
                              <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                              @error('email')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                              @enderror
                          </div>
                      </div>
                      
                      <div class="mb-4">
                          <label for="password" class="form-label">Password</label>
                          <div class="input-group">
                              <span class="input-group-text"><i class="bi bi-lock"></i></span>
                              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                              <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                  <i class="bi bi-eye"></i>
                              </button>
                              @error('password')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                              @enderror
                          </div>
                      </div>
                      
                      <div class="d-flex justify-content-between align-items-center mb-4">
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="remember" name="remember">
                              <label class="form-check-label" for="remember">
                                  Ingat saya
                              </label>
                          </div>
                          <a href="" class="text-primary">Lupa password?</a>
                      </div>
                      
                      <button type="submit" class="btn btn-primary w-100 py-2 mb-4">
                          Login
                      </button>
                      
                      <div class="text-center">
                          <p>Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar sekarang</a></p>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
      // Toggle password visibility
      const togglePassword = document.getElementById('togglePassword');
      const password = document.getElementById('password');
      
      togglePassword.addEventListener('click', function() {
          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
          password.setAttribute('type', type);
          this.querySelector('i').classList.toggle('bi-eye');
          this.querySelector('i').classList.toggle('bi-eye-slash');
      });
  });
</script>
@endpush

