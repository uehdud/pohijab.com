<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProdukPlanet extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang',
        'ukuran_ld',
        'ukuran_pb',
        'ukuran_lp',
        'ukuran_lph',
        'ukuran_pc',
        'deskripsi'
    ];
}
