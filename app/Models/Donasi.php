<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_donatur',
        'email',
        'jenis_donasi',
        'metode_donasi',
        'jumlah',
        'deskripsi_barang',
        'bukti_pembayaran',
        'status',
        'catatan_admin',
        'user_id',
    ];

    /**
     * Get the user that owns the donation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}