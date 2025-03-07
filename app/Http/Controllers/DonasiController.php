<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Donasi;

class DonasiController extends Controller
{
    // Menampilkan semua donasi
    public function index()
    {
        return response()->json(Donasi::all(), 200);
    }

    // Menyimpan donasi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'email' => 'nullable|email',
            'jenis_donasi' => 'required|in:zakat,infaq,shodaqoh,qurban,wakaf',
            'metode_donasi' => 'required|in:uang,barang',
            'jumlah' => 'nullable|numeric',
            'deskripsi_barang' => 'nullable|string',
        ]);

        $donasi = Donasi::create($validated);
        return response()->json(['message' => 'Donasi berhasil dikirim!', 'data' => $donasi], 201);
    }

    // Menampilkan detail donasi
    public function show($id)
    {
        return response()->json(Donasi::findOrFail($id), 200);
    }

    // Mengupdate status donasi (verifikasi oleh admin)
    public function update(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->update(['status' => 'terverifikasi']);

        return response()->json(['message' => 'Donasi berhasil diverifikasi!', 'data' => $donasi], 200);
    }

    // Menghapus donasi (opsional)
    public function destroy($id)
    {
        Donasi::destroy($id);
        return response()->json(['message' => 'Donasi berhasil dihapus!'], 200);
    }
}
