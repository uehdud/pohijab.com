<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\DetailStokProduksi;
use App\Models\ResumeStokOnline;
use Livewire\Component;
use Livewire\WithPagination;

class ListStokOnline extends Component
{
    use WithPagination;
    public $search = '';
    public $cekstatus;
    public $jumlahstok;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $stok = ResumeStokOnline::all();
        $jumlah = 0;
        foreach ($stok as $stoks) {
            $jumlah += $stoks['jumlah_stok_online'];
        }
        $this->jumlahstok = $jumlah;
    }


    public function render()
    {

        $liststok = ResumeStokOnline::with('warna', 'ukuran')
            ->where('jumlah_stok_online', '>', 0)
            ->where('kode_barang', 'like', '%' . $this->search . '%')
            //->whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])
            ->orderBy('updated_at', 'desc')
            ->paginate(20);


        return view('livewire.stok-online.list-stok-online', ['liststok' => $liststok]);
    }
}
