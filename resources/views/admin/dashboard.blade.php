@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Dashboard</h1>
    </div>
    
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
                            <p class="text-muted mb-1">Terverifikasi</p>
                            <h4 class="fw-bold mb-0">{{ $totalTerverifikasi }}</h4>
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
                            <p class="text-muted mb-1">Pending</p>
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
                            <div class="bg-danger bg-opacity-10 p-3 rounded">
                                <i class="bi bi-x-circle text-danger fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Ditolak</p>
                            <h4 class="fw-bold mb-0">{{ $totalDitolak }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Donasi Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Donatur</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donasiTerbaru as $donasi)
                                <tr>
                                    <td>{{ $donasi->id }}</td>
                                    <td>{{ $donasi->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $donasi->nama_donatur }}</td>
                                    <td>{{ ucfirst($donasi->jenis_donasi) }}</td>
                                    <td>
                                        @if($donasi->status == 'terverifikasi')
                                            <span class="badge bg-success">Terverifikasi</span>
                                        @elseif($donasi->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.donasi.show', $donasi->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3">Belum ada donasi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <a href="{{ route('admin.donasi.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Total Donatur</h5>
                            <div class="d-flex align-items-center mt-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-info bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-people text-info fs-4"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0">{{ $totalUser }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Total Dana</h5>
                            <div class="d-flex align-items-center mt-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-currency-dollar text-success fs-4"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0">Rp {{ number_format($totalDanaUang, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="fw-bold mb-0">Aksi Cepat</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.donasi.index', ['status' => 'pending']) }}" class="btn btn-warning">
                                    <i class="bi bi-hourglass-split me-2"></i> Lihat Donasi Pending
                                </a>
                                <a href="{{ route('admin.settings.index') }}" class="btn btn-primary">
                                    <i class="bi bi-gear me-2"></i> Pengaturan Aplikasi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection