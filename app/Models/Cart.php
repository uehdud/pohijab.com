<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'qty_cart',
        'jenis_inout',
        'status_kirim',
        'user_input'
    ];

    public function produk()
    {
        return $this->belongsTo(ResumeGudangStudio::class, 'produk_id', 'id');
    }

    public function produks()
    {
        return $this->belongsTo(ResumeStokOnline::class, 'produk_id', 'id');
    }
}
