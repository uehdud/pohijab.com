<?php

namespace App\Http\Livewire\Suratjalan;

use App\Models\ProdukInoutSj;
use App\Models\SuratJalan;
use Livewire\Component;

class DetailSj extends Component
{
    public $nomorsj;
    public $tanggalsj;
    public $tujuanSj;
    public $keteranganSj;

    public function mount($no_sj)
    {
        $this->nomorsj = $no_sj;
        $datasj = SuratJalan::with('toko')
            ->where('nomor_surat_jalan', $no_sj)->first();
        $this->tanggalsj =  $datasj->tanggal_surat_jalan;
        $this->tujuanSj = $datasj->toko->nama_toko;
        $this->keteranganSj = $datasj->keterangan_surat_jalan;
        // dd($no_sj);
    }

    public function render()
    {
        // dd($this->nomorsj);
        $datasj = ProdukInoutSj::with('detailProduk.kategori')
            ->where('no_sj', $this->nomorsj)
            ->get();

        //dd($datasj->detailProduk->kategori->kode_kategori);
        return view('livewire.suratjalan.detail-sj', ['produksj' => $datasj]);
    }
}
