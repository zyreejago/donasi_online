@extends('layouts.app')

@section('title', 'Daftar Donatur')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
      <div class="col-md-6">
          <div class="card border-0 shadow-lg">
              <div class="card-body p-5">
                  <div class="text-center mb-4">
                      <h2 class="fw-bold">Daftar Donatur</h2>
                      <p class="text-muted">Buat akun untuk mulai berdonasi</p>
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
                  
                  <form action="{{ route('register') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <label for="name" class="form-label">Nama Lengkap</label>
                          <div class="input-group">
                              <span class="input-group-text"><i class="bi bi-person"></i></span>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                              @error('name')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                              @enderror
                          </div>
                      </div>
                      
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
                      
                      <div class="mb-3">
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
                          <small class="text-muted">Password minimal 6 karakter</small>
                      </div>
                      
                      <div class="mb-4">
                          <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                          <div class="input-group">
                              <span class="input-group-text"><i class="bi bi-lock"></i></span>
                              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                          </div>
                      </div>
                      
                      <div class="mb-4 form-check">
                          <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms" required>
                          <label class="form-check-label" for="terms">
                              Saya setuju dengan <a href="#" class="text-primary">syarat dan ketentuan</a>
                          </label>
                          @error('terms')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                      </div>
                      
                      <button type="submit" class="btn btn-primary w-100 py-2 mb-4">
                          Daftar
                      </button>
                      
                      <div class="text-center">
                          <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login</a></p>
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

