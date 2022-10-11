<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeStokGudangPusat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'no_po',
        'total_stok',
        'warna_id',
        'ukuran_id'
    ];

    public function detailProduk()
    {
        return $this->belongsTo(ProdukProduksi::class, 'kode_barang', 'kode_barang');
    }
    public function warna()
    {
        return $this->belongsTo(MstWarna::class, 'warna_id', 'id');
    }
}
