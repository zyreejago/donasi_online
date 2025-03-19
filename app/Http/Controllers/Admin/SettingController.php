<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan
     */
    public function index()
    {
        $settings = [
            'alamat_pengiriman' => Setting::getValue('alamat_pengiriman', ''),
            'nama_lembaga' => Setting::getValue('nama_lembaga', 'Yayasan Peduli Kasih'),
            'telepon' => Setting::getValue('telepon', ''),
            'email' => Setting::getValue('email', ''),
            'qris_image' => Setting::getValue('qris_image', ''),
        ];
        
        return view('admin.settings.index', compact('settings'));
    }
    
    /**
     * Memperbarui pengaturan
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'alamat_pengiriman' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email',
            'qris_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Update text settings
        Setting::setValue('nama_lembaga', $request->nama_lembaga);
        Setting::setValue('alamat_pengiriman', $request->alamat_pengiriman);
        Setting::setValue('telepon', $request->telepon);
        Setting::setValue('email', $request->email);
        
        // Update QRIS image if uploaded
        if ($request->hasFile('qris_image')) {
            $oldQris = Setting::getValue('qris_image');
            
            // Delete old image if exists
            if ($oldQris && Storage::exists('public/settings/' . $oldQris)) {
                Storage::delete('public/settings/' . $oldQris);
            }
            
            $file = $request->file('qris_image');
            $filename = 'qris_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/settings', $filename);
            
            Setting::setValue('qris_image', $filename);
        }
        
        return redirect()->route('admin.settings.index')
                        ->with('success', 'Pengaturan berhasil diperbarui');
    }
}