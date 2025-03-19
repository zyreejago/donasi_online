<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $kegiatan = Kegiatan::where('aktif', 1)->orderBy('tanggal', 'desc')->get() ?? collect();
    return view('admin.kegiatan.index', compact('kegiatan'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date',
            'aktif' => 'boolean',
        ]);

        $data = $request->all();
        
        // Handle file upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = 'kegiatan-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/images/kegiatan', $namaFile);
            $data['gambar'] = $namaFile;
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date',
            'aktif' => 'boolean',
        ]);

        $data = $request->all();
        
        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($kegiatan->gambar) {
                Storage::delete('public/images/kegiatan/' . $kegiatan->gambar);
            }
            
            // Upload new image
            $gambar = $request->file('gambar');
            $namaFile = 'kegiatan-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/images/kegiatan', $namaFile);
            $data['gambar'] = $namaFile;
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        // Delete image
        if ($kegiatan->gambar) {
            Storage::delete('public/images/kegiatan/' . $kegiatan->gambar);
        }
        
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}

