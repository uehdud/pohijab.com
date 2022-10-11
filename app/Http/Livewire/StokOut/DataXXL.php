<?php

namespace App\Http\Livewire\StokOut;

use App\Models\ResumeStokGudangPusat;
use Livewire\Component;

class DataXXL extends Component
{
    public $kb;
    public $warna;
    public $datas;
    public $dataxxl_stok;
    public function mount($kb= null, $warna= null)
    {
        if (ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 6)
            ->exists()
        ) {
            $this->datas = ResumeStokGudangPusat::where('kode_barang', $kb)
                ->where('warna_id', $warna)
                ->where('ukuran_id',6)
                ->first();
            $this->dataxxl_stok = $this->datas->total_stok;
        } else {
            $this->dataxxl_stok = 0;
        }
    }
    public function render()
    {
        return view('livewire.stok-out.data-x-x-l');
    }
}
