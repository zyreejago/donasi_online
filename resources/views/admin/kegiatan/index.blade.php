@extends('layouts.admin')

@section('title', 'Kelola Kegiatan')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Kegiatan</h1>
        <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kegiatan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatan as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/images/kegiatan/' . $item->gambar) }}" alt="{{ $item->judul }}" class="img-thumbnail" width="80">
                                    @else
                                        <img src="https://via.placeholder.com/80x60?text=No+Image" alt="No Image" class="img-thumbnail" width="80">
                                    @endif
                                </td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                    <span class="badge 
                                        @if($item->kategori == 'Pendidikan') bg-primary 
                                        @elseif($item->kategori == 'Kesehatan') bg-success 
                                        @elseif($item->kategori == 'Ekonomi') bg-warning text-dark
                                        @else bg-secondary @endif">
                                        {{ $item->kategori }}
                                    </span>
                                </td>
                                <td>{{ $item->tanggal->format('d M Y') }}</td>
                                <td>
                                    @if($item->aktif)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.kegiatan.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.kegiatan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Belum ada data kegiatan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-end">
                {{ $kegiatan->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

