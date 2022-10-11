<?php

namespace App\Http\Livewire\GudangOnline;

use App\Models\DetailProdukPlanet;
use App\Models\ProdukProduksi;
use App\Models\ResumeStokOnline;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StokPixel extends Component
{
    use WithPagination;
    public $search;
    public $orderBykategori;
    public $sortColumnPo = 'created_at';
    public $sortDirection = 'desc';
    public $cekkb;

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

    public function sortPo($nomorPo)
    {
        if ($this->sortColumnPo === $nomorPo) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumnPo = $nomorPo;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    public function updatingSearch()
    {
        $this->resetPage();
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

    public function render()
    {
        $cekstok = ResumeStokOnline::with('detail.kategori', 'detailukuran')->where('kode_merk', 'X')
            ->where('jumlah_stok_online', '>', 0)
            ->where('kode_barang', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortColumnPo, $this->sortDirection)
            ->paginate(10);

        foreach ($cekstok as $item) {
            if (ProdukProduksi::where('kode_barang', $item['kode_barang'])->exists()) {
                $this->cekkb = 1;
            } else {
                $this->cekkb = 0;
            }
        }

        /* 

        $fotostokpixel = ResumeStokOnline::with('detail.kategori', 'detailukuran', 'foto')
            ->where('kode_merk', 'X')
            ->where('jumlah_stok_online', '>', 0)
            ->where('kode_barang', 'like', '%' . $this->search . '%')
            ->paginate(8); */
        $datastokpixel = DB::table('resume_stok_onlines')
            ->leftJoin('produk_produksis', 'resume_stok_onlines.kode_barang', '=', 'produk_produksis.kode_barang')
            ->leftJoin('detail_produk_planets', 'resume_stok_onlines.kode_barang', '=', 'detail_produk_planets.kode_barang')
            ->leftJoin('mst_kategoris', 'produk_produksis.id_kategori', '=', 'mst_kategoris.id')
            ->where('produk_produksis.kode_merk', 'X')
            ->where('jumlah_stok_online', '>', 0)
            /* ->where('resume_stok_onlines.kode_barang', 'like', '%' . $this->search . '%')
            ->orWhere('produk_produksis.nama_bahan', 'like', '%' . $this->search . '%') */
            ->where(function ($query) {
                $query->where('resume_stok_onlines.kode_barang', 'like', '%' . $this->search . '%')
                    ->orWhere('produk_produksis.nama_bahan', 'like', '%' . $this->search . '%');
            })
            ->select(
                'lokasi',
                'resume_stok_onlines.kode_barang',
                'jumlah_stok_online',
                'resume_stok_onlines.id',
                'harga_ta',
                'harga_planet',
                'ukuran_ld',
                'ukuran_pb',
                'ukuran_lp',
                'ukuran_lph',
                'ukuran_pc',
                'nama_kategori',
                'nama_bahan'
            )
            ->orderBy('lokasi', 'asc')
            ->paginate(10);

        /* $datastokpixel = ResumeStokOnline::with('detail.kategori', 'detailukuran')
            ->where('kode_merk', 'X')
            ->where('jumlah_stok_online', '>', 0)
            ->where('kode_barang', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortColumnPo, $this->sortDirection)
            ->paginate(10); */


         $fotostokpixel = DB::table('resume_stok_onlines')
            ->leftJoin('foto_video_produks', 'resume_stok_onlines.kode_barang', '=', 'foto_video_produks.kode_barang')
            ->where('resume_stok_onlines.kode_merk', 'X')
            ->where('jumlah_stok_online', '>', 0)
            ->where('resume_stok_onlines.kode_barang', 'like', '%' . $this->search . '%')
            ->select(
                'image_comp',
                'resume_stok_onlines.id',
                'resume_stok_onlines.kode_barang',
            )
            ->orderBy('lokasi', 'asc')
            ->paginate(8); 

        return view('livewire.gudang-online.stok-pixel', ['stokpixel' => $datastokpixel, 'listfotopo' => $fotostokpixel]);
    }

    public function clearForm()
    {
        $this->deskripsi = null;
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
