<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukProduksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_po',
        'art',
        'kode_supp',
        'id_kategori',
        'kode_model',
        'kode_bahan',
        'kode_merk',
        'merk',
        'kode_barang',
        'kb',
        'qty_produksi',
        'harga_modal',
        'kode_harga_modal',
        'harga_ta',
        'kode_harga_ta',
        'harga_planet',
        'kode_harga_planet',
        'nama_bahan',
        'qty_seri',
        'keterangan_po',
        'user_input_po',
    ];

    public function fotoStatus()
    {
        return $this->belongsTo(FotoVideoProduk::class, 'kode_barang', 'kode_barang');
    }

    public function statusfoto()
    {
        return $this->belongsTo(ResumeStatus::class, 'kode_barang', 'kode_barang');
    }

    public function stat()
    {
        return $this->hasOne(ResumeStatus::class, 'kode_barang', 'kode_barang');
    }

    public function kategori()
    {
        return $this->belongsTo(MstKategori::class, 'id_kategori', 'id');
    }
    public function kategoris()
    {
        return $this->belongsTo(MstKategori::class, 'id_kategori', 'id');
    }

    
}
