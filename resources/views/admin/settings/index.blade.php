@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Pengaturan Aplikasi</h1>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Pengaturan Umum</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nama_lembaga" class="form-label">Nama Lembaga</label>
                            <input type="text" class="form-control @error('nama_lembaga') is-invalid @enderror" id="nama_lembaga" name="nama_lembaga" value="{{ $settings['nama_lembaga'] }}" required>
                            @error('nama_lembaga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman Barang</label>
                            <textarea class="form-control @error('alamat_pengiriman') is-invalid @enderror" id="alamat_pengiriman" name="alamat_pengiriman" rows="3" required>{{ $settings['alamat_pengiriman'] }}</textarea>
                            @error('alamat_pengiriman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Alamat ini akan ditampilkan kepada donatur yang memilih metode donasi barang.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ $settings['telepon'] }}" required>
                            @error('telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Kontak</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $settings['email'] }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="qris_image" class="form-label">QRIS Pembayaran</label>
                            
                            @if($settings['qris_image'])
                                <div class="mb-3">
                                    <img src="{{ asset('storage/settings/' . $settings['qris_image']) }}" alt="QRIS" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif
                            
                            <input type="file" class="form-control @error('qris_image') is-invalid @enderror" id="qris_image" name="qris_image" accept="image/*">
                            @error('qris_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: JPG, PNG, JPEG. Maks: 2MB. Kosongkan jika tidak ingin mengubah.</div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i> Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Informasi</h5>
                </div>
                <div class="card-body">
                    <p>Pengaturan ini akan digunakan di seluruh aplikasi, termasuk:</p>
                    <ul>
                        <li>Alamat pengiriman untuk donasi barang</li>
                        <li>QRIS untuk pembayaran donasi uang</li>
                        <li>Informasi kontak lembaga</li>
                    </ul>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i> Pastikan informasi yang dimasukkan sudah benar dan valid.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection