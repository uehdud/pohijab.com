<?php

namespace App\Http\Livewire\Produksi;

use App\Models\Datapo;
use App\Models\Produk;
use App\Models\ProdukProduksi;
use App\Models\ResumeStatus;
use App\Models\Statusproduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AddPo extends Component
{
    public $propo;
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
    public $keterangan_po;
    public $status_id;
    public $statustampil;
    public $selectedNopo;
    public $detaildatapos = [];
    public $chekpo = null;
    public $status_po = 5;
    public $gudang_po = 5;
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

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

    protected $rules = [

        'kode_barang' => 'required|integer|min:4',
        'qty_seri' => 'required',

    ];



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function clearForm()
    {
        $this->datapo = '';
        $this->kode_barang = '';
        $this->qty_seri = '';
        $this->harga_ta = '';
        $this->harga_planet = '';
        $this->keterangan_po = '';
    }
    public function mount()
    {

        $produks = null;
        $response = Http::get('https://bahanapi.pohijab.com/api/bahan/');
        if ($response->successful()) {
            $produks = json_decode($response, true);
        }
        $this->datapos = $produks;
    }

    public function checkButton()
    {
        $this->chekpo = 1;
        $nomorpo = $this->datapo;
        $produks = null;
        $response = Http::get('https://bahanapi.pohijab.com/api/bahan/' . $nomorpo);
        if ($response->successful()) {
            $produks = json_decode($response, true);
            $produks = $produks[0];
        }
        $promerks = $produks['merk'];
        $probahans = $produks['produk'];
        $prokbahans = $produks['sku'];
        $prokmodels = $produks['model'];
        $proksupps = $produks['kode_supplier'];
        $prosupps = $produks['pembeli'];
        $this->promerk = $promerks;

        $this->probahan = $probahans;
        $this->prokbahan = $prokbahans;
        $this->prokmodel = $prokmodels;
        $this->proksupp  = $proksupps;
        $this->prosupp  = $prosupps;
    }




    public function inputStatus()
    {
        $this->status_id = 5;

        $datastatus = [
            'kode_barang' => $this->kode_barang,
            'status_id' => $this->status_id,
            'jumlah_barang' => $this->qty_seri,
            'user_update' => Auth::id(),
        ];
        Statusproduk::create($datastatus);
    }

    public function refreshFormPo()
    {
        return;
    }

    public function updateResumeStatus()
    {
        /*  $statuspo = ResumeStatus::where('kode_barang', $this->kode_barang)->first();
        if ($statuspo === null) { */
        $resumestatus = [
            'kode_barang' => $this->kode_barang,
            'status_id' => $this->status_po,
            'gudang_id' => $this->gudang_po,
            'user_update' => Auth::id()
        ];
        ResumeStatus::updateOrCreate(['kode_barang' => $this->kode_barang], $resumestatus);
    }


    public function store()
    {
        $this->validate();
        $nomorpo = $this->datapo;
        $produks = null;
        $response = Http::get('https://bahanapi.pohijab.com/api/bahan/' . $nomorpo);
        if ($response->successful()) {
            $produks = json_decode($response, true);
            $produks = $produks[0];
        }
        $propos = $produks['po'];
        $this->propo = $propos;
        // dd($propo);
        $inputdatapo = [
            'nomor_po' => $produks['po'],
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
            'user_input_po' => Auth::id(),
            'keterangan_po' => $this->keterangan_po
        ];

        ProdukProduksi::create($inputdatapo);
        $this->inputStatus();
        $this->updateResumeStatus();
        $this->clearForm();
        session()->flash('message', 'Data In Out Foto Berhasil Ditambahkan');
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.produksi.add-po');
    }
}
