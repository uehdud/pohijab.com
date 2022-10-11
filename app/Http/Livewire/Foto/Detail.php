<?php

namespace App\Http\Livewire\Foto;

use App\Models\DetailFotoVideo;
use App\Models\FotoVideoProduk;
use App\Models\ResumeStatus;
use App\Models\Statusproduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use stdClass;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class Detail extends Component
{
    use WithFileUploads;

    public $datafotos;
    public $photo;
    public $link;
    public $kode_barang;
    public $kode_model;
    public $foto_satuan = [];
    public $foto_comp = [];
    public $ekstensi = [];
    public $filesize = [];
    public $keterangan_foto;
    public $status_foto = 1;
    public $gudang_foto = 1;
    public $ekstensi_combo;
    public $filesize_combo;
    public $video_produk;
    public $size_video;


    protected $listeners = ['delete'];

    public function mount($kb)
    {
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
    }

    public function simpanVideo()
    {
        $kb = $this->kode_barang;
        //dd($this->video_produk);
        /* store foto combo S3*/
        $this->video_produk->store($kb, 's3');
        $this->ekstensi_video = $this->video_produk->getClientOriginalExtension();
        $this->filesize_video = $this->video_produk->getSize();

        $updatecombo = FotoVideoProduk::where('kode_barang', $kb)->first();
        $updatecombo->video_produk = Storage::disk('s3')->url($this->video_produk->store($kb, 's3'));
        $updatecombo->video_folder = $this->video_produk->store($kb, 's3');
        $updatecombo->ekstensi_video =  $this->ekstensi_video;
        $updatecombo->filesize_video =  $this->filesize_video;
        $updatecombo->save();

        return redirect(request()->header('Referer'));
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
        return redirect(request()->header('Referer'));
        session()->flash('message', 'Foto Berhasil Ditambahkan');
        //dd($datadetail);
    }
    public function remove()
    {
        $this->photo = null;
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
    public function simpanGambar()
    {
        $kb = $this->kode_barang;

        /* store foto combo S3*/
        $this->photo->store($kb, 's3');
    }

    public function saveFotoVideoProduk()
    {

        $kb = $this->kode_barang;
        $kbn = $this->kode_barang . Str::random(10);
        $kbs = $this->kode_barang . '/';
        $image = Image::make($this->photo)->resize(1000, 1000);
        $path = Storage::disk('s3')->put($kbs . $kbn . '.jpg', $image->stream());
        $peth = Storage::disk('s3')->url($kbs . $kbn . '.jpg');


        $this->simpanGambar();
        $kb = $this->kode_barang;
        $image_nama = $this->photo->store($kb, 's3');
        $this->ekstensi_combo = $this->photo->getClientOriginalExtension();
        $this->filesize_combo = $this->photo->getSize();
        $image_path = Storage::disk('s3')->url($image_nama);
        /*  $data = [
            'kode_barang' => $this->kode_barang,
            'kode_model' => $this->kode_model,
            'image_produk' => $image_path,
            'image_comp' => $peth,
            'image_folder' => $image_nama,
            'keterangan_foto' => $this->keterangan_foto,
            'user_upload' => Auth::id()
        ];

        FotoVideoProduk::create($data); */
        $updatecombo = FotoVideoProduk::where('kode_barang', $kb)->first();
        $updatecombo->kode_barang = $this->kode_barang;
        $updatecombo->kode_model = $this->kode_model;
        $updatecombo->image_produk = $image_path;
        $updatecombo->image_comp = $peth;
        $updatecombo->image_comp_folder = $kbs . $kbn . '.jpg';
        $updatecombo->image_folder = $image_nama;
        $updatecombo->ekstensi_combo = $this->ekstensi_combo;
        $updatecombo->filesize_combo = $this->filesize_combo;
        $updatecombo->keterangan_foto = $this->keterangan_foto;
        $updatecombo->save();

        $this->updateStatus();
        $this->updateResumeStatus();
        return redirect(request()->header('Referer'));
        session()->flash('message', 'Foto Combo Berhasil Ditambahkan');
    }


    public function downloadFoto()
    {
        $path = DB::table('foto_video_produks')
            ->where('kode_barang', $this->kode_barang)
            ->select('image_folder')
            ->get();
        $object = new stdClass();
        foreach ($path as $key => $value) {
            $object->$key = $value;
        }
        $kodeb = $value->image_folder;
        // dd($kodeb);
        return Storage::disk('s3')->download($kodeb);
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

    public function deleteCombo($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Anda yakin untuk menghapus?',
            'text' => '',
            'id' => $id

        ]);
    }

    public function delete($id)
    {
        $deletekombo = FotoVideoProduk::find($id);
        Storage::disk('s3')->delete($deletekombo->image_folder);
        Storage::disk('s3')->delete($deletekombo->image_comp_folder);
        if ($deletekombo) {
            $deletekombo->image_produk = null;
            $deletekombo->image_comp = null;
            $deletekombo->image_folder = null;
            $deletekombo->ekstensi_combo = null;
            $deletekombo->filesize_combo = null;
            $deletekombo->save();
        }

        $this->emit('refreshFoto');
        return redirect(request()->header('Referer'));
    }



    public function deletevideo($id)
    {
        $deletekombo = FotoVideoProduk::find($id);
        Storage::disk('s3')->delete($deletekombo->video_folder);
        if ($deletekombo) {
            $deletekombo->video_produk = null;
            $deletekombo->ekstensi_video = null;
            $deletekombo->filesize_video = null;
            $deletekombo->save();
        }
        //Storage::disk('s3')->delete('$deletekombo->image_folder');
        $this->emit('refreshFoto');
        return redirect(request()->header('Referer'));
    }


    public function render()
    {
        return view('livewire.foto.detail');
    }
}
