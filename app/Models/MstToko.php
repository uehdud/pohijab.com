<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstToko extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_toko',
        'alamat_toko',
        'kontak_toko',
    ];
}
