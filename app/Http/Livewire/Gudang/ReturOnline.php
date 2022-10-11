<?php

namespace App\Http\Livewire\Gudang;

use App\Models\ProdukInout;
use App\Models\ResumeStokOnline;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReturOnline extends Component
{
    public $tambahprdk = 0;

    protected $listeners = [
        'tambahProduk'
    ];

    public function tambahProduk()
    {
        $this->tambahprdk = 1;
    }

    public function render()
    {
        $stokonline = ResumeStokOnline::all()->sortDesc();
        return view('livewire.gudang.retur-online', ['stokonline' => $stokonline]);
    }

    public function addCart($id)
    {
        $stokproduk = ResumeStokOnline::where('id', $id)->first();
        $datacart = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $stokproduk->kode_barang,
            'quantity' => $stokproduk->jumlah_stok_online
        ];
        $addcart = ProdukInout::create($datacart);
        $this->emit('refreshCart');
        //dd($stokproduk->kode_barang);
    }
    public function refreshcarttt()
    {
        $this->emit('refreshCart');
    }
}
