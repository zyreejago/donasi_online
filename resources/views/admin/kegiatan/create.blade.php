@extends('layouts.admin')

@section('title', isset($kegiatan) ? 'Edit Kegiatan' : 'Tambah Kegiatan')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">{{ isset($kegiatan) ? 'Edit Kegiatan' : 'Tambah Kegiatan' }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($kegiatan) ? route('admin.kegiatan.update', $kegiatan->id) : route('admin.kegiatan.store') }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($kegiatan))
                            @method('PUT')
                        @endif
                    
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Kegiatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" 
                                   value="{{ old('judul', $kegiatan->judul ?? '') }}" 
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                <option value="" disabled {{ !isset($kegiatan) ? 'selected' : '' }}>Pilih Kategori</option>
                                @php
                                    $kategoriOptions = ['Pendidikan', 'Kesehatan', 'Ekonomi', 'Sosial', 'Lingkungan'];
                                @endphp
                                @foreach($kategoriOptions as $option)
                                    <option value="{{ $option }}" {{ old('kategori', $kegiatan->kategori ?? '') == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Kegiatan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                   id="tanggal" name="tanggal" 
                                   value="{{ old('tanggal', isset($kegiatan) ? $kegiatan->tanggal->format('Y-m-d') : '') }}" 
                                   required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $kegiatan->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Kegiatan</label>
                            @if(isset($kegiatan) && $kegiatan->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/images/kegiatan/' . $kegiatan->gambar) }}" 
                                         alt="{{ $kegiatan->judul }}" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                                   id="gambar" name="gambar">
                            <div class="form-text">Format: JPG, PNG, JPEG. Maks: 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</div>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="aktif" name="aktif" value="1" 
                                       {{ old('aktif', $kegiatan->aktif ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="aktif">
                                    Aktif (Tampilkan di website)
                                </label>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                {{ isset($kegiatan) ? 'Simpan Perubahan' : 'Tambah Kegiatan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
