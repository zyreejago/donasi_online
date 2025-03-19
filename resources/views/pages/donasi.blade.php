@extends('layouts.dashboard')

@section('title', 'Dashboard Donatur')

@section('content')
<div class="container-fluid py-4">
<!-- Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 bg-primary text-white shadow">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="fw-bold mb-2">
                            Selamat Datang, {{ Auth::user()->name }}!
                        </h2>
                        <p class="mb-0">Terima kasih telah bergabung dengan kami. Donasi Anda akan membantu banyak orang yang membutuhkan.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="#form-donasi" class="btn btn-light">Donasi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-cash-coin text-primary fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Donasi</p>
                        {{-- <h4 class="fw-bold mb-0">{{ $totalDonasi }}</h4> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-check-circle text-success fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Donasi Terverifikasi</p>
                        {{-- <h4 class="fw-bold mb-0">{{ $totalTerverifikasi }}</h4> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-hourglass-split text-warning fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Donasi Pending</p>
                        {{-- <h4 class="fw-bold mb-0">{{ $totalPending }}</h4> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-heart text-info fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Donasi (Rp)</p>
                        {{-- <h4 class="fw-bold mb-0">{{ number_format($totalJumlah, 0, ',', '.') }}</h4> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Form Donasi -->
    <div class="col-lg-8 mb-4" id="form-donasi">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Form Donasi</h5>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-danger d-none" id="donasi-error"></div>
                <div class="alert alert-success d-none" id="donasi-success"></div>
                
                <form id="donasiForm">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_donatur" class="form-label">Nama Donatur <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_donatur" name="nama_donatur" 
                            value="{{ Auth::user()->name }}" required>
                        <div class="invalid-feedback" id="nama_donatur-error"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                            value="{{ Auth::user()->email }}" readonly>
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jenis_donasi" class="form-label">Jenis Donasi <span class="text-danger">*</span></label>
                        <select class="form-select" id="jenis_donasi" name="jenis_donasi" required>
                            <option value="" selected disabled>Pilih Jenis Donasi</option>
                            <option value="zakat">Zakat</option>
                            <option value="infaq">Infaq</option>
                            <option value="shodaqoh">Shodaqoh</option>
                            <option value="qurban">Qurban</option>
                            <option value="wakaf">Wakaf</option>
                        </select>
                        <div class="invalid-feedback" id="jenis_donasi-error"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="metode_donasi" class="form-label">Metode Donasi <span class="text-danger">*</span></label>
                        <select class="form-select" id="metode_donasi" name="metode_donasi" required>
                            <option value="" selected disabled>Pilih Metode Donasi</option>
                            <option value="uang">Uang</option>
                            <option value="barang">Barang</option>
                        </select>
                        <div class="invalid-feedback" id="metode_donasi-error"></div>
                    </div>
                    
                    <div class="mb-3" id="jumlahField">
                        <label for="jumlah" class="form-label">Jumlah (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="1000">
                        <div class="invalid-feedback" id="jumlah-error"></div>
                    </div>
                    
                    <div class="mb-3 d-none" id="deskripsiBarangField">
                        <label for="deskripsi_barang" class="form-label">Deskripsi Barang <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="deskripsi_barang" name="deskripsi_barang" rows="3"></textarea>
                        <div class="invalid-feedback" id="deskripsi_barang-error"></div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" id="anonim" name="anonim">
                        <label class="form-check-label" for="anonim">
                            Sembunyikan nama saya (donasi anonim)
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" id="submitDonasi">
                        <span id="donasiSpinner" class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
                        Kirim Donasi
                    </button>
                </form>
                
                <!-- Payment Modal -->
                <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentModalLabel">Pembayaran Donasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- QRIS Payment Section (for money donations) -->
                                <div id="qrisSection" class="d-none">
                                    <div class="text-center mb-4">
                                        <h6 class="fw-bold">Silahkan Scan QRIS di bawah ini</h6>
                                        <p class="text-muted small">Donasi akan diproses setelah Anda melakukan pembayaran</p>
                                        
                                        <div class="my-4">
                                            <img src="{{ asset('images/qris-code.png') }}" alt="QRIS Code" class="img-fluid" style="max-width: 250px;">
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
                                            <h6 class="fw-bold">Yayasan Peduli Kasih</h6>
                                            <p class="mb-2">Jl. Contoh No. 123, Kecamatan Contoh</p>
                                            <p class="mb-2">Kota XYZ, Provinsi ABC</p>
                                            <p class="mb-2">Kode Pos: 12345</p>
                                            <p class="mb-0">Telepon: (021) 1234-5678</p>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-warning mt-3">
                                        <p class="mb-0"><i class="bi bi-info-circle me-2"></i> Mohon sertakan ID Donasi <strong><span id="donasiId"></span></strong> pada paket Anda.</p>
                                    </div>
                                </div>
                                
                                <div id="uploadSection" class="d-none mt-4">
                                    <hr>
                                    <h6 class="fw-bold mb-3" id="uploadTitle">Upload Bukti Pembayaran/Pengiriman</h6>
                                    
                                    <form id="uploadForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="bukti_pembayaran" class="form-label" id="buktiLabel">Bukti Pembayaran/Pengiriman</label>
                                            <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                                            <div class="form-text">Format: JPG, PNG, JPEG. Maks: 2MB</div>
                                        </div>
                                        
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-success" id="uploadButton">
                                                <span id="uploadSpinner" class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
                                                Upload Bukti
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" id="showUploadButton">Sudah Bayar/Kirim? Upload Bukti</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Profile Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4 text-center">
                <div class="mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-fill fs-1"></i>
                    </div>
                </div>
                <h5 class="fw-bold">{{ Auth::user()->name }}</h5>
                <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                <div class="d-grid">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">Edit Profil</a>
                </div>
            </div>
        </div>
        
        <!-- Program Unggulan -->
        {{-- <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Program Unggulan</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action p-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1 fw-bold">Beasiswa Pendidikan</h6>
                            <small class="text-primary">75%</small>
                        </div>
                        <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action p-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1 fw-bold">Layanan Kesehatan</h6>
                            <small class="text-primary">60%</small>
                        </div>
                        <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action p-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1 fw-bold">Bantuan Pangan</h6>
                            <small class="text-primary">85%</small>
                        </div>
                        <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<!-- Riwayat Donasi -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Riwayat Donasi</h5>
                <button class="btn btn-sm btn-outline-primary" id="refreshRiwayat">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Metode</th>
                                <th scope="col">Jumlah/Deskripsi</th>
                                <th scope="col">Bukti</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="riwayatDonasi">
                            <tr>
                                <td colspan="8" class="text-center py-4">Memuat data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle fields based on metode_donasi
    const metodeDonasiSelect = document.getElementById('metode_donasi');
    const jumlahField = document.getElementById('jumlahField');
    const deskripsiBarangField = document.getElementById('deskripsiBarangField');
    const jumlahInput = document.getElementById('jumlah');
    const deskripsiBarangInput = document.getElementById('deskripsi_barang');
    
    metodeDonasiSelect.addEventListener('change', function() {
        if (this.value === 'uang') {
            jumlahField.classList.remove('d-none');
            deskripsiBarangField.classList.add('d-none');
            jumlahInput.setAttribute('required', '');
            deskripsiBarangInput.removeAttribute('required');
            deskripsiBarangInput.value = '';
        } else if (this.value === 'barang') {
            jumlahField.classList.add('d-none');
            deskripsiBarangField.classList.remove('d-none');
            jumlahInput.removeAttribute('required');
            deskripsiBarangInput.setAttribute('required', '');
            jumlahInput.value = '';
        }
    });
    
    // Payment Modal
    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
    const paymentAmount = document.getElementById('paymentAmount');
    const donasiId = document.getElementById('donasiId');
    const qrisSection = document.getElementById('qrisSection');
    const addressSection = document.getElementById('addressSection');
    const showUploadButton = document.getElementById('showUploadButton');
    const uploadSection = document.getElementById('uploadSection');
    
    // Show upload section
    showUploadButton.addEventListener('click', function() {
        uploadSection.classList.remove('d-none');
        this.classList.add('d-none');
    });
    
    // Handle form submission
    const donasiForm = document.getElementById('donasiForm');
    const submitDonasi = document.getElementById('submitDonasi');
    const donasiSpinner = document.getElementById('donasiSpinner');
    const donasiError = document.getElementById('donasi-error');
    const donasiSuccess = document.getElementById('donasi-success');
    
    donasiForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Reset error messages
        donasiError.classList.add('d-none');
        donasiSuccess.classList.add('d-none');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        
        // Show loading state
        submitDonasi.disabled = true;
        donasiSpinner.classList.remove('d-none');
        
        // Prepare form data
        const formData = new FormData();
        formData.append('nama_donatur', document.getElementById('nama_donatur').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('jenis_donasi', document.getElementById('jenis_donasi').value);
        formData.append('metode_donasi', document.getElementById('metode_donasi').value);
        formData.append('anonim', document.getElementById('anonim').checked ? 1 : 0);
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        
        // Add conditional fields
        if (document.getElementById('metode_donasi').value === 'uang') {
            formData.append('jumlah', document.getElementById('jumlah').value);
        } else if (document.getElementById('metode_donasi').value === 'barang') {
            formData.append('deskripsi_barang', document.getElementById('deskripsi_barang').value);
        }
        
        try {
            const response = await fetch('/api/donasi', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                if (response.status === 422) {
                    // Validation errors
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const input = document.getElementById(key);
                            if (input) {
                                input.classList.add('is-invalid');
                                document.getElementById(`${key}-error`).textContent = data.errors[key][0];
                            }
                        });
                    }
                    donasiError.textContent = 'Mohon periksa kembali form donasi Anda.';
                    donasiError.classList.remove('d-none');
                } else {
                    // Other errors
                    donasiError.textContent = data.message || 'Terjadi kesalahan saat mengirim donasi.';
                    donasiError.classList.remove('d-none');
                }
            } else {
                // Success - Show payment modal
                const donationAmount = document.getElementById('metode_donasi').value === 'uang' 
                    ? document.getElementById('jumlah').value 
                    : 0;
                
                // Set donation ID
                donasiId.textContent = data.data.id;
                
                // Set payment amount in modal
                paymentAmount.textContent = 'Rp ' + Number(donationAmount).toLocaleString('id-ID');
                
                // Set donation ID for upload form
                const uploadForm = document.getElementById('uploadForm');
                uploadForm.action = '/donasi/' + data.data.id + '/upload-bukti';
                
                // Show appropriate section based on donation method
                if (document.getElementById('metode_donasi').value === 'uang') {
                    qrisSection.classList.remove('d-none');
                    addressSection.classList.add('d-none');
                    showUploadButton.textContent = 'Sudah Bayar? Upload Bukti';
                    document.getElementById('uploadTitle').textContent = 'Upload Bukti Pembayaran';
                    document.getElementById('buktiLabel').textContent = 'Bukti Pembayaran';
                } else {
                    qrisSection.classList.add('d-none');
                    addressSection.classList.remove('d-none');
                    showUploadButton.textContent = 'Sudah Kirim? Upload Bukti';
                    document.getElementById('uploadTitle').textContent = 'Upload Bukti Pengiriman Barang';
                    document.getElementById('buktiLabel').textContent = 'Bukti Pengiriman Barang';
                }
                
                // Reset upload section
                uploadSection.classList.add('d-none');
                showUploadButton.classList.remove('d-none');
                
                // Show payment modal
                paymentModal.show();
                
                // Reset form
                donasiForm.reset();
                
                // Refresh riwayat donasi after modal is closed
                document.getElementById('paymentModal').addEventListener('hidden.bs.modal', function () {
                    loadRiwayatDonasi();
                });
            }
        } catch (error) {
            console.error('Error:', error);
            donasiError.textContent = 'Terjadi kesalahan pada server.';
            donasiError.classList.remove('d-none');
        } finally {
            // Reset loading state
            submitDonasi.disabled = false;
            donasiSpinner.classList.add('d-none');
        }
    });
    
    // Handle upload form
    const uploadForm = document.getElementById('uploadForm');
    const uploadButton = document.getElementById('uploadButton');
    const uploadSpinner = document.getElementById('uploadSpinner');
    
    uploadForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Show loading state
        uploadButton.disabled = true;
        uploadSpinner.classList.remove('d-none');
        
        try {
            const formData = new FormData(this);
            
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });
            
            if (response.ok) {
                const metode = document.getElementById('metode_donasi').value;
                const successMessage = metode === 'uang' 
                    ? 'Bukti pembayaran berhasil diunggah. Donasi Anda akan segera diproses.'
                    : 'Bukti pengiriman barang berhasil diunggah. Donasi Anda akan segera diproses.';
            
                alert(successMessage);
                paymentModal.hide();
                loadRiwayatDonasi();
            } else {
                const data = await response.json();
                alert('Gagal mengunggah bukti: ' + (data.message || 'Terjadi kesalahan'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada server');
        } finally {
            // Reset loading state
            uploadButton.disabled = false;
            uploadSpinner.classList.add('d-none');
        }
    });
    
    // Load riwayat donasi
    const refreshRiwayat = document.getElementById('refreshRiwayat');
    refreshRiwayat.addEventListener('click', loadRiwayatDonasi);
    
    function loadRiwayatDonasi() {
        const riwayatDonasi = document.getElementById('riwayatDonasi');
        
        // Show loading
        riwayatDonasi.innerHTML = `
            <tr>
                <td colspan="8" class="text-center py-4">
                    <div class="spinner-border spinner-border-sm text-primary me-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    Memuat data...
                </td>
            </tr>
        `;
        
        // Fetch data
        fetch('/api/donasi/user')
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                riwayatDonasi.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center py-4">Belum ada riwayat donasi</td>
                    </tr>
                `;
                return;
            }
            
            let html = '';
            data.forEach(donasi => {
                const tanggal = new Date(donasi.created_at).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                
                const jumlahOrDeskripsi = donasi.metode_donasi === 'uang' 
                    ? `Rp ${Number(donasi.jumlah).toLocaleString('id-ID')}`
                    : donasi.deskripsi_barang;
                
                const statusBadge = donasi.status === 'terverifikasi'
                    ? '<span class="badge bg-success">Terverifikasi</span>'
                    : '<span class="badge bg-warning text-dark">Pending</span>';
                
                const buktiPembayaran = donasi.bukti_pembayaran 
                    ? `<a href="/storage/bukti_pembayaran/${donasi.bukti_pembayaran}" target="_blank" class="btn btn-sm btn-success"><i class="bi bi-image"></i></a>`
                    : `<a href="/donasi/${donasi.id}" class="btn btn-sm btn-warning"><i class="bi bi-upload"></i></a>`;
                
                html += `
                    <tr>
                        <td>${donasi.id}</td>
                        <td>${tanggal}</td>
                        <td>${donasi.jenis_donasi}</td>
                        <td>${donasi.metode_donasi}</td>
                        <td>${jumlahOrDeskripsi}</td>
                        <td>${buktiPembayaran}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <a href="/donasi/${donasi.id}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                `;
            });
            
            riwayatDonasi.innerHTML = html;
        })
        .catch(error => {
            console.error('Error:', error);
            riwayatDonasi.innerHTML = `
                <tr>
                    <td colspan="8" class="text-center py-4 text-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        Gagal memuat data
                    </td>
                </tr>
            `;
        });
    }
    
    // Initial load
    loadRiwayatDonasi();
    
    // Make viewDonasi function global
    window.viewDonasi = function(id) {
        window.location.href = '/donasi/' + id;
    };
});
</script>
@endpush

