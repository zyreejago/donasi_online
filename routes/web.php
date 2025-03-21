<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonasiController;
use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\HomeController;

// ==============================
// PUBLIC ROUTES (No Auth Required)
// ==============================

// Halaman Utama
Route::get('/', function () {
    $kegiatan = \App\Models\Kegiatan::where('aktif', true)
                ->orderBy('tanggal', 'desc')
                ->take(3)
                ->get();
                return view('pages.landing', compact('kegiatan'));
            })->name('landing');

// Halaman Layanan
Route::get('/layanan', function () {
    return view('pages.layanan');
})->name('layanan');

// Halaman Transparansi
Route::get('/transparansi', function () {
    // Filter data
    $query = Donasi::where('status', 'terverifikasi'); // Hanya tampilkan yang terverifikasi
    
    if (request('jenis_donasi')) {
        $query->where('jenis_donasi', request('jenis_donasi'));
    }
    
    if (request('status')) {
        $query->where('status', request('status'));
    }
    
    if (request('tanggal')) {
        $date = request('tanggal');
        $query->whereYear('created_at', substr($date, 0, 4))
              ->whereMonth('created_at', substr($date, 5, 2));
    }
    
    // Statistik
    $totalDonasi = Donasi::count();
    $totalTerverifikasi = Donasi::where('status', 'terverifikasi')->count();
    $totalPending = Donasi::where('status', 'pending')->count();
    
    // Total jumlah dari semua donasi uang
    $totalJumlah = Donasi::where('metode_donasi', 'uang')->sum('jumlah');
    
    // Total jumlah hanya dari donasi uang yang terverifikasi
    $totalJumlahTerverifikasi = Donasi::where('metode_donasi', 'uang')
                                      ->where('status', 'terverifikasi')
                                      ->sum('jumlah');
    
    return view('pages.transparansi', [
        'donasis' => $query->paginate(10),
        'totalDonasi' => $totalDonasi,
        'totalTerverifikasi' => $totalTerverifikasi,
        'totalPending' => $totalPending,
        'totalJumlah' => $totalJumlah,
        'totalJumlahTerverifikasi' => $totalJumlahTerverifikasi
    ]);
})->name('transparansi');

// ==============================
// AUTHENTICATION ROUTES (Guest Only)
// ==============================

Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    
    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    
    // Password Reset Routes (dengan kode verifikasi)
    Route::get('/forgot-password', [App\Http\Controllers\Auth\PasswordResetController::class, 'showRequestForm'])->name('password.request');
    Route::post('/forgot-password', [App\Http\Controllers\Auth\PasswordResetController::class, 'sendCode'])->name('password.send.code');
    Route::get('/verify-code', [App\Http\Controllers\Auth\PasswordResetController::class, 'showVerifyForm'])->name('password.verify');
    Route::post('/verify-code', [App\Http\Controllers\Auth\PasswordResetController::class, 'verifyCode'])->name('password.verify.code');
    Route::get('/reset-password', [App\Http\Controllers\Auth\PasswordResetController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/reset-password', [App\Http\Controllers\Auth\PasswordResetController::class, 'resetPassword'])->name('password.reset.update');
});

// ==============================
// PROTECTED ROUTES (Auth Required)
// ==============================

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard - Hanya untuk user biasa (bukan admin)
    Route::get('/dashboard', function () {
        // Redirect admin ke dashboard admin
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        $user = Auth::user();
        
        // Statistik donasi user
        $userDonations = Donasi::where('email', $user->email)->get();
        $totalDonasi = $userDonations->count();
        $totalTerverifikasi = $userDonations->where('status', 'terverifikasi')->count();
        $totalPending = $userDonations->where('status', 'pending')->count();
        $totalJumlah = $userDonations->where('metode_donasi', 'uang')->sum('jumlah');
        
        return view('pages.donasi', compact('user', 'totalDonasi', 'totalTerverifikasi', 'totalPending', 'totalJumlah'));
    })->name('dashboard');
    
    // Donasi - Hanya untuk user biasa
    Route::middleware('auth')->group(function () {
        Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi');
        Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
        Route::get('/donasi/{id}', [DonasiController::class, 'show'])->name('donasi.show');
        Route::post('/donasi/{id}/upload-bukti', [DonasiController::class, 'uploadBukti'])->name('donasi.upload-bukti');
        
        // Riwayat Donasi
        Route::get('/riwayat', [DonasiController::class, 'riwayat'])->name('riwayat');

        // Route untuk halaman kegiatan
        // Route untuk halaman kegiatan
Route::get('/kegiatan', [App\Http\Controllers\HomeController::class, 'allKegiatan'])->name('kegiatan.all');
Route::get('/kegiatan/{id}', [App\Http\Controllers\HomeController::class, 'detailKegiatan'])->name('kegiatan.detail');

        
        // Profile
        Route::get('/profile/edit', function () {
            $user = Auth::user();
            return view('pages.profile', compact('user'));
        })->name('profile.edit');
    });
    
    // API untuk mendapatkan riwayat donasi user
    Route::get('/api/donasi/user', function () {
        $user = Auth::user();
        $donasis = Donasi::where('email', $user->email)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return response()->json($donasis);
    });
});

// ==============================
// API ROUTES
// ==============================

// API untuk donasi
Route::post('/api/donasi', [DonasiController::class, 'store']);




Route::get('/kegiatan', [HomeController::class, 'allKegiatan'])->name('kegiatan.all');
Route::get('/kegiatan/{id}', [HomeController::class, 'detailKegiatan'])->name('kegiatan.detail');


// ==============================
// ADMIN ROUTES
// ==============================

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', AdminMiddleware::class])->group(function () {
    // Dashboard
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Donasi
    Route::get('/donasi', [App\Http\Controllers\Admin\DonasiController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/{id}', [App\Http\Controllers\Admin\DonasiController::class, 'show'])->name('donasi.show');
    Route::put('/donasi/{id}/status', [App\Http\Controllers\Admin\DonasiController::class, 'updateStatus'])->name('donasi.update-status');
    Route::delete('/donasi/{id}', [App\Http\Controllers\Admin\DonasiController::class, 'destroy'])->name('donasi.destroy');
    
    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    Route::post('/donasi/report', [App\Http\Controllers\Admin\DonasiController::class, 'generateReport'])->name('donasi.report');
    
    Route::resource('kegiatan', App\Http\Controllers\Admin\KegiatanController::class);
});