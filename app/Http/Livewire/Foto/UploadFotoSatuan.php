<?php

namespace App\Http\Livewire\Foto;

use App\Models\DetailFotoVideo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFotoSatuan extends Component
{
    use WithFileUploads;
    public $foto_satuan = [];
    public $foto_comp = [];
    public $ekstensi = [];
    public $kode_barang;
    public $filesize = [];


    public function render()
    {
        return view('livewire.foto.upload-foto-satuan');
    }

    public function simpanFotoSatuan()
    {
        $kb = $this->kode_barang;


        foreach ($this->foto_satuan as $key => $image) {

            $this->foto_satuan[$key] = $image->store($kb, 's3');
            $this->ekstensi[$key] = $image->getClientOriginalExtension();
            $this->filesize[$key] = $image->getSize();
            $image_path = Storage::disk('s3')->url($this->foto_satuan[$key]);
            $datadetail = [
                'fotovideo_produk_id' => $kb,
                'imagevideo_detail' => $image_path,
                'ekstension' => $this->ekstensi[$key],
                'file_size' => $this->filesize[$key],
                'folder_image' => $this->foto_satuan[$key],
                'user_upload_detail' => Auth::id()
            ];
            $createdetail = DetailFotoVideo::create($datadetail);
        }

        //dd($datadetail);
    }
}
