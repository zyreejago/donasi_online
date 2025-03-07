@extends('layouts.app')

@section('title', 'Pendaftaran Donatur')

@section('content')
<h2>Pendaftaran Donatur Tetap</h2>
<form action="{{ route('register.donatur') }}" method="POST">
    @csrf
    <label>Nama:</label>
    <input type="text" name="nama" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>No. WhatsApp:</label>
    <input type="text" name="whatsapp" required>

    <button type="submit">Daftar</button>
</form>
@endsection
