<?php

namespace App\Http\Livewire\Stok;

use App\Models\CartProduk;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartInOut extends Component
{
    protected $listeners = [
        'refreshcart' => '$refresh',
        'rendercart' => 'render',
    ];

    public function render()
    {
        $this->cartproduk = CartProduk::where('user_input_cart', Auth::id())
            ->groupBy('kode_barang', 'id_warna')
            ->where('status_kirim', 1)
            ->where('jenis_inout', 10)
            ->get();
        return view('livewire.stok.cart-in-out', ['cartproduk' => $this->cartproduk]);
    }
}
