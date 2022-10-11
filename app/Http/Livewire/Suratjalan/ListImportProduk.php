<?php

namespace App\Http\Livewire\Suratjalan;

use App\Models\CartSuratJalan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListImportProduk extends Component
{
    public $listimportproduk;

    protected $listeners = [
        'refreshdata' => 'mount',
        'refreshcartimport' => 'mount'
    ];

    public function mount()
    {
        $this->listimportproduk = CartSuratJalan::where('status_kirim', 1)
            ->where('user_id', Auth::id())
            ->groupBy('gudang_penerima')
            ->selectRaw('status_kirim, id, gudang_penerima, sum(quantity) as qty, count(kode_barang) as barang')
            ->get();
        //dd($this->listimportproduk);
    }
    public function render()
    {
        return view('livewire.suratjalan.list-import-produk');
    }



    public function tambah($id)
    {

        $produk = CartSuratJalan::where('id', $id)->first();
        $gudang_penerima = $produk->gudang_penerima;

        $dataproduk = CartSuratJalan::where('gudang_penerima', $gudang_penerima)
            ->where('status_kirim', 1)
            ->where('user_id', Auth::id())
            ->get();
        // dd($gudang_penerima);
        foreach ($dataproduk as $data) {
            $updateproduk = CartSuratJalan::where('id', $data['id'])->first();
            $updateproduk->status_kirim = 3;
            $updateproduk->save();
        }
        $this->mount();
        $this->emit('refreshcart');
    }

    public function clearData()
    {
        $clear = CartSuratJalan::where('status_kirim', 1)
            ->where('user_id', Auth::id())
            ->get();

        foreach ($clear as $item) {
            $updatep = CartSuratJalan::where('id', $item['id'])->first();
            $updatep->status_kirim = 2;
            $updatep->save();
        }
        $this->mount();
    }
}
