<?php

namespace App\Http\Livewire\GudangOnline;

use App\Models\ProdukInoutSj;
use App\Models\SuratJalan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PrintResumeSj extends Component
{
    public $datasj;
    public $dataproduk;
    public $userpenerbitsj;


    public function mount($id)
    {

        $this->datasj = SuratJalan::where('id', $id)->first();
        $this->dataproduk = ProdukInoutSj::where('no_sj', $this->datasj->nomor_surat_jalan)
            //->where('status_kirim', 21)
            ->get();

        $user = Auth::id();
        $this->userpenerbitsj = User::where('id', $user)->first();
    }
    public function render()
    {

        $resume = ProdukInoutSj::with('detailProduk.kategori')
            ->where('no_sj',  $this->datasj->nomor_surat_jalan)
            ->whereIn('status_kirim', [21, 3])
            ->groupBy('kode_barang')
            ->selectRaw('kode_barang, sum(qty_produk) as jumlah')
            ->get();
        return view('livewire.gudang-online.print-resume-sj', ['resume' => $resume]);
    }
}
