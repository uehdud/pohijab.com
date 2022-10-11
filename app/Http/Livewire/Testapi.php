<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Pagination\Paginator;

class Testapi extends Component
{
    public $product_id;
    public $bahan;
    public $noPO;
    public $kodebarang;
    public function render()
    {

        return view('livewire.testapi',  ['data' => Produk::all()]);
    }
    public $poID;
    public $po;
    public $produks = null;

    public function clearForm()
    {
        $this->noPO = '';
        $this->kodebarang = '';
    }

    public function store()
    {
        $produks = null;
        $response = Http::get('https://bahanapi.pohijab.com/api/bahan/' . $this->noPO);
        if ($response->successful()) {
            $produks = json_decode($response, true);
            $produks = $produks[0];
        }

        // dd($nopo);

        Produk::create([
            'product_id' => $produks['po'],
            'bahan' => $produks['produk'],
            'KB' => $this->kodebarang
        ]);
        $this->clearForm();
    }

    public function delete($id)
    {
        Produk::where('id', $id)->delete();
    }
}
