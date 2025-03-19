@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <h1 class="h3 mb-4">Dashboard Admin</h1>
    
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-cash-coin text-primary fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Total Donasi</p>
                            <h4 class="fw-bold mb-0">{{ $totalDonasi }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-check-circle text-success fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Donasi Terverifikasi</p>
                            <h4 class="fw-bold mb-0">{{ $totalVerified }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-hourglass-split text-warning fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Donasi Pending</p>
                            <h4 class="fw-bold mb-0">{{ $totalPending }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="bi bi-people text-info fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Total Pengguna</p>
                            <h4 class="fw-bold mb-0">{{ $totalUsers }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Amount -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Total Donasi Terkumpul</h5>
                    <h2 class="display-6 fw-bold text-primary">Rp {{ number_format($totalAmount, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Latest Donations -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Donasi Terbaru</h5>
                    <a href="{{ route('admin.transactions') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestDonations as $donasi)
                                <tr>
                                    <td>{{ $donasi->id }}</td>
                                    <td>{{ $donasi->created_at->format('d M Y') }}</td>
                                    <td>{{ $donasi->nama_donatur }}</td>
                                    <td>{{ $donasi->email }}</td>
                                    <td>{{ ucfirst($donasi->jenis_donasi) }}</td>
                                    <td>
                                        @if($donasi->metode_donasi == 'uang')
                                            Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}
                                        @else
                                            {{ $donasi->deskripsi_barang }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($donasi->status == 'terverifikasi')
                                            <span class="badge bg-success">Terverifikasi</span>
                                        @elseif($donasi->status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.transactions.show', $donasi->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">Belum ada data donasi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

