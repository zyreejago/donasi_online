@extends('layouts.app')

@section('title', 'Semua Kegiatan')

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">Kegiatan Yayasan</h1>
                <p class="lead mb-0">Berbagai program dan kegiatan yang telah dan sedang kami laksanakan untuk membantu masyarakat.</p>
            </div>
        </div>
    </div>
</div>

<!-- Kegiatan List -->
<div class="container py-5">
    <div class="row g-4">
        @forelse($kegiatan as $item)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                @if($item->gambar)
                    <img src="{{ asset('storage/images/kegiatan/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
                @else
                    <img src="https://via.placeholder.com/400x250?text={{ urlencode($item->judul) }}" class="card-img-top" alt="{{ $item->judul }}">
                @endif
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge 
                            @if($item->kategori == 'Pendidikan') bg-primary 
                            @elseif($item->kategori == 'Kesehatan') bg-success 
                            @elseif($item->kategori == 'Ekonomi') bg-warning text-dark
                            @elseif($item->kategori == 'Sosial') bg-info
                            @else bg-secondary @endif">
                            {{ $item->kategori }}
                        </span>
                        <small class="text-muted">{{ $item->tanggal->format('d M Y') }}</small>
                    </div>
                    <h4 class="card-title fw-bold mb-3">{{ $item->judul }}</h4>
                    <p class="card-text">{{ Str::limit($item->deskripsi, 100) }}</p>
                </div>
                <div class="card-footer bg-white border-0 p-4 pt-0">
                    <a href="{{ route('kegiatan.detail', $item->id) }}" class="btn btn-outline-primary">Selengkapnya</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="alert alert-info">
                Belum ada kegiatan yang ditampilkan.
            </div>
        </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $kegiatan->links() }}
    </div>
</div>
@endsection

