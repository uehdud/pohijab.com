<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokGudangMakkata extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang',
        'no_po',
        'id_ukuran',
        'id_warna',
        'no_surat_jalan',
        'qty',
        'status_inout',
        'keterangan_inout',
        'user_input'
    ];
}
