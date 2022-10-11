<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokGudangPusat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'no_po',
        'no_surat_jalan',
        'qty',
        'warna_id',
        'ukuran_id',
        'status_inout',
        'keterangan_inout',
        'user_input'
    ];
}
