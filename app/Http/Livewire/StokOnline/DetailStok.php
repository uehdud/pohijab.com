<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\ResumeStokOnline;
use Livewire\Component;

class DetailStok extends Component
{
    public $kode_barang;
    public $warna_id;
    public $itemallsize;
    public $items;
    public $itemm;
    public $iteml;
    public $itemxl;
    public $itemxxl;
    public $cekdatastok = 1;

    public function mount()
    {
        /* cek stok allsize */
        if (ResumeStokOnline::where('kode_barang', $this->kode_barang)
            ->where('warna_id', $this->warna_id)
            ->where('ukuran_id', 1)
            ->exists()
        ) {
            $this->itemallsize =  ResumeStokOnline::with('warna', 'ukuran')
                ->where('kode_barang', $this->kode_barang)
                ->where('warna_id', $this->warna_id)
                ->where('ukuran_id', 1)
                ->first()->jumlah_stok_online;
        } else {
            $this->itemallsize = 0;
        }

        if (ResumeStokOnline::with('warna', 'ukuran')
            ->where('kode_barang', $this->kode_barang)
            ->where('warna_id', $this->warna_id)
            ->where('ukuran_id', 2)
            ->exists()
        ) {
            $this->items =  ResumeStokOnline::with('warna', 'ukuran')
                ->where('kode_barang', $this->kode_barang)
                ->where('warna_id', $this->warna_id)
                ->where('ukuran_id', 2)
                ->first()->jumlah_stok_online;
        } else {
            $this->items = 0;
        }

        /* cek stok m*/
        if (ResumeStokOnline::with('warna', 'ukuran')
            ->where('kode_barang', $this->kode_barang)
            ->where('warna_id', $this->warna_id)
            ->where('ukuran_id', 3)
            ->exists()
        ) {
            $this->itemm =  ResumeStokOnline::with('warna', 'ukuran')
                ->where('kode_barang', $this->kode_barang)
                ->where('warna_id', $this->warna_id)
                ->where('ukuran_id', 3)
                ->first()->jumlah_stok_online;
        } else {
            $this->itemm = 0;
        }

        /* cek stok l */
        if (ResumeStokOnline::with('warna', 'ukuran')
            ->where('kode_barang', $this->kode_barang)
            ->where('warna_id', $this->warna_id)
            ->where('ukuran_id', 4)
            ->exists()
        ) {
            $this->iteml =  ResumeStokOnline::with('warna', 'ukuran')
                ->where('kode_barang', $this->kode_barang)
                ->where('warna_id', $this->warna_id)
                ->where('ukuran_id', 4)
                ->first()->jumlah_stok_online;
        } else {
            $this->iteml = 0;
        }

        /* cek stok xl */
        if (ResumeStokOnline::with('warna', 'ukuran')
            ->where('kode_barang', $this->kode_barang)
            ->where('warna_id', $this->warna_id)
            ->where('ukuran_id', 5)
            ->exists()
        ) {
            $this->itemxl =  ResumeStokOnline::with('warna', 'ukuran')
                ->where('kode_barang', $this->kode_barang)
                ->where('warna_id', $this->warna_id)
                ->where('ukuran_id', 5)
                ->first()->jumlah_stok_online;
        } else {
            $this->itemxl = 0;
        }

        /* cek stok xxl */
        if (ResumeStokOnline::with('warna', 'ukuran')
            ->where('kode_barang', $this->kode_barang)
            ->where('warna_id', $this->warna_id)
            ->where('ukuran_id', 6)
            ->exists()
        ) {
            $this->itemxxl =  ResumeStokOnline::with('warna', 'ukuran')
                ->where('kode_barang', $this->kode_barang)
                ->where('warna_id', $this->warna_id)
                ->where('ukuran_id', 6)
                ->first()->jumlah_stok_online;
        } else {
            $this->itemxxl = 0;
        }

        if ($this->itemallsize === 0 && $this->items === 0 && $this->itemm === 0  && $this->iteml === 0 && $this->itemxl === 0 && $this->itemxl === 0) {
            $this->cekdatastok = 0;
        }
    }

    public function render()
    {
        return view('livewire.stok-online.detail-stok');
    }
}
