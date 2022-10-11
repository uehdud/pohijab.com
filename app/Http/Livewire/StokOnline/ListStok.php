<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\DetailProdukPlanet;
use App\Models\FotoVideoProduk;
use App\Models\ProdukProduksi;
use App\Models\ResumeStokOnline;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListStok extends Component
{
    use WithPagination;

    public $search;

    public $edit_allsize;
    public $edit = 0;
    public $jumlahstok;
    public $jumlahstokplanet;
    public $jumlahstokmakkata;
    public $ukuran_ld = null;
    public $ukuran_pb = null;
    public $ukuran_lp = null;
    public $ukuran_lph = null;
    public $ukuran_pc = null;
    public $lokasi;
    public $kb;
    public $hargaup;
    public $hargata;
    public $bahan;
    public $deskripsi;
    public $warna;
    public $namakategori;

    protected $listeners = [
        'refreshcart' => '$refresh',
        'rendercart' => 'render',
    ];

    public function mount()
    {
        $jumlah = ResumeStokOnline::whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])->get();
        $this->jumlahstok = 0;
        foreach ($jumlah as $jum) {
            $this->jumlahstok += $jum['jumlah_stok_online'];
        }
        //dd($this->jumlahstok);
    }

    public function tambahItem($itemId, $action)
    {
        // dd($itemId, $action);
        $datamodal = ResumeStokOnline::with('detail.kategoris')->where('id', $itemId)
            ->first();
        $this->edit_allsize = $datamodal->jumlah_stok_online;
        $this->lokasi = $datamodal->lokasi;
        $detail = DetailProdukPlanet::where('kode_barang', $datamodal->kode_barang)
            ->first();
        if (DetailProdukPlanet::where('kode_barang', $datamodal->kode_barang)->select('ukuran_ld')->exists()) {
            $this->ukuran_ld = $detail->ukuran_ld;
        }
        if (DetailProdukPlanet::where('kode_barang', $datamodal->kode_barang)->select('ukuran_pb')->exists()) {
            $this->ukuran_pb = $detail->ukuran_pb;
        }
        if (DetailProdukPlanet::where('kode_barang', $datamodal->kode_barang)->select('ukuran_lp')->exists()) {
            $this->ukuran_lp = $detail->ukuran_lp;
        }
        if (DetailProdukPlanet::where('kode_barang', $datamodal->kode_barang)->select('ukuran_lph')->exists()) {
            $this->ukuran_lph = $detail->ukuran_lph;
        }
        if (DetailProdukPlanet::where('kode_barang', $datamodal->kode_barang)->select('ukuran_pc')->exists()) {
            $this->ukuran_pc = $detail->ukuran_pc;
        }
        if (DetailProdukPlanet::where('kode_barang', $datamodal->kode_barang)->select('deskripsi')->exists()) {
            $this->deskripsi = $detail->deskripsi;
        }

        //dd($datamodal);
        $this->hargaup =  ($datamodal->detail->harga_ta) + (0.3 * ($datamodal->detail->harga_ta));
        $this->hargata =  $datamodal->detail->harga_ta;
        $this->bahan =  $datamodal->detail->nama_bahan;
        $this->warna =  $datamodal->detail->keterangan_po;
        //dd($this->hargaup, $this->hargata);
        $this->kb = $datamodal->kode_barang;
        $this->namakategori = $datamodal->detail->kategoris->nama_kategori;
        //dd($this->namakategori);
        $this->itemId = $itemId;
        if ($action === 'update') {
            $this->dispatchBrowserEvent('openEditStokOnline');
        } else {
            $this->dispatchBrowserEvent('openDeskripsiStokOnline');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $datastok = DB::table('resume_stok_onlines')
            ->leftJoin('detail_produk_planets', 'resume_stok_onlines.kode_barang', '=', 'detail_produk_planets.kode_barang')
            ->leftJoin('produk_produksis', 'resume_stok_onlines.kode_barang', '=', 'produk_produksis.kode_barang')
            ->where('jumlah_stok_online', '>', 0)
            //->where('resume_stok_onlines.kode_merk', 'X')
            ->whereIn('resume_stok_onlines.kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])
            //->whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V', 'O'])
            ->orderBy('resume_stok_onlines.created_at', 'desc')
            /* 
            ->join('produk_produksis', 'resume_stok_onlines.kode_barang', '=', 'produk_produksis.kode_barang')->where('produk_produksis.kode_merk', 'X')
            
             */

            ->select(
                'resume_stok_onlines.kode_barang',
                'lokasi',
                'produk_produksis.merk',
                'resume_stok_onlines.id',
                'harga_planet',
                'harga_ta',
                'jumlah_stok_online',
                'ukuran_ld',
                'ukuran_pb',
                'ukuran_lp',
                'ukuran_lph',
                'ukuran_pc',
            )
            ->where('resume_stok_onlines.kode_barang', 'like', '%' . $this->search . '%')
            ->orWhere('lokasi', 'like', '%' . $this->search . '%')
            ->paginate(10);

        $listfotoPo = DB::table('resume_stok_onlines')
            ->leftJoin('detail_produk_planets', 'resume_stok_onlines.kode_barang', '=', 'detail_produk_planets.kode_barang')
            ->leftJoin('foto_video_produks', 'resume_stok_onlines.kode_barang', '=', 'foto_video_produks.kode_barang')
            ->join('produk_produksis', 'resume_stok_onlines.kode_barang', '=', 'produk_produksis.kode_barang')
            ->where('resume_stok_onlines.kode_barang', 'like', '%' . $this->search . '%')
            ->orwhere('produk_produksis.merk', 'like', '%' . $this->search . '%')
            ->whereIn('resume_stok_onlines.kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])
            //whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V', 'O'])
            ->orderBy('resume_stok_onlines.created_at', 'desc')
            /* 
            ->join('produk_produksis', 'resume_stok_onlines.kode_barang', '=', 'produk_produksis.kode_barang')->where('produk_produksis.kode_merk', 'X')
            
             */

            ->select(
                'resume_stok_onlines.kode_barang',
                'lokasi',
                'produk_produksis.merk',
                'resume_stok_onlines.id',
                'harga_planet',
                'harga_ta',
                'jumlah_stok_online',
                'ukuran_ld',
                'ukuran_pb',
                'ukuran_lp',
                'ukuran_lph',
                'ukuran_pc',
                'image_comp',
                'image_produk',
                'image_folder',
                'video_produk',
                'video_comp',
                'ekstensi_combo',
                'filesize_combo',
                'ekstensi_video',
                'filesize_video',
                'foto_video_produks.kode_model'
            )
            ->paginate(8);
        // dd($datastok);
        return view('livewire.stok-online.list-stok', ['datastok' => $datastok, 'listfotopo' => $listfotoPo]);
    }

    public function clearForm()
    {
        $this->deskripsi = null;
        $this->ukuran_ld = null;
        $this->ukuran_pb = null;
        $this->ukuran_lp = null;
        $this->ukuran_lph = null;
        $this->ukuran_pc = null;
    }

    public function editForm()
    {
        $this->edit = 1;
    }
    public function simpaneditStok()
    {
        $edit = ResumeStokOnline::where('id', $this->itemId)->first();
        //dd($edit);
        $edit->jumlah_stok_online = $this->edit_allsize;
        $edit->lokasi = $this->lokasi;
        $edit->save();

        if (DetailProdukPlanet::where('kode_barang', $edit->kode_barang)->exists()) {
            $detail = DetailProdukPlanet::where('kode_barang', $edit->kode_barang)
                ->update([
                    'ukuran_ld' => $this->ukuran_ld,
                    'ukuran_pb' => $this->ukuran_pb,
                    'ukuran_lp' => $this->ukuran_lp,
                    'ukuran_lph' => $this->ukuran_lph,
                    'ukuran_pc' => $this->ukuran_pc,
                ]);
        } else {
            $data = [
                'kode_barang' => $edit->kode_barang,
                'ukuran_ld' => $this->ukuran_ld,
                'ukuran_pb' => $this->ukuran_pb,
                'ukuran_lp' => $this->ukuran_lp,
                'ukuran_lph' => $this->ukuran_lph,
                'ukuran_pc' => $this->ukuran_pc,
            ];
            DetailProdukPlanet::create($data);
        }

        session()->flash('message', 'data berhasil diubah');
        $this->render();
        $this->clearForm();
        $this->dispatchBrowserEvent('closeEditStokOnline');
    }
    public function simpandeskripsi()
    {
        $edit = ResumeStokOnline::where('id', $this->itemId)->first();

        if (DetailProdukPlanet::where('kode_barang', $edit->kode_barang)->exists()) {
            $deskripsidetail = DetailProdukPlanet::where('kode_barang', $edit->kode_barang)
                ->update(['deskripsi' => $this->deskripsi]);
        } else {
            $data = [
                'kode_barang' => $edit->kode_barang,
                'deskripsi' => $this->deskripsi,

            ];
            DetailProdukPlanet::create($data);
        }


        session()->flash('message', 'data berhasil diubah');
        $this->render();
    }
}
