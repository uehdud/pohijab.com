<?php

namespace App\Http\Livewire\GudangOnline;

use App\Models\ResumeStokOnline;
use Livewire\Component;
use Livewire\WithPagination;

class SuratJalanOnline extends Component
{
    use WithPagination;
    public $lokasi = null;
    public $lokasistok;
    public $search;
    public $jumlahstok = 100;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->lokasi === null) {
            $datagudang = ResumeStokOnline::with('warna', 'ukuran')
                ->where('jumlah_stok_online', '>', 0)
                ->orderBy('lokasi', 'asc')
                /*  whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])*/
                ->where('kode_barang', 'like', '%' . $this->search . '%')
                ->paginate(20);
            $jumlahgudang = ResumeStokOnline::all()
                /* whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])
                ->get() */;
            $jumlahstok = 0;
            foreach ($jumlahgudang as $jumlah) {
                $jumlahstok += $jumlah['jumlah_stok_online'];
            }
        } else {
            $datagudang = ResumeStokOnline::with('warna', 'ukuran')
                ->where('jumlah_stok_online', '>', 0)
                /* whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])*/
                ->where('kode_barang', 'like', '%' . $this->search . '%')
                ->where('lokasi', $this->lokasi)
                ->get();

            $jumlahgudang = ResumeStokOnline::
                /* whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])
                -> */where('lokasi', $this->lokasi)
                ->get();
            $jumlahstok = 0;
            foreach ($jumlahgudang as $jumlah) {
                $jumlahstok += $jumlah['jumlah_stok_online'];
            }
        }

        return view('livewire.gudang-online.surat-jalan-online', ['datagudang' => $datagudang, 'jumlahstok' => $jumlahstok]);
    }

    public function refreshdata()
    {
        $this->lokasi = null;
    }
}
