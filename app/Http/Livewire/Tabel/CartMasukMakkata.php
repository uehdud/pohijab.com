<?php

namespace App\Http\Livewire\Tabel;

use App\Models\CartProduk;
use Livewire\Component;

class CartMasukMakkata extends Component
{

    public $kb;
    public $warna;
    public $data;
    public $datakb;
    public $data_allsize;
    public $data_s;
    public $data_m;
    public $data_l;
    public $data_xl;
    public $data_xxl;
    public $jumlah;

    protected $listeners = [
        'refreshcart' => '$refresh',
        'rendercart' => 'render',
    ];

    public function mount($kb, $warna)
    {
        //dd($warna);
        $this->data_allsize = CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 1)
            ->select('quantity')
            ->first();
        $this->data_s = CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 2)
            ->select('quantity')
            ->first();
        $this->data_m = CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 3)
            ->select('quantity')
            ->first();
        $this->data_l = CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 4)
            ->select('quantity')
            ->first();
        $this->data_xl = CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 5)
            ->select('quantity')
            ->first();
        $this->data_xxl = CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 6)
            ->select('quantity')
            ->first();

        //$jumlah= CartProduk::

        $this->datakb = CartProduk::with('produk', 'produkkategori')
            ->where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->first();

        $jumlah = CartProduk::with('produk', 'produkkategori')
            ->where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->get();

        $this->jumlah = 0;
        foreach ($jumlah as $hasil) {
            $this->jumlah += $hasil['quantity'];
        }
        //dd($this->jumlah);

    }

    public function hapus()
    {
        CartProduk::where('kode_barang', $this->kb)
            ->where('id_warna', $this->warna)
            ->delete();

        return redirect(request()->header('Referer'));
    }

    public function render()
    {

        return view('livewire.tabel.cart-masuk-makkata');
    }
    public function buatNota()
    {
        $this->buat_nota = 1;
    }
    public function kembali()
    {
        $this->buat_nota = 0;
        // dd($this->buat_nota);
    }
}
