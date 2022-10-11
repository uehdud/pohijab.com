<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Statusproduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang',
        'status_id',
        'jumlah_barang',
        'gudang_id',
        'user_update'
    ];

    public function stat()
    {
        return $this->belongsTo(MstStatus::class, 'status_id', 'id');
    }

    public function gudang()
    {
        return $this->belongsTo(MstGudang::class, 'gudang_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_update', 'id');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
}
