@extends('layouts.admin')

@section('title', 'Kelola Donasi')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Kelola Donasi</h1>
    </div>
    
    <!-- Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.donasi.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="status" class="form-label">Filter Status</label>
                    <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="terverifikasi" {{ request('status') == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Donasi Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Donatur</th>
                            <th>Email</th>
                            <th>Jenis</th>
                            <th>Metode</th>
                            <th>Jumlah/Deskripsi</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donasis as $donasi)
                        <tr>
                            <td>{{ $donasi->id }}</td>
                            <td>{{ $donasi->created_at->format('d/m/Y') }}</td>
                            <td>{{ $donasi->nama_donatur  }}</td>
                            <td>{{ $donasi->nama_donatur }}</td>
                            <td>{{ $donasi->email }}</td>
                            <td>{{ ucfirst($donasi->jenis_donasi) }}</td>
                            <td>{{ ucfirst($donasi->metode_donasi) }}</td>
                            <td>
                                @if($donasi->metode_donasi == 'uang')
                                    Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}
                                @else
                                    {{ $donasi->deskripsi_barang }}
                                @endif
                            </td>
                            <td>
                                @if($donasi->bukti_pembayaran)
                                    <a href="{{ asset('storage/bukti_pembayaran/' . $donasi->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-success">
                                        <i class="bi bi-image"></i>
                                    </a>
                                @else
                                    <span class="badge bg-secondary">Belum Ada</span>
                                @endif
                            </td>
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
                            <td colspan="10" class="text-center py-3">Tidak ada data donasi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $donasis->links() }}
        </div>
    </div>
</div>
@endsection