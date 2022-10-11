<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_surat_jalan',
        'jumlah_produk',
        'produk_id',
        'tanggal_surat_jalan',
        'gudang_asal',
        'gudang_tujuan',
        'status_inout',
        'keterangan_surat_jalan',
        'status_kirim_sj',
        'user_input',
    ];

    public function stokonline()
    {
        return $this->belongsToMany(GudangOnline::class, 'no_surat_jalan', 'no_surat_jalan');
    }
    public function gudangTujuan()
    {
        return $this->belongsTo(MstToko::class, 'gudang_tujuan', 'id');
    }
    public function gudangAsal()
    {
        return $this->belongsTo(MstGudang::class, 'gudang_asal', 'id');
    }

    public function toko()
    {
        return $this->belongsTo(MstToko::class, 'gudang_tujuan', 'id');
    }
    public function statusSJ()
    {
        return $this->belongsTo(MstStatus::class, 'status_kirim_sj', 'id');
    }
   
}
