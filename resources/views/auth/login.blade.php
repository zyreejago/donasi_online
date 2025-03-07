@extends('layouts.app')

@section('title', 'login')

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
                    
                    <div class="alert alert-danger d-none" id="login-error"></div>
                    <div class="alert alert-success d-none" id="login-success"></div>
                    
                    <form id="loginForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="invalid-feedback" id="email-error"></div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback" id="password-error"></div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat saya
                                </label>
                            </div>
                            <a href="#" class="text-primary">Lupa password?</a>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-4" id="loginButton">
                            <span id="loginSpinner" class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
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
        
        // Handle login form submission
        const loginForm = document.getElementById('loginForm');
        const loginButton = document.getElementById('loginButton');
        const loginSpinner = document.getElementById('loginSpinner');
        const loginError = document.getElementById('login-error');
        const loginSuccess = document.getElementById('login-success');
        
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Reset error messages
            loginError.classList.add('d-none');
            loginSuccess.classList.add('d-none');
            document.getElementById('email-error').textContent = '';
            document.getElementById('password-error').textContent = '';
            document.getElementById('email').classList.remove('is-invalid');
            document.getElementById('password').classList.remove('is-invalid');
            
            // Show loading state
            loginButton.disabled = true;
            loginSpinner.classList.remove('d-none');
            
            const formData = {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            };
            
            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                });
                
                const data = await response.json();
                
                if (!response.ok) {
                    if (response.status === 422) {
                        // Validation errors
                        if (data.errors) {
                            if (data.errors.email) {
                                document.getElementById('email').classList.add('is-invalid');
                                document.getElementById('email-error').textContent = data.errors.email[0];
                            }
                            if (data.errors.password) {
                                document.getElementById('password').classList.add('is-invalid');
                                document.getElementById('password-error').textContent = data.errors.password[0];
                            }
                        }
                    } else if (response.status === 401) {
                        // Unauthorized
                        loginError.textContent = 'Email atau password salah';
                        loginError.classList.remove('d-none');
                    } else {
                        // Other errors
                        loginError.textContent = data.message || 'Terjadi kesalahan saat login';
                        loginError.classList.remove('d-none');
                    }
                } else {
                    // Success
                    loginSuccess.textContent = 'Login berhasil! Mengalihkan...';
                    loginSuccess.classList.remove('d-none');
                    
                    // Store token in localStorage
                    localStorage.setItem('auth_token', data.token);
                    
                    // Redirect to donation page after successful login
                    setTimeout(() => {
                        window.location.href = "{{ route('donasi') }}";
                    }, 1500);
                }
            } catch (error) {
                console.error('Error:', error);
                loginError.textContent = 'Terjadi kesalahan pada server';
                loginError.classList.remove('d-none');
            } finally {
                // Reset loading state
                loginButton.disabled = false;
                loginSpinner.classList.add('d-none');
            }
        });
    });
</script>
@endpush

