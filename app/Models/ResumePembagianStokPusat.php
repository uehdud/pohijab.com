<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumePembagianStokPusat extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_po',
        'kode_barang',
        'stok_po',
        'sisa_stok_po',
    ];

    public function detailpo()
    {
        return $this->belongsTo(ProdukProduksi::class, 'no_po', 'nomor_po');
    }
}
