<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeStokFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'jumlah_stok_foto'
    ];
}
