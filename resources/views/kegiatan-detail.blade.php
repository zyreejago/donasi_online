@extends('layouts.app')

@section('title', $kegiatan->judul)

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">{{ $kegiatan->judul }}</h1>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge 
                        @if($kegiatan->kategori == 'Pendidikan') bg-light text-primary 
                        @elseif($kegiatan->kategori == 'Kesehatan') bg-light text-success 
                        @elseif($kegiatan->kategori == 'Ekonomi') bg-light text-warning
                        @elseif($kegiatan->kategori == 'Sosial') bg-light text-info
                        @else bg-light text-secondary @endif fs-6 px-3 py-2">
                        {{ $kegiatan->kategori }}
                    </span>
                    <span class="text-white-50">
                        <i class="bi bi-calendar-event me-1"></i> {{ $kegiatan->tanggal->format('d M Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kegiatan Detail -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if($kegiatan->gambar)
                        <img src="{{ asset('storage/images/kegiatan/' . $kegiatan->gambar) }}" class="img-fluid rounded mb-4 w-100" alt="{{ $kegiatan->judul }}">
                    @endif
                    
                    <div class="kegiatan-content">
                        {!! nl2br(e($kegiatan->deskripsi)) !!}
                    </div>
                    
                    <div class="mt-5">
                        <a href="{{ route('kegiatan.all') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Kegiatan
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Kegiatan Lainnya</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @php
                            $otherKegiatan = \App\Models\Kegiatan::where('id', '!=', $kegiatan->id)
                                ->where('aktif', true)
                                ->orderBy('tanggal', 'desc')
                                ->take(5)
                                ->get();
                        @endphp
                        
                        @forelse($otherKegiatan as $other)
                            <a href="{{ route('kegiatan.detail', $other->id) }}" class="list-group-item list-group-item-action p-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 fw-bold">{{ $other->judul }}</h6>
                                    <small class="text-muted">{{ $other->tanggal->format('d M Y') }}</small>
                                </div>
                                <small class="badge 
                                    @if($other->kategori == 'Pendidikan') bg-primary 
                                    @elseif($other->kategori == 'Kesehatan') bg-success 
                                    @elseif($other->kategori == 'Ekonomi') bg-warning text-dark
                                    @elseif($other->kategori == 'Sosial') bg-info
                                    @else bg-secondary @endif">
                                    {{ $other->kategori }}
                                </small>
                            </a>
                        @empty
                            <div class="p-3 text-center text-muted">
                                Tidak ada kegiatan lainnya.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Donasi Sekarang</h5>
                </div>
                <div class="card-body p-4">
                    <p>Bantu kami mewujudkan lebih banyak program kemanusiaan dengan berdonasi sekarang.</p>
                    <div class="d-grid">
                        <a href="{{ route('login') }}" class="btn btn-primary">Donasi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

