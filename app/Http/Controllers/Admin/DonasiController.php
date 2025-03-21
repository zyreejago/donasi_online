<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DonasiRejected;
use App\Mail\DonasiVerified;
use App\Models\Donasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DonasiController extends Controller
{
    /**
     * Menampilkan daftar donasi
     */
    public function index(Request $request)
    {
        $status = $request->status;
        $query = Donasi::query();
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $donasis = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.donasi.index', compact('donasis', 'status'));
    }
    
    /**
     * Menampilkan detail donasi
     */
    public function show($id)
    {
        $donasi = Donasi::findOrFail($id);
        return view('admin.donasi.show', compact('donasi'));
    }
    
    /**
     * Memperbarui status donasi
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,terverifikasi,ditolak',
            'catatan_admin' => 'nullable|string'
        ]);
        
        $donasi = Donasi::findOrFail($id);
        $oldStatus = $donasi->status;
        
        $donasi->status = $request->status;
        $donasi->catatan_admin = $request->catatan_admin;
        $donasi->save();
        
        // Cari user berdasarkan email donasi
        $user = User::where('email', $donasi->email)->first();
        
        // Jika user ditemukan dan status berubah, kirim email
        if ($user && $oldStatus != $request->status) {
            try {
                if ($request->status === 'terverifikasi') {
                    // Kirim email donasi terverifikasi
                    Mail::to($user->email)->send(new DonasiVerified($donasi, $user->name));
                } elseif ($request->status === 'ditolak') {
                    // Kirim email donasi ditolak
                    Mail::to($user->email)->send(new DonasiRejected($donasi, $user->name));
                }
                
                return redirect()->route('admin.donasi.show', $id)
                                ->with('success', 'Status donasi berhasil diperbarui dan notifikasi email telah dikirim');
            } catch (\Exception $e) {
                // Log error
                Log::error('Gagal mengirim email: ' . $e->getMessage());
                
                return redirect()->route('admin.donasi.show', $id)
                                ->with('success', 'Status donasi berhasil diperbarui tetapi gagal mengirim email: ' . $e->getMessage());
            }
        }
        
        return redirect()->route('admin.donasi.show', $id)
                        ->with('success', 'Status donasi berhasil diperbarui');
    }
    
    /**
     * Menghapus donasi
     */
    public function destroy($id)
    {
        $donasi = Donasi::findOrFail($id);
        
        // Hapus bukti pembayaran jika ada
        if ($donasi->bukti_pembayaran) {
            Storage::delete('public/bukti_pembayaran/' . $donasi->bukti_pembayaran);
        }
        
        $donasi->delete();
        
        return redirect()->route('admin.donasi.index')
                        ->with('success', 'Donasi berhasil dihapus');
    }
    public function generateReport(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggalMulai = Carbon::parse($request->tanggal_mulai)->startOfDay();
        $tanggalAkhir = Carbon::parse($request->tanggal_akhir)->endOfDay();

        // Ambil data donasi yang terverifikasi dalam rentang tanggal
        $donasis = Donasi::where('status', 'terverifikasi')
                    ->whereBetween('created_at', [$tanggalMulai, $tanggalAkhir])
                    ->orderBy('created_at', 'asc')
                    ->get();

        // Hitung total donasi uang
        $totalDonasiUang = $donasis->where('metode_donasi', 'uang')->sum('jumlah');
        
        // Hitung jumlah donasi per jenis
        $jumlahPerJenis = $donasis->groupBy('jenis_donasi')
                            ->map(function ($item) {
                                return $item->count();
                            });

        // Hitung jumlah donasi per metode
        $jumlahPerMetode = $donasis->groupBy('metode_donasi')
                            ->map(function ($item) {
                                return $item->count();
                            });

        $data = [
            'donasis' => $donasis,
            'tanggalMulai' => $tanggalMulai,
            'tanggalAkhir' => $tanggalAkhir,
            'totalDonasiUang' => $totalDonasiUang,
            'jumlahPerJenis' => $jumlahPerJenis,
            'jumlahPerMetode' => $jumlahPerMetode,
            'tanggalCetak' => Carbon::now(),
        ];

        $pdf = PDF::loadView('admin.donasi.report', $data);
        
        return $pdf->download('laporan-donasi-' . $tanggalMulai->format('d-m-Y') . '-sampai-' . $tanggalAkhir->format('d-m-Y') . '.pdf');
    }
}