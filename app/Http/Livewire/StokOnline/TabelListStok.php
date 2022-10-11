<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\ProdukProduksi;
use App\Models\ResumeStokOnline;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TabelListStok extends Component
{

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
    public $edit = 0;
    public $jenis_inout = 11;

    protected $listeners = [
        'refreshcart' => '$refresh',
        'rendercart' => 'render',
    ];

    public function mount($kb, $warna)
    {
        //dd($warna);
        $this->data_allsize = ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 1)
            ->select('jumlah_stok_online')
            ->first();
        //dd($this->data_allsize);

        $this->data_s = ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 2)
            ->select('jumlah_stok_online')
            ->first();


        $this->data_m = ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 3)
            ->select('jumlah_stok_online')
            ->first();


        $this->data_l = ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 4)
            ->select('jumlah_stok_online')
            ->first();


        $this->data_xl = ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 5)
            ->select('jumlah_stok_online')
            ->first();


        $this->data_xxl = ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 6)
            ->select('jumlah_stok_online')
            ->first();

        //$jumlah= ResumeStokOnline::

        $this->datakb = ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->first();

        $jumlah = ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->get();

        if (ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 1)
            ->select('jumlah_stok_online')
            ->exists()
        ) {
            $this->edit_allsize = $this->data_allsize->jumlah_stok_online;
        } else {
            $this->edit_allsize = 0;
        }


        if (ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 2)
            ->select('jumlah_stok_online')
            ->exists()
        ) {
            $this->edit_s = $this->data_s->jumlah_stok_online;
        } else {
            $this->edit_s = 0;
        }

        if (ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 3)
            ->select('jumlah_stok_online')
            ->exists()
        ) {
            $this->edit_m = $this->data_m->jumlah_stok_online;
        } else {
            $this->edit_m = 0;
        }


        if (ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 4)
            ->select('jumlah_stok_online')
            ->exists()
        ) {
            $this->edit_l = $this->data_l->jumlah_stok_online;
        } else {
            $this->edit_l = 0;
        }


        if (ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 5)
            ->select('jumlah_stok_online')
            ->exists()
        ) {
            $this->edit_xl = $this->data_xl->jumlah_stok_online;
        } else {
            $this->edit_xl = 0;
        }


        if (ResumeStokOnline::where('kode_barang', $kb)
            ->where('warna_id', $warna)
            ->where('ukuran_id', 6)
            ->select('jumlah_stok_online')
            ->exists()
        ) {
            $this->edit_xxl = $this->data_xxl->jumlah_stok_online;
        } else {
            $this->edit_xxl = 0;
        }


        $this->jumlah = 0;
        foreach ($jumlah as $hasil) {
            $this->jumlah += $hasil['jumlah_stok_online'];
        }
    }

    public function hapus()
    {
        ResumeStokOnline::where('kode_barang', $this->kb)
            ->where('warna_id', $this->warna)
            ->delete();

        return redirect(request()->header('Referer'));
    }

    public function simpanEdit()
    {
        $this->kode_barang = $this->kb;
        $cekproduk = ResumeStokOnline::where('kode_barang', $this->kode_barang)->first();


        //edit ukuran allsize
        if (ResumeStokOnline::where('kode_barang', $this->kb)
            ->where('warna_id', $this->warna)
            ->where('ukuran_id', 1)
            ->exists()
        ) {
            $new_allsize = ResumeStokOnline::where('kode_barang', $this->kb)
                ->where('warna_id', $this->warna)
                ->where('ukuran_id', 1)
                ->first();
            $allsize = (int)$this->edit_allsize;
            $new_allsize->jumlah_stok_online = $allsize;
            $new_allsize->save();
        } else {
            $data = [
                'jumlah_stok_online' => $this->edit_allsize,
                'kode_barang' => $this->kode_barang,
                'warna_id' => $this->warna,
                'ukuran_id' => 1,
                'lokasi' => $cekproduk->lokasi,
                'kode_merk' => $cekproduk->kode_merk
            ];
            ResumeStokOnline::create($data);
        }

        //edit ukuran s
        if (ResumeStokOnline::where('kode_barang', $this->kb)
            ->where('warna_id', $this->warna)
            ->where('ukuran_id', 2)
            ->exists()
        ) {
            $new_s = ResumeStokOnline::where('kode_barang', $this->kb)
                ->where('warna_id', $this->warna)
                ->where('ukuran_id', 2)
                ->first();
            $size_s = (int)$this->edit_s;
            $new_s->jumlah_stok_online = $size_s;
            $new_s->save();
        } else {
            $size_s = (int)$this->edit_s;
            $data = [
                'jumlah_stok_online' => $this->edit_s,
                'kode_barang' => $this->kode_barang,
                'warna_id' => $this->warna,
                'ukuran_id' => 2,
                'lokasi' => $cekproduk->lokasi,
                'kode_merk' => $cekproduk->kode_merk
            ];
            ResumeStokOnline::create($data);
        }

        //edit ukuran m
        if (ResumeStokOnline::where('kode_barang', $this->kb)
            ->where('warna_id', $this->warna)
            ->where('ukuran_id', 3)
            ->exists()
        ) {
            $new_m = ResumeStokOnline::where('kode_barang', $this->kb)
                ->where('warna_id', $this->warna)
                ->where('ukuran_id', 3)
                ->first();
            $size_m = (int)$this->edit_m;
            $new_m->jumlah_stok_online = $size_m;
            $new_m->save();
        } else {
            $size_m = (int)$this->edit_m;
            $data = [
                'jumlah_stok_online' => $this->edit_m,
                'kode_barang' => $this->kode_barang,
                'warna_id' => $this->warna,
                'ukuran_id' => 3,
                'lokasi' => $cekproduk->lokasi,
                'kode_merk' => $cekproduk->kode_merk
            ];
            ResumeStokOnline::create($data);
        }

        //edit ukuran l
        if (ResumeStokOnline::where('kode_barang', $this->kb)
            ->where('warna_id', $this->warna)
            ->where('ukuran_id', 4)
            ->exists()
        ) {
            $new_l = ResumeStokOnline::where('kode_barang', $this->kb)
                ->where('warna_id', $this->warna)
                ->where('ukuran_id', 4)
                ->first();
            $size_l = (int)$this->edit_l;
            $new_l->jumlah_stok_online = $size_l;
            $new_l->save();
        } else {
            $size_l = (int)$this->edit_l;
            $data = [
                'jumlah_stok_online' => $this->edit_l,
                'kode_barang' => $this->kode_barang,
                'warna_id' => $this->warna,
                'ukuran_id' => 4,
                'lokasi' => $cekproduk->lokasi,
                'kode_merk' => $cekproduk->kode_merk
            ];
            ResumeStokOnline::create($data);
        }

        //edit ukuran xl
        if (ResumeStokOnline::where('kode_barang', $this->kb)
            ->where('warna_id', $this->warna)
            ->where('ukuran_id', 5)
            ->exists()
        ) {
            $new_xl = ResumeStokOnline::where('kode_barang', $this->kb)
                ->where('warna_id', $this->warna)
                ->where('ukuran_id', 5)
                ->first();
            $size_xl = (int)$this->edit_xl;
            $new_xl->jumlah_stok_online = $size_xl;
            $new_xl->save();
        } else {
            $size_xl = (int)$this->edit_xl;
            $data = [
                'jumlah_stok_online' => $this->edit_xl,
                'kode_barang' => $this->kode_barang,
                'warna_id' => $this->warna,
                'ukuran_id' => 5,
                'lokasi' => $cekproduk->lokasi,
                'kode_merk' => $cekproduk->kode_merk
            ];
            ResumeStokOnline::create($data);
        }

        //edit ukuran xxl
        if (ResumeStokOnline::where('kode_barang', $this->kb)
            ->where('warna_id', $this->warna)
            ->where('ukuran_id', 6)
            ->exists()
        ) {
            $new_xxl = ResumeStokOnline::where('kode_barang', $this->kb)
                ->where('warna_id', $this->warna)
                ->where('ukuran_id', 6)
                ->first();
            $size_xxl = (int)$this->edit_xxl;
            $new_xxl->jumlah_stok_online = $size_xxl;
            $new_xxl->save();
        } else {
            $size_xxl = (int)$this->edit_xxl;
            $data = [
                'jumlah_stok_online' => $this->edit_xxl,
                'kode_barang' => $this->kode_barang,
                'warna_id' => $this->warna,
                'ukuran_id' => 6,
                'lokasi' => $cekproduk->lokasi,
                'kode_merk' => $cekproduk->kode_merk
            ];
            ResumeStokOnline::create($data);
        }

        //dd($this->edit_s);


        $this->edit = 0;
        $this->emit('rendercart');
        // return redirect(request()->header('Referer'));
    }



    public function editStokCart()
    {
        $this->edit = 1;
    }

    public function render()
    {
        return view('livewire.stok-online.tabel-list-stok');
    }
}
