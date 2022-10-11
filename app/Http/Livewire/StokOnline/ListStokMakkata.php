<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\ResumeStokOnline;
use Livewire\Component;
use Livewire\WithPagination;

class ListStokMakkata extends Component
{
    use WithPagination;
    public $search;
    public $jumlahstok;

    protected $listeners = [
        'refreshcartout' => '$refresh',
        'rendercart' => 'render',
    ];

    public function mount()
    {
        $jumlah = ResumeStokOnline::where('kode_merk', 'A')->get();
        $this->jumlahstok = 0;
        foreach ($jumlah as $jum) {
            $this->jumlahstok += $jum['jumlah_stok_online'];
        }
    }

    public function render()
    {
        $liststokmakkata = ResumeStokOnline::where('kode_merk', 'A')
            ->where('kode_barang', 'like', '%' . $this->search . '%')
            ->groupBy('kode_barang', 'warna_id')
            ->paginate(10);
        return view('livewire.stok-online.list-stok-makkata', ['liststokmakkata' => $liststokmakkata]);
    }
}
