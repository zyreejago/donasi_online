<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Donasi Anda Tidak Dapat Diproses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f44336;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        .details {
            background-color: #f9f9f9;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
        .reason {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 10px 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Donasi Anda Tidak Dapat Diproses</h2>
    </div>
    
    <div class="content">
        <p>Halo <strong>{{ $userName }}</strong>,</p>
        
        <p>Terima kasih atas niat baik Anda untuk berdonasi. Dengan berat hati, kami ingin memberitahukan bahwa donasi Anda <strong>TIDAK DAPAT DIPROSES</strong> saat ini.</p>
        
        <div class="details">
            <h3>Detail Donasi:</h3>
            <p><strong>ID Donasi:</strong> {{ $donasi->id }}</p>
            <p><strong>Tanggal Donasi:</strong> {{ $donasi->created_at->format('d F Y, H:i') }}</p>
            <p><strong>Jenis Donasi:</strong> {{ ucfirst($donasi->jenis_donasi) }}</p>
            <p><strong>Metode Donasi:</strong> {{ ucfirst($donasi->metode_donasi) }}</p>
            
            @if($donasi->metode_donasi == 'uang')
                <p><strong>Jumlah:</strong> Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</p>
            @else
                <p><strong>Deskripsi Barang:</strong> {{ $donasi->deskripsi_barang }}</p>
            @endif
        </div>
        
        @if($donasi->catatan_admin)
            <div class="reason">
                <h3>Alasan Penolakan:</h3>
                <p>{{ $donasi->catatan_admin }}</p>
            </div>
        @endif
        
        <p>Kami sangat menghargai niat baik Anda untuk membantu. Jika Anda ingin mencoba berdonasi kembali atau memiliki pertanyaan, silakan hubungi kami.</p>
        
        <p>Kami mohon maaf atas ketidaknyamanan ini dan berharap dapat menerima donasi Anda di kesempatan berikutnya.</p>
        
        <p>Salam hangat,<br>
        Tim Donasi</p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        <p>&copy; {{ date('Y') }} Yayasan Peduli Kasih. All rights reserved.</p>
    </div>
</body>
</html>