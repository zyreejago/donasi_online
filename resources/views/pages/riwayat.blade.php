@extends('layouts.dashboard')

@section('title', 'Riwayat Donasi')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Riwayat Donasi Anda</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Donasi</th>
                                    <th>Metode</th>
                                    <th>Jumlah/Deskripsi</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donasis as $donasi)
                                <tr>
                                    <td>{{ $donasi->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($donasi->created_at)->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge rounded-pill 
                                            @if($donasi->jenis_donasi == 'zakat') bg-primary 
                                            @elseif($donasi->jenis_donasi == 'infaq') bg-success 
                                            @elseif($donasi->jenis_donasi == 'shodaqoh') bg-info 
                                            @elseif($donasi->jenis_donasi == 'qurban') bg-warning 
                                            @else bg-secondary @endif">
                                            {{ ucfirst($donasi->jenis_donasi) }}
                                        </span>
                                    </td>
                                    <td>{{ ucfirst($donasi->metode_donasi) }}</td>
                                    <td>
                                        @if($donasi->metode_donasi == 'uang')
                                            Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}
                                        @else
                                            {{ $donasi->deskripsi_barang }}
                                        @endif
                                    </td>
                                    <td>{{ ucfirst($donasi->metode_pembayaran) }}</td>
                                    <td>
                                        @if($donasi->status == 'terverifikasi')
                                            <span class="badge bg-success">Terverifikasi</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $donasi->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                
                                <!-- Modal Detail Donasi -->
                                <div class="modal fade" id="detailModal{{ $donasi->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $donasi->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $donasi->id }}">Detail Donasi #{{ $donasi->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <h6 class="fw-bold">Informasi Donasi</h6>
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <td width="40%">ID Donasi</td>
                                                            <td>: {{ $donasi->id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal</td>
                                                            <td>: {{ \Carbon\Carbon::parse($donasi->created_at)->format('d M Y H:i') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nama Donatur</td>
                                                            <td>: {{ $donasi->nama_donatur }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>: {{ $donasi->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jenis Donasi</td>
                                                            <td>: {{ ucfirst($donasi->jenis_donasi) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Metode Donasi</td>
                                                            <td>: {{ ucfirst($donasi->metode_donasi) }}</td>
                                                        </tr>
                                                        @if($donasi->metode_donasi == 'uang')
                                                        <tr>
                                                            <td>Jumlah</td>
                                                            <td>: Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</td>
                                                        </tr>
                                                        @else
                                                        <tr>
                                                            <td>Deskripsi Barang</td>
                                                            <td>: {{ $donasi->deskripsi_barang }}</td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <td>Metode Pembayaran</td>
                                                            <td>: {{ ucfirst($donasi->metode_pembayaran) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status</td>
                                                            <td>: 
                                                                @if($donasi->status == 'terverifikasi')
                                                                    <span class="badge bg-success">Terverifikasi</span>
                                                                @else
                                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                
                                                @if($donasi->status == 'pending')
                                                <div class="alert alert-info">
                                                    <i class="bi bi-info-circle me-2"></i>
                                                    Donasi Anda sedang dalam proses verifikasi. Terima kasih atas kesabaran Anda.
                                                </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                @if($donasi->status == 'pending')
                                                <a href="#" class="btn btn-primary">Konfirmasi Pembayaran</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">Belum ada riwayat donasi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            Menampilkan {{ $donasis->firstItem() ?? 0 }} - {{ $donasis->lastItem() ?? 0 }} dari {{ $donasis->total() ?? 0 }} data
                        </div>
                        <div>
                            {{ $donasis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Statistik Donasi</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="border rounded p-3 text-center">
                                <h6 class="text-muted mb-2">Total Donasi</h6>
                                <h3 class="fw-bold text-primary mb-0">{{ $donasis->total() }}</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border rounded p-3 text-center">
                                <h6 class="text-muted mb-2">Terverifikasi</h6>
                                <h3 class="fw-bold text-success mb-0">{{ $donasis->where('status', 'terverifikasi')->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border rounded p-3 text-center">
                                <h6 class="text-muted mb-2">Pending</h6>
                                <h3 class="fw-bold text-warning mb-0">{{ $donasis->where('status', 'pending')->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border rounded p-3 text-center">
                                <h6 class="text-muted mb-2">Total Donasi (Rp)</h6>
                                <h3 class="fw-bold text-info mb-0">
                                    {{ number_format($donasis->where('metode_donasi', 'uang')->sum('jumlah'), 0, ',', '.') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .pagination {
        margin-bottom: 0;
    }
</style>
@endpush

