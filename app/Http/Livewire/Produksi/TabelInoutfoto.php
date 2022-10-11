<?php

namespace App\Http\Livewire\Produksi;

use App\Models\ProdukProduksi;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TabelInoutfoto extends Component
{
    public $action;
    public $selectedItem;
    
    protected $listeners = [
        'refreshParent' => 'refresh'
    ];

    public function selectItem($itemId, $action)
    {
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
        $datainout = ProdukProduksi::all()->sortDesc();
        /*  $datainout = DB::table('produk_produksis')
            ->join('statusproduks', 'produk_produksis.kode_barang', '=', 'statusproduks.kode_barang')
            ->join('mst_statuses', 'statusproduks.status_id', '=',  'mst_statuses.id')
            ->groupBy('nomor_po')
            ->orderBy('produk_produksis.id', 'desc')
            ->get(); */
            
        return view('livewire.produksi.tabel-inoutfoto', ['datainout' => $datainout]);
    }
}
