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
                      
                      <div class="mb-3">
                          <label for="metode_pembayaran" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                          <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                              <option value="" selected disabled>Pilih Metode Pembayaran</option>
                              <option value="transfer">Transfer Bank</option>
                              <option value="ewallet">E-Wallet</option>
                              <option value="qris">QRIS</option>
                          </select>
                          <div class="invalid-feedback" id="metode_pembayaran-error"></div>
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
              </div>
          </div>
      </div>
      
      <!-- Sidebar -->
      <div class="col-lg-4">
          <!-- Profile Card -->
          <div class="card border-0 shadow-sm mb-4">
              <div class="card-body p-4 text-center">
                  <div class="mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px;">
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
          <div class="card border-0 shadow-sm">
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
          </div>
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
                                  <th scope="col">Jumlah</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Aksi</th>
                              </tr>
                          </thead>
                          <tbody id="riwayatDonasi">
                              <tr>
                                  <td colspan="7" class="text-center py-4">Memuat data...</td>
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
          const formData = {
              nama_donatur: document.getElementById('nama_donatur').value,
              email: document.getElementById('email').value,
              jenis_donasi: document.getElementById('jenis_donasi').value,
              metode_donasi: document.getElementById('metode_donasi').value,
              metode_pembayaran: document.getElementById('metode_pembayaran').value,
              anonim: document.getElementById('anonim').checked ? 1 : 0
          };
          
          // Add conditional fields
          if (formData.metode_donasi === 'uang') {
              formData.jumlah = document.getElementById('jumlah').value;
          } else if (formData.metode_donasi === 'barang') {
              formData.deskripsi_barang = document.getElementById('deskripsi_barang').value;
          }
          
          try {
              const response = await fetch('/api/donasi', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                  },
                  body: JSON.stringify(formData)
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
                  // Success
                  donasiSuccess.textContent = data.message || 'Donasi berhasil dikirim!';
                  donasiSuccess.classList.remove('d-none');
                  donasiForm.reset();
                  
                  // Refresh riwayat donasi
                  setTimeout(() => {
                      loadRiwayatDonasi();
                  }, 1000);
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
      
      // Load riwayat donasi
      const refreshRiwayat = document.getElementById('refreshRiwayat');
      refreshRiwayat.addEventListener('click', loadRiwayatDonasi);
      
      function loadRiwayatDonasi() {
          const riwayatDonasi = document.getElementById('riwayatDonasi');
          
          // Show loading
          riwayatDonasi.innerHTML = `
              <tr>
                  <td colspan="7" class="text-center py-4">
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
                          <td colspan="7" class="text-center py-4">Belum ada riwayat donasi</td>
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
                  
                  const jumlah = donasi.metode_donasi === 'uang' 
                      ? `Rp ${Number(donasi.jumlah).toLocaleString('id-ID')}`
                      : '-';
                  
                  const statusBadge = donasi.status === 'terverifikasi'
                      ? '<span class="badge bg-success">Terverifikasi</span>'
                      : '<span class="badge bg-warning text-dark">Pending</span>';
                  
                  html += `
                      <tr>
                          <td>${donasi.id}</td>
                          <td>${tanggal}</td>
                          <td>${donasi.jenis_donasi}</td>
                          <td>${donasi.metode_donasi}</td>
                          <td>${jumlah}</td>
                          <td>${statusBadge}</td>
                          <td>
                              <button class="btn btn-sm btn-outline-primary" onclick="viewDonasi(${donasi.id})">
                                  <i class="bi bi-eye"></i>
                              </button>
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
                      <td colspan="7" class="text-center py-4 text-danger">
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
          alert(`Lihat detail donasi dengan ID: ${id}`);
          // Implement view donasi detail
      };
  });
</script>
@endpush

