<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFotoVideo extends Model
{
    use HasFactory;



    protected $fillable = [
        'fotovideo_produk_id',
        'imagevideo_detail',
        'folder_image',
        'image_comp',
        'image_comp_folder',
        'ekstension',
        'file_size',
        'user_upload_detail'
    ];
}
