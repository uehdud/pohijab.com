<?php

namespace App\Http\Livewire\Gudang;

use App\Models\MstToko;
use App\Models\Produk;
use App\Models\ProdukProduksi;
use App\Models\ResumePembagianStokPusat;
use Livewire\Component;

class PembagianStokPusat extends Component
{

    /*    protected $rules = [
        'no_po' => 'required',
        'jumlah_produksi' => 'required',
    ];

    public function clearField()
    {
        $this->no_po = null;
        $this->jumlah_produksi = null;
    }

    public function inputStokPusat()
    {
        $validatedData = $this->validate();
        $dataStokPusat = [
            'no_po' => $this->no_po,
            'stok_pusat' => $this->jumlah_produksi,
            'keterangan_inout' => $this->keterangan_inout,
            'user_update_stok_pusat' => Auth::id()
        ];
        GudangPusat::create($dataStokPusat);
        $this->emit('listRefresh');
        $this->clearField();
        session()->flash('message', 'Stok Pusat Berhasil Ditambahkan');
    } */
    public $listpo = [];
    public $tokos = [];
    public $nama_toko;

    public function mount()
    {
        $this->listpo = ResumePembagianStokPusat::all()->sortDesc();
        $this->tokos = [
            ['toko_id' => '', 'qty' => '']
        ];
    }

    public function tambahToko()
    {
        $this->tokos[] = ['toko_id' => '', 'qty' => ''];
    }
    public function removeToko($index)
    {
        unset($this->tokos[$index]);
        $this->tokos = array_values($this->tokos);
    }

    /*  public function simpanPembagian()
    {
        $toko = $this->nama_toko;
        dd($toko);
    }
 */
    public function render()
    {
        $listtoko = MstToko::all();
        return view('livewire.gudang.pembagian-stok-pusat', ['listtoko' => $listtoko]);
    }
}
