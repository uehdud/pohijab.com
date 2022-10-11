<?php

namespace App\Http\Livewire\GudangOnline;

use App\Models\GudangOnline;
use App\Models\GudangStudio;
use App\Models\ProdukInoutSj;
use App\Models\ResumeGudangStudio;
use App\Models\ResumeStokOnline;
use App\Models\SuratJalan;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TerimaSuratJalan extends Component
{
    public $no_sj;
    public $detailsj;

    public function mount()
    {
        $this->detailsj = SuratJalan::with('gudangtujuan')
            ->where('nomor_surat_jalan', $this->no_sj)->first();
    }
    public function render()
    {
        $datasj = ProdukInoutSj::with('detailProduk', 'statusKirim')
            ->where('no_sj', $this->no_sj)->get();
        return view('livewire.gudang-online.terima-surat-jalan', ['datasj' => $datasj]);
    }

    public function terimaSuratJalan()
    {

        $produksj = ProdukInoutSj::where('no_sj', $this->no_sj)->get();
        foreach ($produksj as $produk) {
            $datagudangonline = [
                'no_surat_jalan' => $this->no_sj,
                'lokasi' => 0,
                'kode_barang' => $produk['kode_barang'],
                'quantity' => $produk['qty_produk'],
                'status_inout' => 10,
                'keterangan_inout' => 'barang masuk' . '' . $this->no_sj,
                'user_input_stok_online' => Auth::id(),
                'tanggal_inout' => Carbon::now()->toDateTimeString(),
                'warna_id' => $produk['id_warna'],
                'ukuran_id' => $produk['id_ukuran']
            ];
            GudangOnline::create($datagudangonline);

            if (ResumeStokOnline::where('kode_barang', $produk['kode_barang'])
                ->where('warna_id', $produk['id_warna'])
                ->where('ukuran_id', $produk['id_ukuran'])
                ->exists()
            ) {
                $updatestok = ResumeStokOnline::where('kode_barang', $produk['kode_barang'])
                    ->where('warna_id', $produk['id_warna'])
                    ->where('ukuran_id', $produk['id_ukuran'])->first();
                $updatestok->jumlah_stok_online = $updatestok->jumlah_stok_online + $produk['qty_produk'];
                $updatestok->save();
            } else {
                $dataresume = [
                    'kode_barang' => $produk['kode_barang'],
                    'lokasi' => 0,
                    'jumlah_stok_online' => $produk['qty_produk'],
                    'warna_id' => $produk['id_warna'],
                    'ukuran_id' => $produk['id_ukuran'],
                    'status_so' => 1
                ];
                ResumeStokOnline::create($dataresume);
            }

            $updateproduksj = ProdukInoutSj::where('id', $produk['id'])->first();
            $updateproduksj->status_kirim = 4;
            $updateproduksj->save();
        }

        $updatesj = SuratJalan::where('nomor_surat_jalan', $this->no_sj)->first();
        $updatesj->status_kirim_sj = 4;
        $updatesj->save();

        session()->flash('message', 'Surat berhasil diterima');
        return redirect(request()->header('Referer'));
    }

    public function terimaSuratJalanStudio()
    {

        $produksj = ProdukInoutSj::where('no_sj', $this->no_sj)->get();
        foreach ($produksj as $produk) {
            $datagudangonline = [
                'no_surat_jalan' => $this->no_sj,
                'lokasi' => 0,
                'kode_barang' => $produk['kode_barang'],
                'quantity' => $produk['qty_produk'],
                'status_inout' => 10,
                'keterangan_inout' => 'barang masuk' . '' . $this->no_sj,
                'user_input_stok_online' => Auth::id(),
                'tanggal_inout' => Carbon::now()->toDateTimeString(),
                'warna_id' => $produk['id_warna'],
                'ukuran_id' => $produk['id_ukuran']
            ];
            GudangStudio::create($datagudangonline);

            if (ResumeGudangStudio::where('kode_barang', $produk['kode_barang'])
                ->where('warna_id', $produk['id_warna'])
                ->where('ukuran_id', $produk['id_ukuran'])
                ->exists()
            ) {
                $updatestok = ResumeGudangStudio::where('kode_barang', $produk['kode_barang'])
                    ->where('warna_id', $produk['id_warna'])
                    ->where('ukuran_id', $produk['id_ukuran'])->first();
                $updatestok->jumlah_stok_foto = $updatestok->jumlah_stok_foto + $produk['qty_produk'];
                $updatestok->save();
            } else {
                $dataresume = [
                    'kode_barang' => $produk['kode_barang'],
                    'lokasi' => 0,
                    'jumlah_stok_foto' => $produk['qty_produk'],
                    'warna_id' => $produk['id_warna'],
                    'ukuran_id' => $produk['id_ukuran'],
                    'status_so' => 1
                ];
                ResumeGudangStudio::create($dataresume);
            }

            $updateproduksj = ProdukInoutSj::where('id', $produk['id'])->first();
            $updateproduksj->status_kirim = 4;
            $updateproduksj->save();
        }

        $updatesj = SuratJalan::where('nomor_surat_jalan', $this->no_sj)->first();
        $updatesj->status_kirim_sj = 4;
        $updatesj->save();

        session()->flash('message', 'Surat berhasil diterima Studio');
        return redirect(request()->header('Referer'));
    }
}
