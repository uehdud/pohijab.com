<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartSuratJalan extends Model
{
    use HasFactory;

    protected $fillable = [
        'gudang_penerima',
        'tanggal_sj',
        'kode_barang',
        'quantity',
        'user_id',
        'status_kirim',
    ];
    public function detail()
    {
        return $this->belongsTo(ProdukProduksi::class, 'kode_barang', 'kode_barang');
    }

}
