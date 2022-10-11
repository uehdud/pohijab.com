<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stokoutdetail extends Model
{
    use HasFactory;
    protected $tabel = 'stock_out_detail';
    protected $primaryKey = 'podetail_id';
}
