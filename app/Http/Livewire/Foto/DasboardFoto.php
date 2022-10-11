<?php

namespace App\Http\Livewire\Foto;

use App\Models\FotoVideoProduk;
use Livewire\Component;
use Livewire\WithPagination;

class DasboardFoto extends Component
{
    use WithPagination;
    public $search;
    public function render()
    {
        $listfotoPo = FotoVideoProduk::where('kode_barang', 'like', '%' . $this->search . '%')
            ->orWhere('kode_model', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        return view('livewire.foto.dasboard-foto', ['listfotopo' => $listfotoPo]);
    }
}
