<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeGudangMakkata extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'id_ukuran',
        'id_warna',
        'total_stok'
    ];
}
