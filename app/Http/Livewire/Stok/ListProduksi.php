<?php

namespace App\Http\Livewire\Stok;

use App\Models\MstKategori;
use App\Models\MstMerk;
use App\Models\ProdukProduksi;
use Livewire\Component;
use Livewire\WithPagination;

class ListProduksi extends Component
{
    use WithPagination;
    public $search;
    public $searchs = '';
    public $perPage = 10;
    //protected $paginationTheme = 'bootstrap';
    public $kategori;
    public $merk;
    public $orderBykategori;
    public $sortColumnPo = 'created_at';
    public $sortDirection = 'desc';

    public function mount()
    {
        $this->kategori = MstKategori::all();
        $this->merk = MstMerk::all();
    }

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

    public function render()
    {
        $data = ProdukProduksi::with('kategori')
            ->where('nomor_po', 'like', '%' . $this->search . '%')
            ->orwhere('kode_barang', 'like', '%' . $this->search . '%')
            ->orwhere('merk', 'like', '%' . $this->search . '%')
            ->orwhere('kode_model', 'like', '%' . $this->search . '%')
            ->orwhere('kode_bahan', 'like', '%' . $this->search . '%')
            ->orwhere('nama_bahan', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortColumnPo, $this->sortDirection)
            ->paginate($this->perPage);
        //dd($data);
        return view('livewire.stok.list-produksi', ['listproduksi' => $data]);
    }
}
