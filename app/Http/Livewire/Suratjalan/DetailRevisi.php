<?php

namespace App\Http\Livewire\Suratjalan;

use App\Models\ProdukInoutSj;
use Livewire\Component;

class DetailRevisi extends Component
{
    public $idrevisi;
    public $kodebarang;
    public $nosj;
    public $tanggal;
    public $warna;
    public $ukuran;
    public $qty;

    protected $listeners = [
        'openModalRevisi' => 'openModal'
    ];

    public function openModal($id)
    {
        $idrevisi = ProdukInoutSj::with('ukuran', 'warna')
            ->where('id_revisi', $id)->first();
        $this->kodebarang = $idrevisi->kode_barang;
        $this->nosj = $idrevisi->no_sj;
        $this->tanggal = $idrevisi->created_at;
        $this->warna = $idrevisi->warna->nama_warna;
        $this->ukuran = $idrevisi->ukuran->nama_ukuran;
        $this->qty = $idrevisi->qty_produk;
        //dd($this->kodebarang);
        $this->dispatchBrowserEvent('openDetailRevisi');
    }



    public function render()
    {
        return view('livewire.suratjalan.detail-revisi');
    }
}
