<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeStokOnline extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang',
        'lokasi',
        'jumlah_stok_online',
        'warna_id',
        'ukuran_id',
        'kode_merk',
        'status_so',
        'foto_id'
    ];

    public function suratjalan()
    {
        return $this->belongsTo(GudangOnline::class, 'kode_barang', 'kode_barang');
    }

    public function detail()
    {
        return $this->belongsTo(ProdukProduksi::class, 'kode_barang', 'kode_barang');
    }

    public function warna()
    {
        return $this->belongsTo(MstWarna::class, 'warna_id', 'id');
    }
    public function ukuran()
    {
        return $this->belongsTo(MstUkuran::class, 'ukuran_id', 'id');
    }
    public function detailukuran()
    {
        return $this->belongsTo(DetailProdukPlanet::class, 'kode_barang', 'kode_barang');
    }
    public function foto()
    {
        return $this->belongsTo(FotoVideoProduk::class, 'kode_barang', 'kode_barang');
    }
    public function fotosatuan()
    {
        return $this->hasMany(DetailFotoVideo::class, 'fotovideo_produk_id', 'kode_barang');
    }
}
