<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoVideoProduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'kode_model',
        'image_produk',
        'image_comp',
        'image_folder',
        'video_produk',
        'video_comp',
        'user_upload',
        'ekstensi_combo',
        'filesize_combo',
        'ekstensi_video',
        'filesize_video',
    ];

    public function detailfoto()
    {
        return $this->belongsTo(ProdukProduksi::class, 'kode_barang', 'kode_barang');
    }
    public function userUpload()
    {
        return $this->belongsTo(User::class, 'user_upload', 'id');
    }
    public function fotoSatuan()
    {
        return $this->belongsTo(DetailFotoVideo::class, 'kode_barang', 'fotovideo_produk_id');
    }
}
