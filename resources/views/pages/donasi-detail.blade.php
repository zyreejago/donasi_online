@extends('layouts.dashboard')

@section('title', 'Detail Donasi')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Detail Donasi #{{ $donasi->id }}</h5>
                    <a href="{{ route('riwayat') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Informasi Donasi</h6>
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
                        
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Pembayaran</h6>
                            
                            @if(!$donasi->bukti_pembayaran)
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Anda belum mengunggah bukti pembayaran.
                            </div>
                            
                            <div class="text-center mb-4">
                                <h6 class="fw-bold">Silahkan Scan QRIS di bawah ini</h6>
                                <div class="my-3">
                                    <img src="{{ asset('images/qris-code.png') }}" alt="QRIS Code" class="img-fluid" style="max-width: 200px;">
                                </div>
                                
                                <div class="alert alert-info">
                                    <p class="mb-0"><strong>Total Pembayaran: 
                                        @if($donasi->metode_donasi == 'uang')
                                            Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </strong></p>
                                </div>
                            </div>
                            
                            <form action="{{ route('donasi.upload-bukti', $donasi->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                                    <div class="form-text">Format: JPG, PNG, JPEG. Maks: 2MB</div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Upload Bukti Pembayaran</button>
                                </div>
                            </form>
                            @else
                            <div class="text-center">
                                <div class="mb-3">
                                    <img src="{{ asset('storage/bukti_pembayaran/' . $donasi->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded" style="max-height: 300px;">
                                </div>
                                
                                <a href="{{ asset('storage/bukti_pembayaran/' . $donasi->bukti_pembayaran) }}" download class="btn btn-sm btn-primary">
                                    <i class="bi bi-download"></i> Download Bukti
                                </a>
                                
                                @if($donasi->status == 'pending')
                                <div class="alert alert-info mt-3">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Donasi Anda sedang dalam proses verifikasi. Terima kasih atas kesabaran Anda.
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

