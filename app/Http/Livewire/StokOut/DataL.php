<?php

namespace App\Http\Livewire\StokOut;

use App\Models\ResumeStokGudangPusat;
use Livewire\Component;

class DataL extends Component
{
    public $kb;
    public $warna;
    public $datas;
    public $datal_stok;
    public function mount($kb = null, $warna = null)
    {
        if (ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 4)
            ->exists()
        ) {
            $this->datas = ResumeStokGudangPusat::where('kode_barang', $kb)
                ->where('warna_id', $warna)
                ->where('ukuran_id', 4)
                ->first();
            $this->datal_stok = $this->datas->total_stok;
        } else {
            $this->datal_stok = 0;
        }
    }
    public function render()
    {
        return view('livewire.stok-out.data-l');
    }
}
