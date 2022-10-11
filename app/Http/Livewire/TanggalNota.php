<?php

namespace App\Http\Livewire;

use App\Models\CartProduk;
use App\Models\ProdukInoutSj;
use App\Models\SuratJalan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TanggalNota extends Component
{
    public $buat_nota = 0;
    public $no_nota;
    public $tanggal_nota;
    public $status_inout = 11;
    public  $status_kirim = 1;
    public $gudangasal = 20;
    public $gudangtujuan = 20;
    public $keterangan_nota = 20;

    public function render()
    {
        return view('livewire.tanggal-nota');
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


    public function simpanNota()
    {
        $this->no_nota = IdGenerator::generate(['table' => 'surat_jalans', 'length' => 6, 'prefix' => 000]);
        $datacart = CartProduk::where('user_input_cart', Auth::id())
            ->where('status_kirim', 1)
            ->get();
        $jumlah = 0;
        foreach ($datacart as $item) {
            ProdukInoutSj::create([
                'no_sj' => $this->no_nota,
                'kode_barang' => $item['kode_barang'],
                'qty_produk' => $item['quantity'],
                'id_warna' => $item['id_warna'],
                'id_ukuran' => $item['id_ukuran'],
                'status_kirim' => 1
            ]);
            $jumlah += $item['quantity'];
        }
        SuratJalan::create([
            'nomor_surat_jalan' => $this->no_nota,
            'jumlah_produk' => $jumlah,
            'tanggal_surat_jalan' => $this->tanggal_nota,
            'gudang_asal' => $this->gudangasal,
            'gudang_tujuan' => $this->gudangtujuan,
            'status_inout' => $this->status_inout,
            'keterangan_inout' => $this->keterangan_nota,
            'user_input' => Auth::id()
        ]);
    }
}
