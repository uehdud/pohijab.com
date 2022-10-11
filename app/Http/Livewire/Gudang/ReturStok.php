<?php

namespace App\Http\Livewire\Gudang;

use App\Models\ProdukInout;
use App\Models\ResumeStokOnline;
use Livewire\Component;

class ReturStok extends Component
{
    public function refreshStok()
    {
        $this->emit('refreshDataStok');
    }

    public function render()
    {
        $stokonline = ResumeStokOnline::all()->sortDesc();
        return view('livewire.gudang.retur-stok', ['stokonline' => $stokonline]);
    }

    public function addCart($id)
    {
        $stokproduk = ResumeStokOnline::where('id', $id)->first();
        $datacart = [
            'kode_barang' => $stokproduk->kode_barang,
            'quantity' => $stokproduk->jumlah_stok_online
        ];
        $addcart = ProdukInout::create($datacart);
        $this->refreshStok($id);
        //dd($stokproduk->kode_barang);
    }
}
