<!-- Dalam modal payment -->
<div id="qrisSection" class="d-none">
    <div class="text-center mb-4">
        <h6 class="fw-bold">Silahkan Scan QRIS di bawah ini</h6>
        <p class="text-muted small">Donasi akan diproses setelah Anda melakukan pembayaran</p>
        
        <div class="my-4">
            @php
                $qrisImage = \App\Models\Setting::getValue('qris_image', '');
            @endphp
            
            @if($qrisImage)
                <img src="{{ asset('storage/settings/' . $qrisImage) }}" alt="QRIS Code" class="img-fluid" style="max-width: 250px;">
            @else
                <img src="{{ asset('images/qris-code.png') }}" alt="QRIS Code" class="img-fluid" style="max-width: 250px;">
            @endif
        </div>
        
        <div class="alert alert-info">
            <p class="mb-0"><strong>Total Pembayaran: <span id="paymentAmount">Rp 0</span></strong></p>
        </div>
    </div>
</div>

<!-- Address Section (for goods donations) -->
<div id="addressSection" class="d-none">
    <div class="text-center mb-4">
        <h6 class="fw-bold">Alamat Pengiriman Barang Donasi</h6>
        <p class="text-muted small">Silahkan kirimkan barang donasi Anda ke alamat berikut</p>
    </div>
    
    <div class="card border-0 bg-light">
        <div class="card-body p-4">
            @php
                $namaLembaga = \App\Models\Setting::getValue('nama_lembaga', 'Yayasan Peduli Kasih');
                $alamat = \App\Models\Setting::getValue('alamat_pengiriman', 'Jl. Contoh No. 123, Kecamatan Contoh, Kota XYZ, Provinsi ABC, Kode Pos: 12345');
                $telepon = \App\Models\Setting::getValue('telepon', '(021) 1234-5678');
            @endphp
            
            <h6 class="fw-bold">{{ $namaLembaga }}</h6>
            <p class="mb-2">{!! nl2br(e($alamat)) !!}</p>
            <p class="mb-0">Telepon: {{ $telepon }}</p>
        </div>
    </div>
    
    <div class="alert alert-warning mt-3">
        <p class="mb-0"><i class="bi bi-info-circle me-2"></i> Mohon sertakan ID Donasi <strong><span id="donasiId"></span></strong> pada paket Anda.</p>
    </div>
</div>