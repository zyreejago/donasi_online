<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class HomeController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::where('aktif', true)
                    ->orderBy('tanggal', 'desc')
                    ->take(3)
                    ->get();
                    
        return view('pages.landing', compact('kegiatan'));
    }
    
    public function allKegiatan()
    {
        $kegiatan = Kegiatan::where('aktif', true)
                    ->orderBy('tanggal', 'desc')
                    ->paginate(9);
                    
        return view('kegiatan', compact('kegiatan'));
    }
    
    public function detailKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('kegiatan-detail', compact('kegiatan'));
    }
}

