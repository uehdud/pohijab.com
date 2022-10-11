<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestJoinA extends Model
{
    use HasFactory;
    protected $tabel = 'stock_out_detail';
    public $incrementing = false;
    protected $keyType = 'string';
}
