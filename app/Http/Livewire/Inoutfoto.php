<?php

namespace App\Http\Livewire;

use App\Models\Datapo;
use App\Models\Detailpo;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Inoutfoto extends Component
{
    public $editedProductIndex = null;
    public $products = [];
    public $productss = [];


    public $kb;
    public $nomorpo;
    public $datapo;
    public $kode_barang;
    public $qty_seri;
    public $harga_ta;
    public $harga_planet;
    public $tanggal_kirim;
    public $status = 1;




    public function render()
    {
        $this->products = Produk::all()->toArray();
        $this->productss = collect('products')->sortDesc();
        //dd($produk);
        return view('livewire.inoutfoto',  ['products' => $this->productss]);
    }

    public function editProduct($productIndex)
    {
        $this->editedProductIndex = $productIndex;
    }
    public function saveProduct($productIndex)
    {
        $product = $this->products[$productIndex] ?? NULL;

        if (!is_null($product)) {
            $editedProduct = Produk::find($product['id']);
            if ($editedProduct) {
                $editedProduct->update($product);
            }
        }

        $this->editedProductIndex = null;
    }

    public function clearForm()
    {
        $this->datapo = '';
        $this->kode_barang = '';
        $this->qty_seri = '';
        $this->harga_ta = '';
        $this->harga_planet = '';
        $this->tanggal_kirim = '';
    }
    public function mount()
    {

        $this->datapos = Datapo::all()->sortDesc();
    }



    public function store()
    {

        $nomorpo = $this->datapo;
        $produks = null;
        $response = Http::get('https://bahanapi.pohijab.com/api/bahan/' . $nomorpo);
        if ($response->successful()) {
            $produks = json_decode($response, true);
            $produks = $produks[0];
        }
        Produk::create([

            'nopo' => $produks['po'],
            'kode_barang' => $this->kode_barang,
            'kb' => $this->kode_barang,
            'qty_seri' => $this->qty_seri,
            'harga_ta' => $this->harga_ta,
            'harga_planet' => $this->harga_planet,
            'nama_bahan' => $produks['produk'],
            'kode_bahan' => $produks['sku'],
            'merk' => $produks['merk'],
            'kode_model' => $produks['model'],
            'kode_supp' => $produks['kode_supplier'],
            'nama_supp' => $produks['pembeli'],
            'user_pengirim' => Auth::id(),
            'tanggal_kirim' => $this->tanggal_kirim,
            'status' => $this->status,
        ]);
        $this->clearForm();
    }

    public function edit(Produk $produk)
    {
        $this->dispatchBrowserEvent('show-edit-student-modal');
    }


    public function delete($id)
    {
        Produk::where('id', $id)->delete();
    }
}
