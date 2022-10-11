<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_input_cart',
        'kode_barang',
        'kode_merk',
        'quantity',
        'jenis_inout',
        'status_inout',
        'status_kirim',
        'id_ukuran',
        'id_warna',
        'kategori'
    ];

    public function produk()
    {
        return $this->belongsTo(ProdukProduksi::class, 'kode_barang', 'kode_barang');
    }
    public function cekstok()
    {
        return $this->belongsTo(ResumeStokOnline::class, 'kode_barang', 'kode_barang');
    }
    public function produkkategori()
    {
        return $this->belongsTo(MstKategori::class, 'kategori', 'id');
    }
    public function warna()
    {
        return $this->belongsTo(MstWarna::class, 'id_warna', 'id');
    }
    public function ukuran()
    {
        return $this->belongsTo(MstUkuran::class, 'id_ukuran', 'id');
    }
}
