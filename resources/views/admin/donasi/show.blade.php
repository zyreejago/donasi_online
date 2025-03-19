@extends('layouts.admin')

@section('title', 'Detail Donasi')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detail Donasi #{{ $donasi->id }}</h1>
        <div>
            <a href="{{ route('admin.donasi.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <!-- Detail Donasi -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Informasi Donasi</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">ID Donasi</div>
                        <div class="col-md-8">{{ $donasi->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Tanggal</div>
                        <div class="col-md-8">{{ $donasi->created_at->format('d F Y, H:i') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nama Donatur</div>
                        <div class="col-md-8">{{ $donasi->nama_donatur }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email</div>
                        <div class="col-md-8">{{ $donasi->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Jenis Donasi</div>
                        <div class="col-md-8">{{ ucfirst($donasi->jenis_donasi) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Metode Donasi</div>
                        <div class="col-md-8">{{ ucfirst($donasi->metode_donasi) }}</div>
                    </div>
                    
                    @if($donasi->metode_donasi == 'uang')
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Jumlah</div>
                        <div class="col-md-8">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</div>
                    </div>
                    @else
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Deskripsi Barang</div>
                        <div class="col-md-8">{{ $donasi->deskripsi_barang }}</div>
                    </div>
                    @endif
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Status</div>
                        <div class="col-md-8">
                            @if($donasi->status == 'terverifikasi')
                                <span class="badge bg-success">Terverifikasi</span>
                            @elseif($donasi->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </div>
                    </div>
                    
                    @if($donasi->catatan_admin)
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Catatan Admin</div>
                        <div class="col-md-8">{{ $donasi->catatan_admin }}</div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Bukti Pembayaran -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Bukti Pembayaran/Pengiriman</h5>
                </div>
                <div class="card-body">
                    @if($donasi->bukti_pembayaran)
                        <div class="text-center">
                            <img src="{{ asset('storage/bukti_pembayaran/' . $donasi->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid mb-3" style="max-height: 400px;">
                            <div>
                                <a href="{{ asset('storage/bukti_pembayaran/' . $donasi->bukti_pembayaran) }}" target="_blank" class="btn btn-primary">
                                    <i class="bi bi-eye"></i> Lihat Gambar Asli
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i> Belum ada bukti pembayaran/pengiriman yang diunggah.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Update Status -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Update Status</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.donasi.update-status', $donasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" {{ $donasi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="terverifikasi" {{ $donasi->status == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                <option value="ditolak" {{ $donasi->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="catatan_admin" class="form-label">Catatan Admin</label>
                            <textarea name="catatan_admin" id="catatan_admin" rows="3" class="form-control">{{ $donasi->catatan_admin }}</textarea>
                            <div class="form-text">Catatan ini akan ditampilkan kepada donatur.</div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i> Update Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Danger Zone -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Danger Zone</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.donasi.destroy', $donasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus donasi ini? Tindakan ini tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i> Hapus Donasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection