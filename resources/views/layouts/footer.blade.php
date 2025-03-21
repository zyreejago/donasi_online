{{-- <footer class="bg-dark text-white text-center py-4">
    <div class="container">
        <p>Yayasan Berkah | Jl. Contoh No.123, Kota, Provinsi</p>
        <p>WhatsApp: <a href="https://wa.me/6281234567890" class="text-white">+62 812-3456-7890</a></p>
        <p>
            <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
        </p>
        <p>&copy; {{ date('Y') }} Yayasan Berkah. All Rights Reserved.</p>
    </div>
</footer> --}}
<footer class="bg-dark text-white pt-5">
    <div class="container">
        <div class="row pb-4">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="{{ asset('storage/images/kegiatan/logo.png') }}" alt="Yayasan Donasi" class="mb-4" height="50">
                <p class="mb-4">Yayasan Donasi adalah organisasi nirlaba yang berfokus pada pendidikan, kesehatan, dan pemberdayaan masyarakat kurang mampu.</p>
                <div class="d-flex">
                    <a href="#" class="social-icon me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon me-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon me-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                <h5 class="text-white mb-4">Tautan</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('landing') }}" class="text-white-50">Home</a></li>
                    <li class="mb-2"><a href="{{ route('layanan') }}" class="text-white-50">Layanan</a></li>
                    <li class="mb-2"><a href="{{ route('donasi') }}" class="text-white-50">Donasi</a></li>
                    <li class="mb-2"><a href="{{ route('transparansi') }}" class="text-white-50">Transparansi</a></li>
                    <li><a href="{{ route('register') }}" class="text-white-50">Daftar Donatur</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-white mb-4">Program</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white-50">Pendidikan untuk Semua</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50">Layanan Kesehatan</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50">Pemberdayaan Ekonomi</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50">Tanggap Bencana</a></li>
                    <li><a href="#" class="text-white-50">Bantuan Sosial</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5 class="text-white mb-4">Kontak</h5>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex">
                        <i class="bi bi-geo-alt-fill me-3 text-primary"></i>
                        <span>Jl. Contoh No. 123, Kota XYZ</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="bi bi-telephone-fill me-3 text-primary"></i>
                        <span>(021) 1234-5678</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="bi bi-envelope-fill me-3 text-primary"></i>
                        <span>info@yayasandonasi.org</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-top border-secondary pt-4 pb-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; {{ date('Y') }} Yayasan Donasi. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white-50 me-3">Kebijakan Privasi</a>
                    <a href="#" class="text-white-50">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </div>
</footer>

