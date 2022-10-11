<?php

namespace App\Http\Livewire\StokOut;

use App\Models\ResumeStokGudangPusat;
use Livewire\Component;

class DataM extends Component
{
    public $kb;
    public $warna;
    public $datas;
    public $datam_stok;
    public function mount($kb= null, $warna= null)
    {
        if (ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 3)
            ->exists()
        ) {
            $this->datas = ResumeStokGudangPusat::where('kode_barang', $kb)
                ->where('warna_id', $warna)
                ->where('ukuran_id', 3)
                ->first();
            $this->datam_stok = $this->datas->total_stok;
        } else {
            $this->datam_stok = 0;
        }
    }


    public function render()
    {
        return view('livewire.stok-out.data-m');
    }
}
