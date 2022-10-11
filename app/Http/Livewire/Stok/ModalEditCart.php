<?php

namespace App\Http\Livewire\Stok;

use App\Models\CartProduk;
use App\Models\ProdukProduksi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ModalEditCart extends Component
{
    public $status_kirim = 1;
    public $kb;
    public $kode_barang;
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
    public $edit_allsize = 0;
    public $edit_s = 0;
    public $edit_m = 0;
    public $edit_l = 0;
    public $edit_xl = 0;
    public $edit_xxl = 0;

    public function mount($kb = null, $warna)
    {
        //dd($kb);
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
        //dd($kb, $warna);
        if (CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 1)
            ->select('quantity')
            ->exists()
        ) {
            $this->edit_allsize = $this->data_allsize->quantity;
        } else {
            $this->edit_allsize = 0;
        }


        if (CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 2)
            ->select('quantity')
            ->exists()
        ) {
            $this->edit_s = $this->data_s->quantity;
        } else {
            $this->edit_s = 0;
        }

        if (CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 3)
            ->select('quantity')
            ->exists()
        ) {
            $this->edit_m = $this->data_m->quantity;
        } else {
            $this->edit_m = 0;
        }


        if (CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 4)
            ->select('quantity')
            ->exists()
        ) {
            $this->edit_l = $this->data_l->quantity;
        } else {
            $this->edit_l = 0;
        }


        if (CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 5)
            ->select('quantity')
            ->exists()
        ) {
            $this->edit_xl = $this->data_xl->quantity;
        } else {
            $this->edit_xl = 0;
        }


        if (CartProduk::where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->where('id_ukuran', 6)
            ->select('quantity')
            ->exists()
        ) {
            $this->edit_xxl = $this->data_xxl->quantity;
        } else {
            $this->edit_xxl = 0;
        }

        $this->datakb = CartProduk::with('produk', 'produkkategori')
            ->where('kode_barang', $kb)
            ->where('id_warna', $warna)
            ->first();
    }

    public function simpanEdit()
    {
        $this->kode_barang = $this->kb;

        $pilihproduk = ProdukProduksi::where('kode_barang', $this->kode_barang)->first();
        $kategori = $pilihproduk->id_kategori;

        //edit ukuran allsize
        if (CartProduk::where('kode_barang', $this->kb)
            ->where('id_warna', $this->warna)
            ->where('id_ukuran', 1)
            ->exists()
        ) {

            $new_allsize = CartProduk::where('kode_barang', $this->kb)
                ->where('id_warna', $this->warna)
                ->where('id_ukuran', 1)
                ->first();
            $allsize = (int)$this->edit_allsize;
            $new_allsize->quantity = $allsize;
            $new_allsize->save();
        } else {

            $data = [
                'quantity' => $this->edit_allsize,
                'user_input_cart' => Auth::id(),
                'kode_barang' => $this->kode_barang,
                'status_kirim' => $this->status_kirim,
                'id_warna' => $this->warna,
                'id_ukuran' => 1,
                'kategori' => $kategori
            ];
            CartProduk::create($data);
        }



        //edit ukuran s
        if (CartProduk::where('kode_barang', $this->kb)
            ->where('id_warna', $this->warna)
            ->where('id_ukuran', 2)
            ->exists()
        ) {
            $new_s = CartProduk::where('kode_barang', $this->kb)
                ->where('id_warna', $this->warna)
                ->where('id_ukuran', 2)
                ->first();
            $size_s = (int)$this->edit_s;
            $new_s->quantity = $size_s;
            $new_s->save();
        } else {
            $size_s = (int)$this->edit_s;
            $data = [
                'quantity' => $size_s,
                'user_input_cart' => Auth::id(),
                'kode_barang' => $this->kode_barang,
                'status_kirim' => $this->status_kirim,
                'id_warna' => $this->warna,
                'id_ukuran' => 2,
                'kategori' => $kategori
            ];
            CartProduk::create($data);
        }

        //edit ukuran m
        if (CartProduk::where('kode_barang', $this->kb)
            ->where('id_warna', $this->warna)
            ->where('id_ukuran', 3)
            ->exists()
        ) {
            $new_m = CartProduk::where('kode_barang', $this->kb)
                ->where('id_warna', $this->warna)
                ->where('id_ukuran', 3)
                ->first();
            $size_m = (int)$this->edit_m;
            $new_m->quantity = $size_m;
            $new_m->save();
        } else {
            $size_m = (int)$this->edit_m;
            $data = [
                'quantity' => $size_m,
                'user_input_cart' => Auth::id(),
                'kode_barang' => $this->kode_barang,
                'status_kirim' => $this->status_kirim,
                'id_warna' => $this->warna,
                'id_ukuran' => 3,
                'kategori' => $kategori
            ];
            CartProduk::create($data);
        }

        //edit ukuran l
        if (CartProduk::where('kode_barang', $this->kb)
            ->where('id_warna', $this->warna)
            ->where('id_ukuran', 4)
            ->exists()
        ) {
            $new_l = CartProduk::where('kode_barang', $this->kb)
                ->where('id_warna', $this->warna)
                ->where('id_ukuran', 4)
                ->first();
            $size_l = (int)$this->edit_l;
            $new_l->quantity = $size_l;
            $new_l->save();
        } else {
            $size_l = (int)$this->edit_l;
            $data = [
                'quantity' =>  $size_l,
                'user_input_cart' => Auth::id(),
                'kode_barang' => $this->kode_barang,
                'status_kirim' => $this->status_kirim,
                'id_warna' => $this->warna,
                'id_ukuran' => 4,
                'kategori' => $kategori
            ];
            CartProduk::create($data);
        }

        //edit ukuran xl
        if (CartProduk::where('kode_barang', $this->kb)
            ->where('id_warna', $this->warna)
            ->where('id_ukuran', 5)
            ->exists()
        ) {
            $new_xl = CartProduk::where('kode_barang', $this->kb)
                ->where('id_warna', $this->warna)
                ->where('id_ukuran', 5)
                ->first();
            $size_xl = (int)$this->edit_xl;
            $new_xl->quantity = $size_xl;
            $new_xl->save();
        } else {
            $size_xl = (int)$this->edit_xl;
            $data = [
                'quantity' => $size_xl,
                'user_input_cart' => Auth::id(),
                'kode_barang' => $this->kode_barang,
                'status_kirim' => $this->status_kirim,
                'id_warna' => $this->warna,
                'id_ukuran' => 5,
                'kategori' => $kategori
            ];
            CartProduk::create($data);
        }

        //edit ukuran xxl
        if (CartProduk::where('kode_barang', $this->kb)
            ->where('id_warna', $this->warna)
            ->where('id_ukuran', 6)
            ->exists()
        ) {
            $new_xxl = CartProduk::where('kode_barang', $this->kb)
                ->where('id_warna', $this->warna)
                ->where('id_ukuran', 6)
                ->first();
            $size_xxl = (int)$this->edit_xxl;
            $new_xxl->quantity = $size_xxl;
            $new_xxl->save();
        } else {
            $size_xxl = (int)$this->edit_xxl;
            $data = [
                'quantity' =>  $size_xxl,
                'user_input_cart' => Auth::id(),
                'kode_barang' => $this->kode_barang,
                'status_kirim' => $this->status_kirim,
                'id_warna' => $this->warna,
                'id_ukuran' => 6,
                'kategori' => $kategori
            ];
            CartProduk::create($data);
        }

        //dd($this->edit_s);


        $this->dispatchBrowserEvent('closeEditCart');
        // $this->refre = '$refresh';
        //dd($allsize);
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.stok.modal-edit-cart');
    }

    public function test()
    {
        dd($this->kb);
    }
}
