@extends('layouts.app')

@section('title', 'Transparansi')

@section('content')
<h2>Transparansi Penggunaan Donasi</h2>
<table>
    <tr>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Penggunaan</th>
    </tr>
    @foreach($donasi as $item)
    <tr>
        <td>{{ $item->tanggal }}</td>
        <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
        <td>{{ $item->penggunaan }}</td>
    </tr>
    @endforeach
</table>
@endsection
