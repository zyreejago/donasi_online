@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h4 class="fw-bold mb-0 text-center">Lupa Password</h4>
                </div>
                <div class="card-body p-4">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <p class="text-center">Masukkan alamat email Anda untuk mendapatkan kode verifikasi reset password.</p>
                    </div>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Kirim Kode Verifikasi
                            </button>
                        </div>
                    </form>

                    <!-- Form Verifikasi Kode (awalnya tersembunyi) -->
                    <div id="verifyCodeSection" class="mt-4 {{ session('email_sent') ? '' : 'd-none' }}">
                        <hr>
                        <h5 class="text-center mb-3">Masukkan Kode Verifikasi</h5>
                        
                        <form method="POST" action="{{ route('password.verify-code') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ session('email') ?? old('email') }}">
                            
                            <div class="mb-3">
                                <label for="code" class="form-label">Kode Verifikasi</label>
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required>
                                @error('code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">
                                    Verifikasi Kode
                                </button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-3">
                            <form method="POST" action="{{ route('password.email') }}" id="resendCodeForm">
                                @csrf
                                <input type="hidden" name="email" value="{{ session('email') ?? old('email') }}">
                                <button type="submit" class="btn btn-link">Kirim Ulang Kode</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('email_sent'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('verifyCodeSection').classList.remove('d-none');
    });
</script>
@endif
@endsection

