@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section with Background Image -->
<div class="container-fluid px-0">
    <div class="hero-banner position-relative">
        <div class="bg-image" style="background-image: url('{{ asset('storage/images/kegiatan/hero-bg.jpg') }}'); height: 500px; background-size: cover; background-position: center; position: relative;">

            <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6);"></div>
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-md-8 text-white position-relative">
                        <h1 class="display-4 fw-bold mb-4">Selamat Datang di Yayasan Kami</h1>
                        <p class="lead fs-4 mb-4">Bersama kita bisa membantu lebih banyak orang yang membutuhkan. Mari bergabung dalam misi kemanusiaan kami.</p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-3 fw-semibold">Donasi Sekarang</a>
                            <a href="#tentang-kami" class="btn btn-outline-light btn-lg px-4 py-3">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Stats Counter Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="counter-item">
                    <div class="display-4 fw-bold text-primary">5+</div>
                    <p class="lead mb-0">Tahun Pengalaman</p>
                </div>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="counter-item">
                    <div class="display-4 fw-bold text-primary">1000+</div>
                    <p class="lead mb-0">Penerima Bantuan</p>
                </div>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="counter-item">
                    <div class="display-4 fw-bold text-primary">50+</div>
                    <p class="lead mb-0">Program Aktif</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="counter-item">
                    <div class="display-4 fw-bold text-primary">200+</div>
                    <p class="lead mb-0">Relawan</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tentang Kami Section -->
<div id="tentang-kami" class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <img src="{{ asset('storage/images/kegiatan/about-us.jpg') }}" alt="Tentang Yayasan Kami" class="img-fluid rounded-4 shadow">
        </div>
        <div class="col-lg-6">
            <div class="ps-lg-4">
                <h6 class="text-primary fw-bold mb-3">TENTANG KAMI</h6>
                <h2 class="display-6 fw-bold mb-4">Sejarah Kami</h2>
                <p class="lead">Yayasan ini didirikan pada tahun 2018 oleh sekelompok relawan yang peduli terhadap masalah sosial dan kemanusiaan di Indonesia.</p>
                <p>Berawal dari kegiatan sosial kecil-kecilan di daerah terpencil, kini Yayasan kami telah berkembang menjadi organisasi nirlaba yang fokus pada pendidikan, kesehatan, dan pemberdayaan masyarakat kurang mampu.</p>
                <p>Dengan dukungan dari berbagai pihak, kami berkomitmen untuk terus memberikan bantuan kepada mereka yang membutuhkan dan menciptakan perubahan positif di masyarakat.</p>
                <a href="{{ route('layanan') }}" class="btn btn-outline-primary mt-3">Baca Selengkapnya</a>
            </div>
        </div>
    </div>
</div>

<!-- Visi & Misi Section -->
<div class="bg-primary bg-opacity-10 py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold">VISI & MISI</h6>
            <h2 class="display-6 fw-bold">Tujuan Kami</h2>
            <p class="lead mx-auto" style="max-width: 700px;">Kami berkomitmen untuk menciptakan masyarakat yang lebih baik melalui berbagai program sosial dan kemanusiaan.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <div class="feature-icon bg-primary bg-opacity-10 p-3 rounded-circle mb-4" style="width: fit-content;">
                            <i class="bi bi-eye-fill text-primary fs-4"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Visi</h3>
                        <p>Menjadi yayasan terdepan dalam memberikan bantuan sosial dan kemanusiaan yang berkelanjutan, serta menciptakan masyarakat yang mandiri, sejahtera, dan berkeadilan.</p>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Membangun masyarakat yang mandiri</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Meningkatkan kualitas pendidikan</li>
                            <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Mewujudkan keadilan sosial</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <div class="feature-icon bg-primary bg-opacity-10 p-3 rounded-circle mb-4" style="width: fit-content;">
                            <i class="bi bi-bullseye text-primary fs-4"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Misi</h3>
                        <p>Menjalankan program-program sosial dan kemanusiaan yang berdampak positif bagi masyarakat, terutama mereka yang kurang beruntung.</p>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Memberikan bantuan pendidikan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Meningkatkan akses kesehatan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Pemberdayaan ekonomi masyarakat</li>
                            <li><i class="bi bi-check-circle-fill text-primary me-2"></i> Tanggap bencana</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kegiatan Yayasan Section -->
<section class="container my-5">
    <h2 class="fw-bold text-center mb-4">Kegiatan Terbaru</h2>
    <div class="row">
        @forelse($kegiatan ??[] as $item)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    @if($item->gambar)
                        <img src="{{ asset('storage/images/kegiatan/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
                    @else
                        <img src="https://via.placeholder.com/400x250?text={{ urlencode($item->judul) }}" class="card-img-top" alt="{{ $item->judul }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                        <p class="card-text">{{ Str::limit($item->deskripsi, 100) }}</p>
                        <a href="{{ route('kegiatan.detail', $item->id) }}" class="btn btn-outline-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada kegiatan.</p>
        @endforelse
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('kegiatan.all') }}" class="btn btn-primary">Lihat Semua Kegiatan</a>
    </div>
</section>


<!-- CTA Section -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-3">Bergabunglah Bersama Kami</h2>
                <p class="lead mb-0">Mari bersama-sama membantu mereka yang membutuhkan. Setiap bantuan Anda sangat berarti.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('login') }}" class="btn btn-light btn-lg me-2 mb-2 mb-md-0">Donasi Sekarang</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Daftar Donatur</a>
            </div>
        </div>
    </div>
</div>

<!-- Alamat Section -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h2 class="fw-bold mb-4">Hubungi Kami</h2>
            <p class="mb-4">Jika Anda memiliki pertanyaan atau ingin berkolaborasi dengan kami, jangan ragu untuk menghubungi kami.</p>
            
            <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <i class="bi bi-geo-alt-fill text-primary fs-4 me-3"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Alamat</h5>
                    <p>Jl. Contoh No. 123, Kota XYZ</p>
                </div>
            </div>
            
            <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <i class="bi bi-telephone-fill text-primary fs-4 me-3"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Telepon</h5>
                    <p>(021) 1234-5678</p>
                </div>
            </div>
            
            <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <i class="bi bi-envelope-fill text-primary fs-4 me-3"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Email</h5>
                    <p>info@yayasandonasi.org</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Kirim Pesan</h4>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap">
                                    <label for="nama">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subjek" placeholder="Subjek">
                                    <label for="subjek">Subjek</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="pesan" placeholder="Pesan" style="height: 150px"></textarea>
                                    <label for="pesan">Pesan</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary py-3 px-4">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

