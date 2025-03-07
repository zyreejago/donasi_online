@extends('layouts.app')

@section('title', 'Donasi')

@section('content')
<h2>Donasi</h2>
@if(request()->kategori)
    <h3>{{ ucfirst(request()->kategori) }}</h3>
    <p>Penjelasan tentang {{ request()->kategori }}...</p>
@endif

<form action="{{ route('proses.donasi') }}" method="POST">
    @csrf
    <label>Jumlah Donasi:</label>
    <input type="number" name="jumlah" required>

    <label>Metode Pembayaran:</label>
    <select name="metode">
        <option value="qris">QRIS</option>
    </select>

    <button type="submit">Donasi Sekarang</button>
</form>
@endsection
