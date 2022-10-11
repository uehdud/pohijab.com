<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditProduk extends ModalComponent
{
    public function render()
    {
        return view('livewire.edit-produk');
    }

    public Produk $produk;

    public function mount(Produk $produk)
    {


        $this->produk = $produk;
        
    }
}
