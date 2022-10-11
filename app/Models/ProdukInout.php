<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukInout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_input_cart',
        'kode_barang',
        'quantity',
        'jenis_inout',
        'status_inout',
        'status_kirim'
    ];
}
