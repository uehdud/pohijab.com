<?php

namespace App\Http\Livewire\StokOut;

use App\Models\ResumeStokGudangPusat;
use Livewire\Component;

class DataAllsize extends Component
{
    public $kb;
    public $warna;
    public $datallsize;
    public $datallsize_stok;

    public function mount($kb = null, $warna = null)
    {
        //dd($kb, $warna);
        if (ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 1)
            ->exists()
        ) {
            $this->datas = ResumeStokGudangPusat::where('kode_barang', $kb)
                ->where('warna_id', $warna)
                ->where('ukuran_id', 1)
                ->first();
            $this->datallsize_stok = $this->datas->total_stok;
        } else {
            $this->datallsize_stok = 0;
        }
    }

    public function render()
    {



        return view('livewire.stok-out.data-allsize');
    }
}
