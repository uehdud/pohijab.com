<?php

namespace App\Http\Livewire\Foto;

use App\Models\FotoVideoProduk;
use Livewire\Component;

class ImageCombo extends Component
{
    public $datafotos;

    protected $listeners = [
        'refreshFoto' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.foto.image-combo');
    }

    public function mount($id)
    {
        $this->datafotos = FotoVideoProduk::find($id);
        $this->kode_barang = $this->datafotos->kode_barang;
        $this->kode_model = $this->datafotos->kode_model;
    }
}
