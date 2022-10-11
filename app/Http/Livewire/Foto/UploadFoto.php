<?php

namespace App\Http\Livewire\Foto;

use App\Models\FotoVideoProduk;
use App\Models\ResumeStatus;
use App\Models\Statusproduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class UploadFoto extends Component
{
    use WithFileUploads;

    public $photo;
    public $photo2 = [];
    public $photo3 = [];
    public $photo4 = [];
    public $photo5 = [];
    public $kode_barang;
    public $kode_model;
    public $image_path;
    public $image_data;
    public $kb;
    public $foto_satuans = [];
    public $videopo;
    public $status_foto = 1;
    public $gudang_foto = 2;
    public $keterangan_foto;

    /*    public $itemsatu = 1;
    public $itemdua = 2;
    public $itemtiga = 3;
    public $item = 0;
    public $looper = 0;

    public $count = 0;

    public $isOpen = false; */



    /* public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count > 0 && $this->count--;
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
    } */

    public function simpanGambar()
    {
        $kb = $this->kode_barang;

        /* store foto combo S3*/
        $this->photo->store($kb, 's3');
    }

    public function kompresGambar()
    {
        $kb = $this->kode_barang;
        $kbn = $this->kode_barang . Str::random(10);
        $kbs = $this->kode_barang . '/';
        $image = Image::make($this->photo)->resize(1000, 1000);
        $path = Storage::disk('s3')->put($kbs . $kbn . '.jpg', $image->stream());
        $peth = Storage::disk('s3')->url($kbs . $kbn . '.jpg');
    }

    public function checkItem()
    {
        $this->emit('tab1');
    }

    public function updateStatus()
    {
        $datastatus = [
            'kode_barang' => $this->kode_barang,
            'status_id' => $this->status_foto,
            'gudang_id' => $this->gudang_foto,
            'user_update' => Auth::id(),
        ];
        Statusproduk::create($datastatus);
    }

    public function updateResumeStatus()
    {
        /*  $statuspo = ResumeStatus::where('kode_barang', $this->kode_barang)->first();
        if ($statuspo === null) { */
        $resumestatus = [
            'kode_barang' => $this->kode_barang,
            'status_id' => $this->status_foto,
            'gudang_id' => $this->gudang_foto,
            'user_update' => Auth::id()
        ];
        ResumeStatus::updateOrCreate(['kode_barang' => $this->kode_barang], $resumestatus);
    }

    /* public function imageSatuan()
    {
        $kb = $this->kode_barang;
        $image_satuan =  $this->foto_satuans->store($kb, 's3');
        $image_path_satuan = Storage::disk('s3')->url($image_satuan);
        $dataImageSatuan = [
            'kode_barang' => $this->kode_barang,
        ];
    } */

    public function clearField()
    {
        $this->kode_barang = null;
        $this->kode_model = null;
        $this->photo = null;
    }

    public function remove()
    {
        $this->photo = null;
    }


    protected $rules = [
        'kode_barang' => 'required|numeric|min:4',
        'kode_model' => 'required'
    ];

    public function saveFotoVideoProduk()
    {
        $kb = $this->kode_barang;
        $kbn = $this->kode_barang . Str::random(10);
        $kbs = $this->kode_barang . '/';
        $image = Image::make($this->photo)->resize(1000, 1000);
        $path = Storage::disk('s3')->put($kbs . $kbn . '.jpg', $image->stream());
        $peth = Storage::disk('s3')->url($kbs . $kbn . '.jpg');

        $validatedData = $this->validate();
        $this->simpanGambar();
        $kb = $this->kode_barang;
        $image_nama =  $this->photo->store($kb, 's3');
        $image_path = Storage::disk('s3')->url($image_nama);
        $data = [
            'kode_barang' => $this->kode_barang,
            'kode_model' => $this->kode_model,
            'image_produk' => $image_path,
            'image_comp' => $peth,
            'image_comp_folder' => $kbs . $kbn . '.jpg',
            'image_folder' => $image_nama,
            'keterangan_foto' => $this->keterangan_foto,
            'user_upload' => Auth::id()
        ];

        FotoVideoProduk::create($data);
        $this->updateStatus();
        $this->updateResumeStatus();
        $this->clearField();
        session()->flash('message', 'Data In Out Foto Berhasil Ditambahkan');
        $this->emit('refreshParent');
    }


    public function save()
    {
        /*  $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);

        $this->photo->store('photos'); */
    }



    public function render()
    {
        return view('livewire.foto.upload-foto');
    }
}
