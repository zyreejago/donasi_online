<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDonasi = Donasi::count();
        $totalPending = Donasi::where('status', 'pending')->count();
        $totalTerverifikasi = Donasi::where('status', 'terverifikasi')->count();
        $totalDitolak = Donasi::where('status', 'ditolak')->count();
        $totalUser = User::where('role', 'user')->count();
        $totalDanaUang = Donasi::where('metode_donasi', 'uang')
                            ->where('status', 'terverifikasi')
                            ->sum('jumlah');
        
        $donasiTerbaru = Donasi::orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
        
        return view('admin.dashboard', compact(
            'totalDonasi', 
            'totalPending', 
            'totalTerverifikasi', 
            'totalDitolak',
            'totalUser',
            'totalDanaUang',
            'donasiTerbaru'
        ));
    }
}