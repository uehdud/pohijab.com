<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Produk extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nopo',
        'kode_barang',
        'kb',
        'qty_seri',
        'harga_ta',
        'harga_planet',
        'nama_bahan',
        'kode_bahan',
        'merk',
        'kode_model',
        'kode_supp',
        'nama_supp',
        'user_pengirim',
        'tanggal_kirim',
        'status'
    ];
    public function setDueDateAttribute($value)
    {
        $this->attributes['tanggal_kirim'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}
