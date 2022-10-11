<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\DetailProdukPlanet;
use App\Models\GudangOnline;
use App\Models\MstWarna;
use App\Models\ProdukProduksi;
use App\Models\ResumeStokOnline;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class InputStok extends Component
{
    use WithPagination;
    public $search = null;
    public $qty;
    public $status_inout = 10;
    public $warna = 135;
    public $listwarna;
    public $ukuran_s;
    public $ukuran_m;
    public $ukuran_l;
    public $ukuran_xl;
    public $ukuran_xxl;
    public $ukuran_allsize;
    public $pilih_warna;
    public $cartproduk;
    public $jenis_inout = 10;
    public $lokasi;
    public $kb;
    public $itemId;
    public $ukuran_ld;
    public $ukuran_pb;
    public $ukuran_lp;
    public $ukuran_lph;
    public $ukuran_pc;



    public function mount()
    {
        $this->listwarna = MstWarna::all();
    }

    public function updateProduk()
    {
        $this->search;
        $this->render();
        // dd($this->search);
    }

    protected $rules = [
        'lokasi' => 'required',
        'ukuran_allsize' => 'required',
    ];

    protected $messages = [
        'lokasi.required' => 'silahkan isi lokasi',
        'ukuran_allsize.required' => 'silahkan isi qty',
    ];
    public function clearField()
    {
        $this->lokasi = null;
        $this->ukuran_allsize = null;
        $this->ukuran_ld = null;
        $this->ukuran_pb = null;
        $this->ukuran_lp = null;
        $this->ukuran_lph = null;
        $this->ukuran_pc = null;
    }

    public function tambahItem($itemId, $action)
    {
        //dd($itemId, $action);
        $datamodal = ProdukProduksi::where('id', $itemId)
            ->first();
        // dd($datamodal);
        $this->kb = $datamodal->kode_barang;
        $this->itemId = $itemId;
        $this->dispatchBrowserEvent('openTambahStokOnline');
    }

    public function tambahCart()
    {
        //dd($this->warna);
        $warna = (int)$this->warna;
        $kode_barang = $this->kb;
        $pilihproduk = ProdukProduksi::where('kode_barang', $kode_barang)->first();
        $kategori = $pilihproduk->id_kategori;
        $merk = $pilihproduk->kode_merk;
        $validatedData = $this->validate();

        //dd(ResumeStokOnline::where('kode_barang', $kode_barang)->where('warna_id', $this->warna)->where('ukuran_id', $this->ukuran_allsize)->exists());


        if (ResumeStokOnline::where('kode_barang', $kode_barang)->where('warna_id', $this->warna)->where('ukuran_id', $this->ukuran_allsize)->exists()) {
            if (!is_null($this->ukuran_allsize)) {
                $allsize =   ResumeStokOnline::where('kode_barang', $kode_barang)
                    ->where('warna_id', $this->warna)
                    ->where('ukuran_id', $this->ukuran_allsize)
                    ->first();
                // dd($allsize);
                session()->flash('message', 'data berhasil ditambahkan, lokasi dirubah dari ' . $allsize->lokasi . ' menjadi ' . $this->lokasi);
                $allsize->jumlah_stok_online = $allsize->jumlah_stok_online + $this->ukuran_allsize;
                $allsize->lokasi = $this->lokasi;
                $allsize->save();

                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_allsize,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 1,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);

                if (DetailProdukPlanet::where('kode_barang', $kode_barang)->exists()) {
                    $editdetail = DetailProdukPlanet::where('kode_barang', $kode_barang)->first();
                    $editdetail->ukuran_ld = $this->ukuran_ld;
                    $editdetail->ukuran_pb = $this->ukuran_pb;
                    $editdetail->ukuran_lp = $this->ukuran_lp;
                    $editdetail->ukuran_lph = $this->ukuran_lph;
                    $editdetail->ukuran_pc = $this->ukuran_pc;
                    $editdetail->save();
                } else {
                    $datadetail = [
                        'kode_barang' => $pilihproduk->kode_barang,
                        'ukuran_ld'  => $this->ukuran_ld,
                        'ukuran_pb' => $this->ukuran_pb,
                        'ukuran_lp' => $this->ukuran_lp,
                        'ukuran_lph' => $this->ukuran_lph,
                        'ukuran_pc' => $this->ukuran_pc,
                    ];
                    DetailProdukPlanet::create($datadetail);
                }
            }
        } else {
            if (!is_null($this->ukuran_allsize)) {
                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_allsize,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 1,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);

                $dataresume = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'lokasi',
                    'jumlah_stok_online' => $this->ukuran_allsize,
                    'warna_id' => $warna,
                    'kode_merk' => $merk,
                    'ukuran_id' => 1,
                    'lokasi' => $this->lokasi
                ];
                ResumeStokOnline::create($dataresume);

                $datadetail = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'ukuran_ld'  => $this->ukuran_ld,
                    'ukuran_pb' => $this->ukuran_pb,
                    'ukuran_lp' => $this->ukuran_lp,
                    'ukuran_lph' => $this->ukuran_lph,
                    'ukuran_pc' => $this->ukuran_pc,
                ];
                DetailProdukPlanet::create($datadetail);
            }
            session()->flash('message', 'data berhasil ditambahkan');
        }
        $this->clearField();

        //$this->emit('refreshcart');
        $this->emit('rendercart');
        $this->dispatchBrowserEvent('closeTambahStokOnline');
    }
    public function render()
    {
        $listproduk = ProdukProduksi::where('kode_barang', 'like', '%' . $this->search . '%')
            ->orWhere('kode_model', 'like', '%' . $this->search . '%')
            ->orWhere('nomor_po', 'like', '%' . $this->search . '%')
            ->orWhere('merk', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')

            ->paginate(1);

        return view('livewire.stok-online.input-stok', ['listproduk' => $listproduk]);
    }
}
