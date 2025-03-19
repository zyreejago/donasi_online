@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 text-center">Verifikasi Kode</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-muted mb-4">Kami telah mengirimkan kode verifikasi ke email <strong>{{ session('email') }}</strong>. Masukkan kode tersebut di bawah ini.</p>

                    <form method="POST" action="{{ route('password.verify.code') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">

                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Verifikasi</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required autofocus placeholder="Masukkan kode 6 digit" maxlength="6" inputmode="numeric" pattern="[0-9]*">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Kode verifikasi berlaku selama 15 menit.</small>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="bi bi-check-circle me-2"></i> Verifikasi Kode
                            </button>
                            <a href="{{ route('password.request') }}" class="btn btn-outline-secondary py-2">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle text-primary me-3 fs-4"></i>
                        <div>
                            <p class="mb-0">Tidak menerima kode? Periksa folder spam atau <a href="{{ route('password.request') }}" class="text-decoration-none">kirim ulang kode</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection