<?php

namespace App\Http\Livewire\Tabel;

use App\Models\ResumeStokGudangPusat;
use Livewire\Component;

class DataList extends Component
{
    public $kb;
    public $data;
    public $datakb;
    public $data_s;
    public $data_m;
    public $data_l;
    public $data_xl;
    public $data_xxl;

    public function mount($kb)
    {

        $this->data_s = ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('ukuran_id', 1)
            ->select('total_stok')
            ->first();
        $this->data_m = ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('ukuran_id', 2)
            ->select('total_stok')
            ->first();
        $this->data_l = ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('ukuran_id', 3)
            ->select('total_stok')
            ->first();
        $this->data_xl = ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('ukuran_id', 4)
            ->select('total_stok')
            ->first();
        $this->data_xxl = ResumeStokGudangPusat::where('kode_barang', $kb)
            ->where('ukuran_id', 5)
            ->select('total_stok')
            ->first();
       // dd($this->data_s, $this->data_m, $this->data_l, $this->data_xl, $this->data_xxl);

        $this->data = ResumeStokGudangPusat::where('kode_barang', $kb)->get();
        foreach ($this->data as $item) {
            $ukuran[] = $item['ukuran_id'];
            $stok[] = $item['total_stok'];
        }


        //if($ukuran_a)
        //dd($ukuran_a, $ukuran_b, $ukuran_c);


        $this->datakb = ResumeStokGudangPusat::where('kode_barang', $kb)->first();
        // dd($kb);
    }

    public function render()
    {
        return view('livewire.tabel.data-list');
    }
}
