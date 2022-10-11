<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokRevisiSj extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_sj',
        'kode_barang',
        'id_warna',
        'id_ukuran',
        'qty_revisi',
        'status_kirim',
        'status_barang',
        'gudang_asal',
        'keterangan',
        'user_input',
    ];
}
