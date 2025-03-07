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

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
