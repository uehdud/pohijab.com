<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangStudio extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_surat_jalan',
        'lokasi',
        'kode_barang',
        'quantity',
        'status_inout',
        'keterangan_inout',
        'user_input_stok_online',
        'tanggal_inout',
        'warna_id',
        'ukuran_id',
        'kode_merk'
    ];

    public function suratjalan()
    {
        return $this->belongsTo(SuratJalan::class, 'no_surat_jalan', 'no_surat_jalan');
    }
}
