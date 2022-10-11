<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestJoin extends Model
{
    use HasFactory;
    protected $tabel = 'stock_out';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';

    public function contoh()
    {
        return $this->hasOne(TestJoinA::class, 'kode', 'kode');
    }
}
