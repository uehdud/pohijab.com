<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailproduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang',
        'qty_terima',
        'status_id',
        'gudang_id',
        'image_name',
        'video_name',
        'user_upload',
        'no_surat_jalan',
        'keterangan',
        'image_path'
    ];

    public function barang()
    {
        return $this->belongsTo(Produk::class, 'kode_barang', 'kode_barang');
    }
    public function stat()
    {
        return $this->belongsTo(Statusproduk::class,);
    }
}
