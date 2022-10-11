<?php

namespace App\Http\Livewire\Foto;

use App\Models\DetailFotoVideo;
use App\Models\Detailproduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use stdClass;
use Aws\S3\S3Client;

class ListFotoSatuan extends Component
{
    public $foto_satuan = [];

    protected $listeners = ['delete'];

    public function render()
    {
        return view('livewire.foto.list-foto-satuan');
    }

    public function mount($kb)
    {
        $this->foto_satuan = DetailFotoVideo::where('fotovideo_produk_id', $kb)->get();
        //dd($this->foto_satuan);
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

    public function hapusFotoSatuan($id)
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
        $deletesatuan = DetailFotoVideo::find($id);
        //$pathdelete = 'penyimpananplanet' . '/' . $deletesatuan->folder_image;
        //dd($deletesatuan->folder_image);
        Storage::disk('s3')->delete($deletesatuan->folder_image);
        DetailFotoVideo::where('id', $id)->delete($deletesatuan->folder_image);
        return redirect(request()->header('Referer'));
    }
}
