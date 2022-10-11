<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstStatus extends Model
{
    use HasFactory;

    public function produk()
    {
        return $this->hasManyThrough(ProdukProduksi::class, ResumeStatus::class, 'status_id', 'kode_barang', 'id', 'id');
    }
}
