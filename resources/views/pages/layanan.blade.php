@extends('layouts.app')

@section('title', 'Layanan Kami')

@section('content')
<!-- Hero Section -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Layanan Kami</h1>
                <p class="lead mb-4">Berbagai program amal dan kebaikan yang dapat Anda pilih untuk membantu sesama yang membutuhkan.</p>
                <p class="mb-0">Pilih salah satu layanan di bawah ini untuk mulai berdonasi dan menyebarkan kebaikan.</p>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="{{ asset('images/layanan-hero.jpg') }}" alt="Layanan Kami" class="img-fluid rounded-4 shadow">
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="container py-5">
    <div class="row g-4">
        <!-- Zakat -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm service-card">
                <div class="card-body p-4 text-center">
                    <div class="service-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                        <i class="bi bi-coin"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Zakat</h3>
                    <p class="mb-4">Zakat adalah kewajiban setiap muslim yang mampu untuk menyisihkan sebagian hartanya bagi yang berhak menerimanya.</p>
                    <div class="d-grid">
                        <a href="{{ route('donasi', ['kategori' => 'zakat']) }}" class="btn btn-outline-primary">Tunaikan Zakat</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Shodaqoh -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm service-card">
                <div class="card-body p-4 text-center">
                    <div class="service-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Shodaqoh</h3>
                    <p class="mb-4">Shodaqoh adalah pemberian sukarela yang dilakukan oleh seseorang sebagai bentuk kebaikan tanpa mengharapkan imbalan.</p>
                    <div class="d-grid">
                        <a href="{{ route('donasi', ['kategori' => 'shodaqoh']) }}" class="btn btn-outline-primary">Beri Shodaqoh</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Qurban -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm service-card">
                <div class="card-body p-4 text-center">
                    <div class="service-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                        <i class="bi bi-award"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Qurban</h3>
                    <p class="mb-4">Qurban adalah ibadah dengan menyembelih hewan ternak pada hari raya Idul Adha sebagai bentuk ketaatan kepada Allah.</p>
                    <div class="d-grid">
                        <a href="{{ route('donasi', ['kategori' => 'qurban']) }}" class="btn btn-outline-primary">Daftar Qurban</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Infaq -->
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm service-card">
                <div class="card-body p-4 text-center">
                    <div class="service-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                        <i class="bi bi-gift"></i>
                    </div>
                    <h3 class="fw-bold mb-3">Infaq</h3>
                    <p class="mb-4">Infaq adalah pemberian sebagian harta untuk suatu kepentingan yang diperintahkan oleh Allah SWT.</p>
                    <div class="d-grid">
                        <a href="{{ route('donasi', ['kategori' => 'infaq']) }}" class="btn btn-outline-primary">Salurkan Infaq</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Program Unggulan -->
{{-- <div class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold">Program Unggulan</h2>
            <p class="lead">Program-program khusus yang kami jalankan untuk membantu masyarakat yang membutuhkan</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/program-pendidikan.jpg') }}" class="card-img-top" alt="Program Pendidikan">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Beasiswa Pendidikan</h4>
                        <p class="card-text">Program beasiswa untuk anak-anak kurang mampu agar dapat melanjutkan pendidikan hingga perguruan tinggi.</p>
                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Terkumpul: Rp 75.000.000</span>
                            <span>Target: Rp 100.000.000</span>
                        </div>
                        <a href="{{ route('donasi', ['program' => 'beasiswa']) }}" class="btn btn-primary w-100">Donasi Sekarang</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/program-kesehatan.jpg') }}" class="card-img-top" alt="Program Kesehatan">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Layanan Kesehatan Gratis</h4>
                        <p class="card-text">Program pengobatan gratis dan edukasi kesehatan untuk masyarakat di daerah terpencil.</p>
                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Terkumpul: Rp 60.000.000</span>
                            <span>Target: Rp 100.000.000</span>
                        </div>
                        <a href="{{ route('donasi', ['program' => 'kesehatan']) }}" class="btn btn-primary w-100">Donasi Sekarang</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/program-pangan.jpg') }}" class="card-img-top" alt="Program Pangan">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Bantuan Pangan</h4>
                        <p class="card-text">Program bantuan pangan untuk keluarga prasejahtera dan korban bencana alam.</p>
                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Terkumpul: Rp 85.000.000</span>
                            <span>Target: Rp 100.000.000</span>
                        </div>
                        <a href="{{ route('donasi', ['program' => 'pangan']) }}" class="btn btn-primary w-100">Donasi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- Cara Berdonasi -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="display-6 fw-bold">Cara Berdonasi</h2>
        <p class="lead">Ikuti langkah-langkah mudah berikut untuk mulai berdonasi</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-3">
            <div class="text-center">
                <div class="step-circle bg-primary text-white mx-auto mb-3">1</div>
                <h4 class="fw-bold mb-3">Pilih Program</h4>
                <p>Pilih program atau layanan yang ingin Anda dukung sesuai dengan niat Anda.</p>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="text-center">
                <div class="step-circle bg-primary text-white mx-auto mb-3">2</div>
                <h4 class="fw-bold mb-3">Isi Formulir</h4>
                <p>Lengkapi formulir donasi dengan data diri dan nominal donasi yang diinginkan.</p>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="text-center">
                <div class="step-circle bg-primary text-white mx-auto mb-3">3</div>
                <h4 class="fw-bold mb-3">Pilih Pembayaran</h4>
                <p>Pilih metode pembayaran yang paling nyaman dan sesuai dengan Anda.</p>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="text-center">
                <div class="step-circle bg-primary text-white mx-auto mb-3">4</div>
                <h4 class="fw-bold mb-3">Konfirmasi</h4>
                <p>Selesaikan pembayaran dan dapatkan laporan penyaluran donasi Anda.</p>
            </div>
        </div>
    </div>
    
    <div class="text-center mt-5">
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3">Donasi Sekarang</a>
    </div>
</div>

<!-- FAQ Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold">Pertanyaan Umum</h2>
            <p class="lead">Jawaban untuk pertanyaan yang sering ditanyakan</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Apa perbedaan antara Zakat, Infaq, dan Shodaqoh?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p><strong>Zakat</strong> adalah kewajiban bagi setiap muslim yang hartanya telah mencapai nisab (batas minimal) dan haul (batas waktu) tertentu. Zakat memiliki aturan khusus tentang siapa yang berhak menerimanya.</p>
                                <p><strong>Infaq</strong> adalah pemberian sebagian harta untuk suatu kepentingan yang diperintahkan oleh Allah SWT, seperti untuk pembangunan masjid, sekolah, atau fasilitas umum lainnya.</p>
                                <p><strong>Shodaqoh</strong> adalah pemberian sukarela yang dilakukan oleh seseorang sebagai bentuk kebaikan tanpa mengharapkan imbalan. Shodaqoh bisa berupa harta, tenaga, atau kebaikan lainnya.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Bagaimana cara menghitung Zakat?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Cara menghitung zakat berbeda-beda tergantung jenis hartanya:</p>
                                <ul>
                                    <li><strong>Zakat Penghasilan:</strong> 2,5% dari penghasilan setelah dikurangi kebutuhan pokok.</li>
                                    <li><strong>Zakat Emas dan Perak:</strong> 2,5% dari nilai emas/perak jika telah mencapai nisab (85 gram emas).</li>
                                    <li><strong>Zakat Perdagangan:</strong> 2,5% dari modal yang berputar dan keuntungan.</li>
                                    <li><strong>Zakat Pertanian:</strong> 10% jika pengairan alami, 5% jika pengairan dengan biaya.</li>
                                </ul>
                                <p>Anda dapat menggunakan kalkulator zakat di website kami untuk perhitungan yang lebih akurat.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Bagaimana dana donasi disalurkan?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Dana donasi disalurkan sesuai dengan program yang dipilih oleh donatur. Kami memastikan bahwa setiap donasi sampai kepada penerima manfaat yang tepat.</p>
                                <p>Proses penyaluran meliputi:</p>
                                <ol>
                                    <li>Verifikasi dan pengumpulan dana</li>
                                    <li>Identifikasi penerima manfaat</li>
                                    <li>Penyaluran bantuan</li>
                                    <li>Dokumentasi dan pelaporan</li>
                                </ol>
                                <p>Kami juga menyediakan laporan penyaluran donasi yang dapat diakses oleh donatur melalui akun mereka.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Apakah saya akan mendapatkan bukti donasi?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Ya, setiap donatur akan mendapatkan bukti donasi berupa:</p>
                                <ul>
                                    <li>Notifikasi email setelah donasi berhasil</li>
                                    <li>Kwitansi elektronik yang dapat diunduh</li>
                                    <li>Laporan penyaluran donasi</li>
                                </ul>
                                <p>Untuk donasi zakat, kami juga menyediakan sertifikat zakat yang dapat digunakan sebagai bukti pembayaran zakat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-3">Siap Untuk Berbagi Kebaikan?</h2>
                <p class="lead mb-0">Setiap donasi Anda, sekecil apapun, akan membuat perbedaan besar bagi mereka yang membutuhkan.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('login') }}" class="btn btn-light btn-lg me-2 mb-2 mb-md-0">Donasi Sekarang</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Daftar Donatur</a>
            </div>
        </div>
    </div>
</div>

<style>
    .service-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }
    
    .service-card {
        transition: all 0.3s ease;
    }
    
    .service-card:hover {
        transform: translateY(-10px);
    }
    
    .step-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: rgba(13, 110, 253, 0.1);
        color: var(--bs-primary);
    }
    
    .accordion-button:focus {
        box-shadow: none;
    }
</style>
@endsection

