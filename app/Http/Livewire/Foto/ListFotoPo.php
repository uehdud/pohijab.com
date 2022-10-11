<?php

namespace App\Http\Livewire\Foto;

use App\Models\FotoVideoProduk;
use Livewire\Component;
use Livewire\WithPagination;

class ListFotoPo extends Component
{
    use WithPagination;
    public $search;

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function render()
    {
        $listfotoPo = FotoVideoProduk::where('kode_barang', 'like', '%' . $this->search . '%')
            ->orWhere('kode_model', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        //dd($listfotoPo);

        return view('livewire.foto.list-foto-po', ['listfotopo' => $listfotoPo]);
    }
}
