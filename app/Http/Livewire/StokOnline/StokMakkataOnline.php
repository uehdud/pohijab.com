<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\FolderWarnaFoto;
use App\Models\ResumeStokOnline;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StokMakkataOnline extends Component
{
    use WithPagination;

    public $foto_id;
    public $produk_id;
    public $search = '';
    public $datasearchfoto;
    public $datafoto;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function tambahFoto($id)
    {
        $this->produk_id = ResumeStokOnline::where('id', $id)->first()->id;
        $model = ResumeStokOnline::with('detail')
            ->where('id', $id)->first()->detail->kode_model;

        $this->datasearchfoto = DB::table('folder_warna_fotos')
            ->join('folder_model_fotos', 'folder_warna_fotos.model_id', '=', 'folder_model_fotos.id')
            ->join('mst_warnas', 'folder_warna_fotos.warna_id', '=', 'mst_warnas.id')
            ->where('folder_model_fotos.kode_model', $model)
            ->where('kategori_file', 'utama')
            ->where('jenis_file', 'foto')
            ->select(
                'folder_warna_fotos.id',
                'nama_warna',
                'nama_cantik',
                'kode_model',
                'file_comp_c'
            )
            ->get();
        //dd($this->datasearchfoto);


        /*  $this->datasearchfoto = FolderWarnaFoto::with('mstwarna', 'mstmodel')
            // ->where('warna_id', '2')
            ->where('kategori_file', 'utama')
            ->where('jenis_file', 'foto')
            ->get(); */
        $this->dispatchBrowserEvent('openUpdateGudang');
    }

    public function mount()
    {
        $this->datasearchfoto = FolderWarnaFoto::with('mstwarna', 'mstmodel')
            ->where('kategori_file', 'utama')
            ->where('jenis_file', 'foto')
            ->get();
    }

    public function updateFoto()
    {
        //dd($this->search);
        $update =  ResumeStokOnline::where('id', $this->produk_id)->first();
        $update->foto_id = $this->foto_id;
        $update->save();
        $this->dispatchBrowserEvent('closeUpdateGudang');
        return redirect(request()->header('Referer'));
    }

    public function searchingdata()
    {

        $this->dispatchBrowserEvent('openUpdateGudang');
        $this->datasearchfoto = FolderWarnaFoto::with('mstwarna', 'mstmodel')
            ->where('warna_id', 'like', '%' . $this->search . '%')
            ->where('kategori_file', 'utama')
            ->where('jenis_file', 'foto')
            ->get();
    }



    public function render()
    {
        $datagudang = DB::table('resume_stok_onlines')
            ->join('produk_produksis', 'resume_stok_onlines.kode_barang', '=', 'produk_produksis.kode_barang')
            ->join('mst_warnas', 'resume_stok_onlines.warna_id', '=', 'mst_warnas.id')
            ->join('mst_ukurans', 'resume_stok_onlines.ukuran_id', '=', 'mst_ukurans.id')
            ->leftJoin('folder_warna_fotos', 'resume_stok_onlines.foto_id', 'folder_warna_fotos.id')
            ->leftJoin('folder_model_fotos', 'folder_warna_fotos.model_id', 'folder_model_fotos.id')
            ->select(
                'resume_stok_onlines.id',
                'file_utama',
                'file_comp_a',
                'file_comp_b',
                'file_comp_c',
                'folder_file_utama',
                'produk_produksis.kode_model',
                'resume_stok_onlines.kode_barang',
                'jumlah_stok_online',
                'nama_warna',
                'resume_stok_onlines.warna_id',
                'harga_planet',
                'harga_ta',
                'foto_id',
                'nama_cantik',
                'produk_produksis.kode_merk',
                'lokasi'
            )
            ->where('produk_produksis.kode_merk', 'A')
            ->groupBy('resume_stok_onlines.kode_barang', 'resume_stok_onlines.warna_id')
            ->orderBy('resume_stok_onlines.created_at', 'desc')
            ->where(function ($query) {
                $query->where('resume_stok_onlines.kode_barang', 'like', '%' . $this->search . '%')
                    ->orWhere('produk_produksis.kode_model', 'like', '%' . $this->search . '%')
                    ->orwhere('nama_cantik', 'like', '%' . $this->search . '%');
            })
            ->paginate(12);

        $jumlahstok = ResumeStokOnline::where('kode_merk', 'A')->get();
        $jumlah = 0;
        foreach ($jumlahstok as $stok) {
            $jumlah += $stok['jumlah_stok_online'];
        }

        // dd($datagudang);
        return view('livewire.stok-online.stok-makkata-online', ['datagudang' => $datagudang, 'jumlah' => $jumlah]);
    }
}
