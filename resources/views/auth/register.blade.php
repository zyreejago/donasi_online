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
                    
                    <div class="alert alert-danger d-none" id="register-error"></div>
                    <div class="alert alert-success d-none" id="register-success"></div>
                    
                    <form id="registerForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="invalid-feedback" id="name-error"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="invalid-feedback" id="email-error"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback" id="password-error"></div>
                            <small class="text-muted">Password minimal 6 karakter</small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <div class="invalid-feedback" id="password_confirmation-error"></div>
                        </div>
                        
                        <div class="mb-4 form-check">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Saya setuju dengan <a href="#" class="text-primary">syarat dan ketentuan</a>
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-4" id="registerButton">
                            <span id="registerSpinner" class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
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
        
        // Handle register form submission
        const registerForm = document.getElementById('registerForm');
        const registerButton = document.getElementById('registerButton');
        const registerSpinner = document.getElementById('registerSpinner');
        const registerError = document.getElementById('register-error');
        const registerSuccess = document.getElementById('register-success');
        
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Reset error messages
            registerError.classList.add('d-none');
            registerSuccess.classList.add('d-none');
            document.getElementById('name-error').textContent = '';
            document.getElementById('email-error').textContent = '';
            document.getElementById('password-error').textContent = '';
            document.getElementById('password_confirmation-error').textContent = '';
            document.getElementById('name').classList.remove('is-invalid');
            document.getElementById('email').classList.remove('is-invalid');
            document.getElementById('password').classList.remove('is-invalid');
            document.getElementById('password_confirmation').classList.remove('is-invalid');
            
            // Check if passwords match
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            
            if (password !== passwordConfirmation) {
                document.getElementById('password_confirmation').classList.add('is-invalid');
                document.getElementById('password_confirmation-error').textContent = 'Konfirmasi password tidak cocok';
                return;
            }
            
            // Show loading state
            registerButton.disabled = true;
            registerSpinner.classList.remove('d-none');
            
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: password
            };
            
            try {
                const response = await fetch('/api/register', {
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
                            if (data.errors.name) {
                                document.getElementById('name').classList.add('is-invalid');
                                document.getElementById('name-error').textContent = data.errors.name[0];
                            }
                            if (data.errors.email) {
                                document.getElementById('email').classList.add('is-invalid');
                                document.getElementById('email-error').textContent = data.errors.email[0];
                            }
                            if (data.errors.password) {
                                document.getElementById('password').classList.add('is-invalid');
                                document.getElementById('password-error').textContent = data.errors.password[0];
                            }
                        }
                    } else {
                        // Other errors
                        registerError.textContent = data.message || 'Terjadi kesalahan saat mendaftar';
                        registerError.classList.remove('d-none');
                    }
                } else {
                    // Success
                    registerSuccess.textContent = 'Pendaftaran berhasil! Silahkan login.';
                    registerSuccess.classList.remove('d-none');
                    registerForm.reset();
                    
                    // Redirect to login page after successful registration
                    setTimeout(() => {
                        window.location.href = "{{ route('login') }}";
                    }, 2000);
                }
            } catch (error) {
                console.error('Error:', error);
                registerError.textContent = 'Terjadi kesalahan pada server';
                registerError.classList.remove('d-none');
            } finally {
                // Reset loading state
                registerButton.disabled = false;
                registerSpinner.classList.add('d-none');
            }
        });
    });
</script>
@endpush

