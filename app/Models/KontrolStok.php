<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrolStok extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_sj',
        'tanggal_sj',
        'qty',
        'keterangan_sj',
        'tujuan',
        'jenis_inout',
        'user_input'
    ];

    public function tujuan()
    {
        return $this->hasManyThrough(MstToko::class, 'tujuan', 'id');
    }
}
