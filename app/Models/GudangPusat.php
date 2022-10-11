<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangPusat extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_surat_jalan',
        'no_po',
        'kode_barang',
        'quantity',
        'status_produk',
        'keterangan_inout',
        'user_input_stok_online',
        'tanggal_inout'
    ];

    public function detailpo()
    {
        return $this->belongsTo(ProdukProduksi::class, 'no_po', 'nomor_po');
    }
}
