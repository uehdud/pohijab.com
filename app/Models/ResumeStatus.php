<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang',
        'status_id',
        'gudang_id',
        'total_stok',
        'user_update'
    ];
}
