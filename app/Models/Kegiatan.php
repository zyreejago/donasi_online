<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'gambar',
        'tanggal',
        'aktif'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'aktif' => 'boolean',
    ];
}

