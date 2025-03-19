<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode Reset Password</title>
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
            background-color: #4CAF50;
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
        .code {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 5px;
            margin: 20px 0;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Kode Reset Password</h2>
    </div>
    
    <div class="content">
        <p>Halo <strong>{{ $user->name }}</strong>,</p>
        
        <p>Kami menerima permintaan untuk reset password akun Anda. Gunakan kode verifikasi berikut untuk melanjutkan proses reset password:</p>
        
        <div class="code">{{ $code }}</div>
        
        <p>Kode ini hanya berlaku selama 15 menit dan hanya dapat digunakan sekali.</p>
        
        <p>Jika Anda tidak meminta reset password, Anda dapat mengabaikan email ini dan tidak ada perubahan yang akan dilakukan pada akun Anda.</p>
        
        <p>Terima kasih,<br>
        Tim Kami</p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        <p>&copy; {{ date('Y') }} Nama Aplikasi Anda. All rights reserved.</p>
    </div>
</body>
</html>