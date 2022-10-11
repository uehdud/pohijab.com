<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembagianStokPusat extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_po',
        'kode_barang',
        'jumlah_stok_pembagian',
        'sisa_stok_po',
        'toko_id',
        'keterangan_toko',
        'user_pembagian',
    ];

    public function namatoko()
    {
        return $this->belongsTo(MstToko::class, 'toko_id', 'id');
    }
}
