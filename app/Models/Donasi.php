<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_donatur', 'email', 'jenis_donasi', 'metode_donasi', 
        'jumlah', 'deskripsi_barang', 'status'
    ];
    
}
