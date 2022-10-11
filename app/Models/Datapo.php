<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapo extends Model
{
    use HasFactory;
    protected $table = 'stock_out';
    protected $primaryKey = 'poID';

    public function detailproduk()
    {
        return $this->hasOne(Detailpo::class, 'id', 'produk_id');
    }
    
}
