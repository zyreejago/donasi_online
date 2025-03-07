<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.landing');
})->name('landing');

Route::get('/layanan', function () {
    return view('pages.layanan');
})->name('layanan');

Route::get('/donasi', function () {
    return view('pages.donasi');
})->name('donasi');

Route::get('/transparansi', function () {
    $donasi = \App\Models\Donasi::all();
    return view('pages.transparansi', compact('donasi'));
})->name('transparansi');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// <?php

// use Illuminate\Support\Facades\Route;

// // Halaman utama
// Route::get('/', function () {
//     return view('landing');
// })->name('landing');

// // Halaman layanan
// Route::get('/layanan', function () {
//     return view('layanan');
// })->name('layanan');

// // Halaman donasi
// Route::get('/donasi', function () {
//     return view('donasi');
// })->name('donasi');

// // Halaman transparansi
// Route::get('/transparansi', function () {
//     return view('transparansi');
// })->name('transparansi');

// // Halaman login
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// // Halaman register
// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');

