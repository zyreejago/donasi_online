@extends('layouts.app')

@section('title', 'Layanan')

@section('content')
<h2>Layanan Kami</h2>
<ul>
    <li><a href="{{ route('donasi', ['kategori' => 'zakat']) }}">Zakat</a></li>
    <li><a href="{{ route('donasi', ['kategori' => 'shodaqoh']) }}">Shodaqoh</a></li>
    <li><a href="{{ route('donasi', ['kategori' => 'qurban']) }}">Qurban</a></li>
    <li><a href="{{ route('donasi', ['kategori' => 'infaq']) }}">Infaq</a></li>
</ul>
@endsection
