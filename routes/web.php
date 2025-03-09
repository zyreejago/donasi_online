<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Donasi;
use App\Http\Controllers\AuthController;

// ==============================
// PUBLIC ROUTES (No Auth Required)
// ==============================

// Halaman Utama
Route::get('/', function () {
    return view('pages.landing');
})->name('landing');

// Halaman Layanan
Route::get('/layanan', function () {
    return view('pages.layanan');
})->name('layanan');

// Halaman Transparansi
Route::get('/transparansi', function () {
    // Filter data
    $query = Donasi::query();
    
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
    $totalJumlah = Donasi::where('metode_donasi', 'uang')->sum('jumlah');
    
    // Ambil data donasi
    $donasis = $query->orderBy('created_at', 'desc')->paginate(10);
    
    return view('pages.transparansi', compact('donasis', 'totalDonasi', 'totalTerverifikasi', 'totalPending', 'totalJumlah'));
})->name('transparansi');

// ==============================
// AUTHENTICATION ROUTES (Guest Only)
// ==============================

Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost']);
    
    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost']);
});

// ==============================
// PROTECTED ROUTES (Auth Required)
// ==============================

Route::middleware('auth')->group(function () {
    // Logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        // Statistik donasi user
        $userDonations = Donasi::where('email', $user->email)->get();
        $totalDonasi = $userDonations->count();
        $totalTerverifikasi = $userDonations->where('status', 'terverifikasi')->count();
        $totalPending = $userDonations->where('status', 'pending')->count();
        $totalJumlah = $userDonations->where('metode_donasi', 'uang')->sum('jumlah');
        
        return view('pages.donasi', compact('user', 'totalDonasi', 'totalTerverifikasi', 'totalPending', 'totalJumlah'));
    })->name('dashboard');
    
    // Donasi
    Route::get('/donasi', function () {
        return view('pages.donasi');
    })->name('donasi');
    
    // Riwayat Donasi
    Route::get('/riwayat', function () {
        $user = Auth::user();
        $donasis = Donasi::where('email', $user->email)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
                        
        return view('pages.riwayat', compact('user', 'donasis'));
    })->name('riwayat');
    
    // Profile
    Route::get('/profile/edit', function () {
        $user = Auth::user();
        return view('pages.profile', compact('user'));
    })->name('profile.edit');
    
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
Route::post('/api/donasi', function (Illuminate\Http\Request $request) {
    // Validasi request
    $request->validate([
        'nama_donatur' => 'required|string|max:255',
        'email' => 'required|email',
        'jenis_donasi' => 'required|string',
        'metode_donasi' => 'required|string|in:uang,barang',
        'jumlah' => 'required_if:metode_donasi,uang|nullable|numeric|min:1000',
        'deskripsi_barang' => 'required_if:metode_donasi,barang|nullable|string',
        'metode_pembayaran' => 'required|string',
        'anonim' => 'nullable|boolean'
    ]);
    
    // Buat donasi baru
    $donasi = new Donasi();
    $donasi->nama_donatur = $request->anonim ? 'Hamba Allah' : $request->nama_donatur;
    $donasi->email = $request->email;
    $donasi->jenis_donasi = $request->jenis_donasi;
    $donasi->metode_donasi = $request->metode_donasi;
    
    if ($request->metode_donasi === 'uang') {
        $donasi->jumlah = $request->jumlah;
    } else {
        $donasi->deskripsi_barang = $request->deskripsi_barang;
    }
    
    $donasi->metode_pembayaran = $request->metode_pembayaran;
    $donasi->status = 'pending'; // Default status
    $donasi->save();
    
    return response()->json([
        'success' => true,
        'message' => 'Donasi berhasil dikirim! Terima kasih atas kebaikan Anda.',
        'data' => $donasi
    ]);
});

// ==============================
// DEBUG ROUTES (Development Only)
// ==============================

if (app()->environment('local')) {
    Route::get('/cek-session', function () {
        return [
            'session_user_id' => session('user_id'),
            'auth_user_id' => Auth::id(),
            'session_all' => Session::all(),
        ];
    });

    Route::get('/debug-session', function () {
        return response()->json([
            'auth_check' => Auth::check(),
            'user' => Auth::user(),
            'session_data' => session()->all(),
        ]);
    });

    Route::get('/force-save-session', function () {
        session(['test_key' => 'LaravelSessionTest']);
        session()->save();

        $session = DB::table('sessions')->where('id', session()->getId())->first();

        return response()->json([
            'session_id' => session()->getId(),
            'session_data' => $session ? json_decode(base64_decode($session->payload), true) : null
        ]);
    });
}

