<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpo extends Model
{
    use HasFactory;
    protected $table = 'stock_out_detail';

    public function namabahan()
    {
        return $this->belongsTo(Tabelsatu::class, 'produk_id');
    }
   
}
