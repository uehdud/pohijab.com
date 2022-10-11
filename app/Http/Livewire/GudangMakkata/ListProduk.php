<?php

namespace App\Http\Livewire\GudangMakkata;

use App\Models\CartProduk;
use App\Models\ProdukProduksi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListProduk extends Component
{
    use WithPagination;
    public $search = null;
    public $qty;
    public $status_kirim = 1;
    public $warna;
    public $ukuran_s;
    public $ukuran_m;
    public $ukuran_l;
    public $ukuran_xl;
    public $ukuran_xxl;
    public $ukuran_allsize;

    public function render()
    {
        $listproduk = ProdukProduksi::where('kode_barang', 'like', '%' . $this->search . '%')
            ->orWhere('kode_model', 'like', '%' . $this->search . '%')
            ->orWhere('nomor_po', 'like', '%' . $this->search . '%')
            ->orWhere('merk', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(1);
        return view('livewire.gudang-makkata.list-produk', ['listproduk' => $listproduk]);
    }
    protected $rules = [
        'warna' => 'required'
    ];

    protected $messages = [
        'warna.required' => 'silahkan pilih warna'
    ];

    public function clearField()
    {
        $this->qty = null;
        // $this->search = null;
    }

    public function tambahCart($kode_barang)
    {
        //dd($this->warna);
        $warna = (int)$this->warna;
        $pilihproduk = ProdukProduksi::where('kode_barang', $kode_barang)->first();
        $kategori = $pilihproduk->id_kategori;
        $validatedData = $this->validate();
        $cek = CartProduk::where('kode_barang', $kode_barang)->where('id_warna', $warna)->where('status_kirim', 1)->get();

        //dd($pilihproduk->id_kategori);

        if (CartProduk::where('kode_barang', $kode_barang)->where('id_warna', $this->warna)->where('status_kirim', 1)->exists()) {
            session()->flash('message', 'warna di kb tersebut sudah ada');
        } else {
            if (!is_null($this->ukuran_allsize)) {
                $data = [
                    'quantity' => $this->ukuran_allsize,
                    'user_input_cart' => Auth::id(),
                    'kode_barang' => $pilihproduk->kode_barang,
                    'status_kirim' => $this->status_kirim,
                    'id_warna' => $warna,
                    'id_ukuran' => 1,
                    'kategori' => $kategori
                ];
                CartProduk::create($data);
            }
            if (!is_null($this->ukuran_s)) {
                $data = [
                    'quantity' => $this->ukuran_s,
                    'user_input_cart' => Auth::id(),
                    'kode_barang' => $pilihproduk->kode_barang,
                    'status_kirim' => $this->status_kirim,
                    'id_warna' => $warna,
                    'id_ukuran' => 2,
                    'kategori' => $kategori
                ];
                CartProduk::create($data);
            }
            if (!is_null($this->ukuran_m)) {
                $data = [
                    'quantity' => $this->ukuran_m,
                    'user_input_cart' => Auth::id(),
                    'kode_barang' => $pilihproduk->kode_barang,
                    'status_kirim' => $this->status_kirim,
                    'id_warna' => $warna,
                    'id_ukuran' => 3,
                    'kategori' => $kategori
                ];
                CartProduk::create($data);
            }
            if (!is_null($this->ukuran_l)) {
                $data = [
                    'quantity' => $this->ukuran_l,
                    'user_input_cart' => Auth::id(),
                    'kode_barang' => $pilihproduk->kode_barang,
                    'status_kirim' => $this->status_kirim,
                    'id_warna' => $warna,
                    'id_ukuran' => 4,
                    'kategori' => $kategori
                ];
                CartProduk::create($data);
            }
            if (!is_null($this->ukuran_xl)) {
                $data = [
                    'quantity' => $this->ukuran_xl,
                    'user_input_cart' => Auth::id(),
                    'kode_barang' => $pilihproduk->kode_barang,
                    'status_kirim' => $this->status_kirim,
                    'id_warna' => $warna,
                    'id_ukuran' => 5,
                    'kategori' => $kategori
                ];
                CartProduk::create($data);
            }
            if (!is_null($this->ukuran_xxl)) {
                $data = [
                    'quantity' => $this->ukuran_xxl,
                    'user_input_cart' => Auth::id(),
                    'kode_barang' => $pilihproduk->kode_barang,
                    'status_kirim' => $this->status_kirim,
                    'id_warna' => $warna,
                    'id_ukuran' => 6,
                    'kategori' => $kategori
                ];
                CartProduk::create($data);
            }
        }
        //$this->clearField();
        $this->emit('refreshcart');
        $this->emit('rendercart');
        return redirect(request()->header('Referer'));
    }
}
