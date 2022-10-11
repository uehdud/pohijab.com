<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukInoutSj extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_sj',
        'kode_barang',
        'qty_produk',
        'id_ukuran',
        'status_kirim',
        'status_barang',
        'id_warna',
        'id_revisi',
        'user_input'
    ];
    public function warna()
    {
        return $this->belongsTo(MstWarna::class, 'id_warna', 'id');
    }
    public function ukuran()
    {
        return $this->belongsTo(MstUkuran::class, 'id_ukuran', 'id');
    }
    public function detailProduk()
    {
        return $this->belongsTo(ProdukProduksi::class, 'kode_barang', 'kode_barang');
    }
    public function statusKirim()
    {
        return $this->belongsTo(MstStatus::class, 'status_kirim', 'id');
    }
    public function statusBarang()
    {
        return $this->belongsTo(MstStatus::class, 'status_barang', 'id');
    }
    public function userInput()
    {
        return $this->belongsTo(User::class, 'user_input', 'id');
    }
}
