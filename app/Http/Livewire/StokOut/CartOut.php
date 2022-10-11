<?php

namespace App\Http\Livewire\StokOut;

use App\Models\CartProduk;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartOut extends Component
{
    protected $listeners = [
        'refreshcartout' => '$refresh',
        'rendercart' => 'render',
    ];
    public function render()
    {
        $this->cartproduk = CartProduk::where('user_input_cart', Auth::id())
            ->groupBy('kode_barang', 'id_warna')
            ->where('status_kirim', 1)
            ->where('jenis_inout', 11)
            ->get();
        return view('livewire.stok-out.cart-out', ['cartproduk' => $this->cartproduk]);
    }
}
