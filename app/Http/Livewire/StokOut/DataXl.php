<?php

namespace App\Http\Livewire\StokOut;

use App\Models\ResumeStokGudangPusat;
use Livewire\Component;

class DataXl extends Component
{
    public $kb;
    public $warna;
    public $datas;
    public $dataxl_stok;
    public function mount($kb= null, $warna= null)
    {
        if (ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 5)
            ->exists()
        ) {
            $this->datas = ResumeStokGudangPusat::where('kode_barang', $kb)
                ->where('warna_id', $warna)
                ->where('ukuran_id', 5)
                ->first();
            $this->dataxl_stok = $this->datas->total_stok;
        } else {
            $this->dataxl_stok = 0;
        }
    }
    public function render()
    {
        return view('livewire.stok-out.data-xl');
    }
}
