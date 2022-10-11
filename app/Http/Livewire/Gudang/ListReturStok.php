<?php

namespace App\Http\Livewire\Gudang;

use App\Models\ProdukInout;
use App\Models\ResumeStokOnline;
use Livewire\Component;

class ListReturStok extends Component
{


    protected $listeners = [
        'refreshDataStok' => 'render'
    ];

    public function mount()
    {;
    }

    public function render()
    {
        $produk_inout = ProdukInout::all()->sortDesc();
        return view('livewire.gudang.list-retur-stok', ['produk_inout' => $produk_inout]);
    }
}
