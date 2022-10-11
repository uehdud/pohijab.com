<?php

namespace App\Http\Livewire\Foto;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadVideo extends Component
{
    use WithFileUploads;

    public $kode_barang;
    public $video_produk;
    public function render()
    {
        return view('livewire.foto.upload-video');
    }
    public function simpanVideo()
    {
        $kb = $this->kode_barang;
        //dd($this->video_produk);
        /* store foto combo S3*/
        $this->video_produk->store($kb, 's3');
    }
}
