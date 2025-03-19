<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DonasiController extends Controller
{
    /**
     * Menampilkan form donasi
     */
    public function index()
    {
        return view('pages.donasi');
    }
    
    /**
     * Menyimpan donasi baru
     */
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'email' => 'required|email',
            'jenis_donasi' => 'required|string',
            'metode_donasi' => 'required|string|in:uang,barang',
            'jumlah' => 'required_if:metode_donasi,uang|nullable|numeric|min:1000',
            'deskripsi_barang' => 'required_if:metode_donasi,barang|nullable|string',
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
        
        $donasi->status = 'pending'; // Default status
        $donasi->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Donasi berhasil dikirim! Silahkan lakukan pembayaran dan upload bukti pembayaran.',
            'data' => $donasi
        ]);
    }
    
    /**
     * Upload bukti pembayaran
     */
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $donasi = Donasi::findOrFail($id);
        
        // Cek apakah donasi milik user yang login
        if ($donasi->email !== Auth::user()->email) {
            return back()->with('error', 'Anda tidak memiliki akses untuk donasi ini');
        }
        
        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus file lama jika ada
            if ($donasi->bukti_pembayaran && Storage::exists('public/bukti_pembayaran/' . $donasi->bukti_pembayaran)) {
                Storage::delete('public/bukti_pembayaran/' . $donasi->bukti_pembayaran);
            }
            
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/bukti_pembayaran', $filename);
            
            $donasi->bukti_pembayaran = $filename;
            $donasi->save();
            
            return back()->with('success', 'Bukti pembayaran berhasil diunggah');
        }
        
        return back()->with('error', 'Gagal mengunggah bukti pembayaran');
    }
    
    /**
     * Menampilkan riwayat donasi
     */
    public function riwayat()
    {
        $user = Auth::user();
        $donasis = Donasi::where('email', $user->email)
                        ->where('status', 'terverifikasi')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
                        
        return view('pages.riwayat', compact('user', 'donasis'));
    }
    
    /**
     * Menampilkan detail donasi
     */
    public function show($id)
    {
        $donasi = Donasi::findOrFail($id);
        
        // Cek apakah donasi milik user yang login
        if ($donasi->email !== Auth::user()->email) {
            return back()->with('error', 'Anda tidak memiliki akses untuk donasi ini');
        }
        
        // Get settings
        $settings = [
            'alamat_pengiriman' => Setting::getValue('alamat_pengiriman', ''),
            'nama_lembaga' => Setting::getValue('nama_lembaga', 'Yayasan Peduli Kasih'),
            'telepon' => Setting::getValue('telepon', ''),
            'qris_image' => Setting::getValue('qris_image', ''),
        ];
        
        return view('pages.donasi-detail', compact('donasi', 'settings'));
    }
}