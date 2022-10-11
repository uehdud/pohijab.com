<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\DetailStokProduksi;
use Livewire\Component;

class StatusStok extends Component
{
    public $status;
    public function mount($id)
    {
        $this->status = DetailStokProduksi::where('produk_id', $id)->count('produk_id');
       // dd($this->status);
    }
    public function render()
    {
        return view('livewire.stok-online.status-stok');
    }
}
