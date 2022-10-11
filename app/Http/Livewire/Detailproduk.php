<?php

namespace App\Http\Livewire;

use App\Models\Detailproduk as ModelsDetailproduk;
use App\Models\ProdukProduksi;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Detailproduk extends Component
{
    use WithPagination;
    public $search;
    public $action;
    public $selectedItem;
    public $nomorpo;
    public $merk;
    public $kodebarang;
    public $kodebahan;
    public $namabahan;
    public $kodemodel;
    public $qtyseri;
    public $keterangan;
    public $hargata;
    public $kodehargata;
    public $hargaplanet;
    public $kodehargaplanet;
    public $nama_kategori;
    public $kode_kategori;
    public $hargamodal;
    public $kodehargamodal;
    public $kode_supp;
    public $itemid;


    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function mount()
    {
    }

    public function selectItem($itemId, $action)
    {
        $data = ProdukProduksi::with('kategori')->where('id', $itemId)->first();
        $this->itemid = $itemId;
        $this->nomorpo = $data->nomor_po;
        $this->merk = $data->merk;
        $this->kodebahan = $data->kode_bahan;
        $this->kodebarang = $data->kode_barang;
        $this->kodemodel = $data->kode_model;
        $this->qtyseri = $data->qty_seri;
        $this->namabahan = $data->nama_bahan;
        $this->hargata = $data->harga_ta;
        $this->kodehargata = $data->kode_harga_ta;
        $this->nama_kategori = $data->kategori->nama_kategori;
        $this->kode_kategori = $data->kategori->kode_kategori;
        $this->kode_supp = $data->kode_supp;
        //dd($this->id_kategori );
        $this->selectedItem = $itemId;
        if ($action == 'delete') {
            $this->dispatchBrowserEvent('openModalDelete');
        } else {
            if ($action == 'update') {
                $this->emit('getPoId', $this->selectedItem);
                $this->dispatchBrowserEvent('updateProduk');
            } else {
                $this->emit('getPoId', null);
            }
        }
    }

    public function render()
    {
        $produkmakkataclanela = DB::table('resume_statuses')
            ->rightJoin('produk_produksis', 'resume_statuses.kode_barang', '=', 'produk_produksis.kode_barang')
            ->leftjoin('mst_statuses', 'status_id', '=', 'mst_statuses.id')
            ->leftjoin('mst_gudangs', 'gudang_id', '=', 'mst_gudangs.id')
            ->select(
                'produk_produksis.id',
                'nomor_po',
                'nama_status',
                'nama_gudang',
                'produk_produksis.kode_barang',
                'kode_model',
                'kode_bahan',
                'nama_bahan',
                'harga_ta',
                'harga_planet',
                'qty_seri',
                'keterangan_po',
                'merk'
            )
            ->whereIn('kode_merk', ['A', 'C'])
            ->where(function ($query) {
                $query->where('produk_produksis.kode_barang', 'like', '%' . $this->search . '%')
                    ->orWhere('kode_model', 'like', '%' . $this->search . '%')
                    ->orWhere('nomor_po', 'like', '%' . $this->search . '%')
                    ->orWhere('nama_bahan', 'like', '%' . $this->search . '%')
                    ->orWhere('merk', 'like', '%' . $this->search . '%');
            })
            ->orderBy('produk_produksis.id', 'desc')
            ->get();

        $produkProduksi = DB::table('resume_statuses')
            ->rightJoin('produk_produksis', 'resume_statuses.kode_barang', '=', 'produk_produksis.kode_barang')
            ->leftjoin('mst_statuses', 'status_id', '=', 'mst_statuses.id')
            ->leftjoin('mst_gudangs', 'gudang_id', '=', 'mst_gudangs.id')
            ->select(
                'produk_produksis.id',
                'nomor_po',
                'nama_status',
                'nama_gudang',
                'produk_produksis.kode_barang',
                'kode_model',
                'kode_bahan',
                'nama_bahan',
                'harga_ta',
                'harga_planet',
                'qty_seri',
                'keterangan_po',
                'merk'
            )
            ->whereIn('kode_merk', ['K', 'NN', 'X', 'C', 'O', 'T', 'G', 'V'])
            ->where(function ($query) {
                $query->where('produk_produksis.kode_barang', 'like', '%' . $this->search . '%')
                    ->orWhere('kode_model', 'like', '%' . $this->search . '%')
                    ->orWhere('nomor_po', 'like', '%' . $this->search . '%')
                    ->orWhere('nama_bahan', 'like', '%' . $this->search . '%')
                    ->orWhere('merk', 'like', '%' . $this->search . '%');
            })
            ->orderBy('produk_produksis.id', 'desc')
            ->paginate(10);


        return view('livewire.detailproduk', ['produkProduksi' => $produkProduksi, 'makkataclanela' => $produkmakkataclanela]);
    }

    public function delete()
    {
        ProdukProduksi::destroy($this->selectedItem);
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function edit()
    {
        $editproduk = ProdukProduksi::where('id', $this->itemid)->first();
        $editproduk->kode_model = $this->kodemodel;
        $editproduk->kode_barang = $this->kodebarang;
        $editproduk->kode_bahan = $this->kodebahan;
        $editproduk->nama_bahan = $this->namabahan;
        $editproduk->qty_seri = $this->qtyseri;
        $editproduk->save();
        session()->flash('message', 'Data Berhasil Diupdate');
        $this->dispatchBrowserEvent('tambahProduk');
        $this->render();
    }
}
