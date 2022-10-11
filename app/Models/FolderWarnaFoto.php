<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolderWarnaFoto extends Model
{
    use HasFactory;

    public function mstwarna()
    {
        return $this->belongsTo(MstWarna::class, 'warna_id', 'id');
    }
    public function mstmodel()
    {
        return $this->belongsTo(FolderModelFoto::class, 'model_id', 'id');
    }
}
