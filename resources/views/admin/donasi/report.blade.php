<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Donasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
        }
        .info {
            margin-bottom: 20px;
        }
        .info table {
            width: 100%;
        }
        .info td {
            padding: 3px 0;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.data th, table.data td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table.data th {
            background-color: #f2f2f2;
        }
        .summary {
            margin-top: 20px;
        }
        .summary h3 {
            font-size: 14px;
            margin-bottom: 10px;
        }
        .summary table {
            width: 50%;
            border-collapse: collapse;
        }
        .summary th, .summary td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .summary th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DONASI YAYASAN</h1>
        <p>Periode: {{ $tanggalMulai->format('d F Y') }} - {{ $tanggalAkhir->format('d F Y') }}</p>
    </div>
    
    <div class="info">
        <table>
            <tr>
                <td width="150">Tanggal Cetak</td>
                <td>: {{ $tanggalCetak->format('d F Y H:i') }}</td>
            </tr>
            <tr>
                <td>Total Donasi</td>
                <td>: {{ $donasis->count() }} donasi</td>
            </tr>
            <tr>
                <td>Total Dana Terkumpul</td>
                <td>: Rp {{ number_format($totalDonasiUang, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
    
    <h3>Daftar Donasi Terverifikasi</h3>
    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Donatur</th>
                <th>Jenis Donasi</th>
                <th>Metode</th>
                <th>Jumlah/Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donasis as $index => $donasi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $donasi->created_at->format('d/m/Y') }}</td>
                <td>{{ $donasi->anonim ? 'Hamba Allah' : $donasi->nama_donatur }}</td>
                <td>{{ ucfirst($donasi->jenis_donasi) }}</td>
                <td>{{ ucfirst($donasi->metode_donasi) }}</td>
                <td>
                    @if($donasi->metode_donasi == 'uang')
                        Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}
                    @else
                        {{ $donasi->deskripsi_barang }}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data donasi terverifikasi pada periode ini</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="summary">
        <h3>Ringkasan Donasi Berdasarkan Jenis</h3>
        <table>
            <thead>
                <tr>
                    <th>Jenis Donasi</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jumlahPerJenis as $jenis => $jumlah)
                <tr>
                    <td>{{ ucfirst($jenis) }}</td>
                    <td>{{ $jumlah }} donasi</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="summary">
        <h3>Ringkasan Donasi Berdasarkan Metode</h3>
        <table>
            <thead>
                <tr>
                    <th>Metode Donasi</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jumlahPerMetode as $metode => $jumlah)
                <tr>
                    <td>{{ ucfirst($metode) }}</td>
                    <td>{{ $jumlah }} donasi</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="footer">
        <p>Dicetak oleh: {{ Auth::user()->name }}</p>
    </div>
</body>
</html>

