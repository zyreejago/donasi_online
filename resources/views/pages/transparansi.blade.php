@extends('layouts.app')

@section('title', 'Transparansi Donasi')

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Transparansi Donasi</h1>
                <p class="lead mb-0">Kami berkomitmen untuk transparan dalam pengelolaan setiap donasi yang diterima. Berikut adalah laporan penggunaan dana donasi yang telah kami terima.</p>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="{{ asset('images/transparency.jpg') }}" alt="Transparansi Donasi" class="img-fluid rounded-4 shadow">
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="container py-5">
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="display-5 fw-bold text-primary mb-2">{{ $totalDonasi }}</div>
                    <p class="text-muted mb-0">Total Donasi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="display-5 fw-bold text-success mb-2">{{ $totalTerverifikasi }}</div>
                    <p class="text-muted mb-0">Donasi Terverifikasi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="display-5 fw-bold text-warning mb-2">{{ $totalPending }}</div>
                    <p class="text-muted mb-0">Donasi Pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <div class="display-5 fw-bold text-info mb-2">Rp {{ number_format($totalJumlah, 0, ',', '.') }}</div>
                    <p class="text-muted mb-0">Total Dana Terkumpul</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Filter Data</h5>
            <form action="{{ route('transparansi') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="jenis_donasi" class="form-label">Jenis Donasi</label>
                    <select class="form-select" id="jenis_donasi" name="jenis_donasi">
                        <option value="">Semua Jenis</option>
                        <option value="zakat" {{ request('jenis_donasi') == 'zakat' ? 'selected' : '' }}>Zakat</option>
                        <option value="infaq" {{ request('jenis_donasi') == 'infaq' ? 'selected' : '' }}>Infaq</option>
                        <option value="shodaqoh" {{ request('jenis_donasi') == 'shodaqoh' ? 'selected' : '' }}>Shodaqoh</option>
                        <option value="qurban" {{ request('jenis_donasi') == 'qurban' ? 'selected' : '' }}>Qurban</option>
                        <option value="wakaf" {{ request('jenis_donasi') == 'wakaf' ? 'selected' : '' }}>Wakaf</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="terverifikasi" {{ request('status') == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="month" class="form-control" id="tanggal" name="tanggal" value="{{ request('tanggal') }}">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('transparansi') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Donation Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Daftar Donasi</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama Donatur</th>
                            <th scope="col">Jenis Donasi</th>
                            <th scope="col">Metode</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donasis as $donasi)
                        <tr>
                            <td>{{ $donasi->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($donasi->created_at)->format('d M Y') }}</td>
                            <td>{{ $donasi->nama_donatur }}</td>
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
                            <td>
                                @if($donasi->status == 'terverifikasi')
                                    <span class="badge bg-success">Terverifikasi</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Belum ada data donasi</td>
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
                    {{ $donasis->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Allocation Section -->
    {{-- <div class="row mt-5">
        <div class="col-12 mb-4">
            <h2 class="fw-bold">Alokasi Dana Donasi</h2>
            <p class="text-muted">Berikut adalah alokasi penggunaan dana donasi yang telah kami terima</p>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Distribusi Dana</h5>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Pendidikan</span>
                            <span>30%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Kesehatan</span>
                            <span>25%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Pemberdayaan Ekonomi</span>
                            <span>20%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Bantuan Sosial</span>
                            <span>15%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Operasional</span>
                            <span>10%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Program Terlaksana</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Program</th>
                                    <th>Tanggal</th>
                                    <th>Dana Terpakai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Beasiswa Pendidikan</td>
                                    <td>15 Jan 2023</td>
                                    <td>Rp 25.000.000</td>
                                </tr>
                                <tr>
                                    <td>Pengobatan Gratis</td>
                                    <td>22 Feb 2023</td>
                                    <td>Rp 18.500.000</td>
                                </tr>
                                <tr>
                                    <td>Bantuan Bencana</td>
                                    <td>10 Mar 2023</td>
                                    <td>Rp 30.000.000</td>
                                </tr>
                                <tr>
                                    <td>Pelatihan UMKM</td>
                                    <td>05 Apr 2023</td>
                                    <td>Rp 15.000.000</td>
                                </tr>
                                <tr>
                                    <td>Pembangunan Masjid</td>
                                    <td>20 May 2023</td>
                                    <td>Rp 50.000.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<!-- CTA Section -->
<div class="bg-primary text-white py-5 mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-3">Bergabunglah Dalam Kebaikan</h2>
                <p class="lead mb-0">Donasi Anda akan membuat perbedaan besar bagi mereka yang membutuhkan. Mari berbagi kebaikan bersama.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('donasi') }}" class="btn btn-light btn-lg me-2 mb-2 mb-md-0">Donasi Sekarang</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Daftar Donatur</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Pagination Styling */
    .pagination {
        margin-bottom: 0;
    }
    
    .pagination .page-item .page-link {
        border-radius: 4px;
        margin: 0 2px;
        color: #333;
        font-weight: 500;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    /* Next/Previous buttons styling */
    .pagination .page-item .prev-link,
    .pagination .page-item .next-link {
        background-color: #f8f9fa;
        color: #333;
        font-weight: 600;
        padding: 8px 16px;
        border: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .pagination .page-item .prev-link:hover,
    .pagination .page-item .next-link:hover {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }
    
    .pagination .page-item.disabled .prev-link,
    .pagination .page-item.disabled .next-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
</style>
@endpush

