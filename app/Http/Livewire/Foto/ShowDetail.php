<?php

namespace App\Http\Livewire\Foto;

use App\Models\DetailFotoVideo;
use App\Models\FotoVideoProduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use stdClass;

class ShowDetail extends Component
{
    public $datafoto;
    public $kode_barang;
    public $foto_satuan;



    public function mount($kb)
    {
        $this->datafoto = FotoVideoProduk::where('kode_barang', $kb)->first();

        $this->datafotos = FotoVideoProduk::where('kode_barang', $kb)->first();
        $bytes = $this->datafotos->filesize_video;
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        $this->kode_barang = $this->datafotos->kode_barang;
        $this->kode_model = $this->datafotos->kode_model;
        $this->size_video = $bytes;

        $this->foto_satuan = DetailFotoVideo::where('fotovideo_produk_id', $kb)->get();
    }

    public function downloadVideo()
    {
        $path = DB::table('foto_video_produks')
            ->where('kode_barang', $this->kode_barang)
            ->select('video_folder')
            ->get();
        $object = new stdClass();
        foreach ($path as $key => $value) {
            $object->$key = $value;
        }
        $kodeb = $value->video_folder;
        // dd($kodeb);
        return Storage::disk('s3')->download($kodeb);
    }

    public function render()
    {
        return view('livewire.foto.show-detail');
    }

    public function downloadFotoSatuan($id)
    {
        $path = DB::table('detail_foto_videos')
            ->where('id', $id)
            ->select('folder_image')
            ->get();
        //dd($path);
        $object = new stdClass();
        foreach ($path as $key => $value) {
            $object->$key = $value;
        }
        $kodeb = $value->folder_image;
        // dd($kodeb);
        return Storage::disk('s3')->download($kodeb);
    }

    public function downloadFoto()
    {

        $path = DB::table('foto_video_produks')
            ->where('kode_barang', $this->datafoto->kode_barang)
            ->select('image_folder')
            ->get();
        //dd($path);
        $object = new stdClass();
        foreach ($path as $key => $value) {
            $object->$key = $value;
        }
        $kodeb = $value->image_folder;
        // dd($kodeb);
        return Storage::disk('s3')->download($kodeb);
    }
}
