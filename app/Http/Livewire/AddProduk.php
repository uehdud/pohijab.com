<?php

namespace App\Http\Livewire;

use App\Models\Detailproduk;
use App\Models\ProdukProduksi;
use App\Models\ResumeStatus;
use App\Models\Statusproduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class AddProduk extends Component
{
    use WithFileUploads;

    public $nomor_po;
    public $merk;
    public $kode_model;
    public $kode_barang;
    public $qty_seri;
    public $kode_bahan;
    public $nama_bahan;
    public $harga_ta;
    public $harga_planet;
    public $keterangan_po;
    public $status_po = 5;
    public $gudang_po = 5;
    public $editedProductIndex = null;
    public $products = [];
    public $productss = [];
    public $kb;
    public $datapo;
    public $propo;
    public $tanggal_kirim;
    public $status_id;
    public $statustampil;
    public $produks;
    public $image;
    public $keterangan;
    public $no_surat_jalan;

    public $gudang_id = 1;
    public $poId;
    public $image_name;
    public $image_path = null;
    public $image_data = null;

    protected $listeners = [
        'getPoId',
        'forcedCloseModal'
    ];

    public function updateResumeStatus()
    {
        /*  $statuspo = ResumeStatus::where('kode_barang', $this->kode_barang)->first();
        if ($statuspo === null) { */
        if (is_null(ResumeStatus::where('kode_barang', $this->kode_barang)->first())) {
            $resumestatus = [
                'kode_barang' => $this->kode_barang,
                'status_id' => $this->status_po,
                'gudang_id' => $this->gudang_po,
                'user_update' => Auth::id()
            ];
            ResumeStatus::updateOrCreate(['kode_barang' => $this->kode_barang], $resumestatus);
        }
    }

    public function updateStatus()
    {
        $datastatus = [
            'kode_barang' => $this->kode_barang,
            'status_id' => $this->status_po,
            'gudang_id' => $this->gudang_po,
            'user_update' => Auth::id(),
        ];
        Statusproduk::create($datastatus);
    }


    public function getPoId($poId)
    {
        $this->poId = $poId;

        $poProduk = ProdukProduksi::find($this->poId);
        $this->kode_barang = $poProduk->kode_barang;
        $this->qty_terima = $poProduk->qty_terima;
        $this->no_surat_jalan = $poProduk->no_surat_jalan;
        $this->keterangan = $poProduk->keterangan;
    }

    protected $rules = [
        'nomor_po' => 'required|integer',
        'merk' => 'required',
        'kode_model' => 'required',
        'kode_barang' => 'required|integer|min:4',
        'qty_seri' => 'required',
        'kode_bahan' => 'required',
        'nama_bahan' => 'required',
        'harga_ta' => 'required',
        'harga_planet' => 'required',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function clearField()
    {
        $this->nomor_po = null;
        $this->merk = null;
        $this->kode_model = null;
        $this->kode_barang = null;
        $this->qty_seri = null;
        $this->kode_bahan = null;
        $this->nama_bahan = null;
        $this->harga_ta = null;
        $this->harga_planet = null;
        $this->keterangan_po = null;
    }

    public function saveproduk()
    {
        $validatedData = $this->validate();
        $data = [
            'nomor_po' => $this->nomor_po,
            'merk' => $this->merk,
            'kode_model' =>  $this->kode_model,
            'kode_barang' => $this->kode_barang,
            'kb' => $this->kode_barang,
            'qty_seri' => $this->qty_seri,
            'kode_bahan' => $this->kode_bahan,
            'nama_bahan' => $this->nama_bahan,
            'harga_ta' => $this->harga_ta,
            'harga_planet' => $this->harga_planet,
            'keterangan_po' => $this->keterangan_po,
        ];
        //dd($data);
        ProdukProduksi::create($data);
        $this->updateStatus();
        $this->updateResumeStatus();
        $this->dispatchBrowserEvent('tambahProduk');
        $this->clearField();
        session()->flash('message', 'Data In Out Foto Berhasil Ditambahkan');
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.add-produk');
    }
    public function forcedCloseModal()
    {
        // This is to reset our public variables
        $this->clearField();

        // These will reset our error bags
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
