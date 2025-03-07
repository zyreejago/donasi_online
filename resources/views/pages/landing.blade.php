@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <section class="hero text-center bg-primary text-white py-5 rounded">
        <h1 class="fw-bold">Selamat Datang di Yayasan Kami</h1>
        <p class="lead">Bersama kita bisa membantu lebih banyak orang.</p>
        <a href="{{ route('donasi') }}" class="btn btn-light btn-lg mt-3">Donasi Sekarang</a>
    </section>

    <!-- Sejarah Section -->
    <section class="sejarah mt-5">
        <h2 class="text-center">Sejarah Kami</h2>
        <p class="text-center">Yayasan ini didirikan pada tahun ...</p>
    </section>

    <!-- Visi & Misi Section -->
    <section class="visi-misi mt-5">
        <h2 class="text-center">Visi & Misi</h2>
        <div class="row">
            <div class="col-md-6">
                <h4 class="fw-bold">Visi</h4>
                <p>...</p>
            </div>
            <div class="col-md-6">
                <h4 class="fw-bold">Misi</h4>
                <p>...</p>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section class="galeri mt-5 text-center">
        <h2>Galeri Kegiatan</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="{{ asset('images/kegiatan1.jpg') }}" alt="Kegiatan 1" class="img-fluid rounded shadow">
            </div>
        </div>
    </section>

    <!-- Alamat Section -->
    <section class="alamat mt-5 text-center">
        <h2>Alamat Kami</h2>
        <p>Jl. Contoh No. 123, Kota XYZ</p>
    </section>
</div>
@endsection