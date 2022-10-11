<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStokProduksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'warna_id',
        'stok',
        'user_input'
    ];
    public function warna()
    {
        return $this->belongsTo(MstWarna::class, 'warna_id', 'id');
    }
}
