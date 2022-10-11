<?php

namespace App\Http\Livewire\StokOut;

use App\Models\ResumeStokGudangPusat;
use Livewire\Component;

class DataS extends Component
{
    public $kb;
    public $warna;
    public $datas;
    public $datas_stok;

    public function mount($kb= null, $warna= null)
    {
        if (ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 2)
            ->exists()
        ) {
            $this->datas = ResumeStokGudangPusat::where('kode_barang', $kb)
                ->where('warna_id', $warna)
                ->where('ukuran_id', 2)
                ->first();
            $this->datas_stok = $this->datas->total_stok;
        } else {
            $this->datas_stok = 0;
        }
    }

    public function render()
    {

        return view('livewire.stok-out.data-s');
    }
}
