<?php

namespace App\Http\Livewire\GudangOnline;

use App\Models\GudangOnline;
use App\Models\MstWarna;
use App\Models\ProdukInoutSj;
use App\Models\StokGudangPusat;
use App\Models\StokRevisi;
use App\Models\SuratJalan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailSjRetur extends Component
{

    public $datasj;
    public $dataproduk;
    //public $dataprodukrevisi;
    public $datarevisi;
    public $qty;
    public $kodebarang;
    public $idrevisi;
    public $statuskirim;
    public $listwarna;
    public $qty_tambah_sj;
    public $kode_barang_tambah_sj;


    public function mount($id)
    {
        $this->listwarna = MstWarna::all();

        $this->datasj = SuratJalan::where('nomor_surat_jalan', $id)->first();
        $this->statuskirim =  $this->datasj->status_kirim_sj;
        $this->dataproduk = ProdukInoutSj::where('no_sj', $this->datasj->nomor_surat_jalan)
            ->whereIn('status_kirim', [21, 3])
            ->get();
        //dd($this->statuskirim);
        /* $this->dataprodukrevisi = ProdukInoutSj::where('no_sj', $this->datasj->nomor_surat_jalan)
            ->where('status_kirim', 23)
            ->get(); */
    }

    public function tambahItemSj()
    {
        $datagudangpusat = [
            'kode_barang' => $this->kode_barang_tambah_sj,
            'no_po' => 0,
            'no_surat_jalan' => $this->datasj->nomor_surat_jalan,
            'qty' => $this->qty_tambah_sj,
            'warna_id' => 135,
            'ukuran_id' => 1,
            'status_inout' => 11,
            'keterangan_inout' => 'tambahan ke sj' . '' . $this->datasj->nomor_surat_jalan,
            'user_input' => Auth::id()
        ];
        StokGudangPusat::create($datagudangpusat);

        if (ProdukInoutSj::where('kode_barang', $this->kode_barang_tambah_sj)
            ->where('no_sj', $this->datasj->nomor_surat_jalan)
            ->where('status_kirim', 21)->exists()
        ) {
            $updatedata = ProdukInoutSj::where('kode_barang', $this->kode_barang_tambah_sj)
                ->where('no_sj', $this->datasj->nomor_surat_jalan)
                ->where('status_kirim', 21)->first();
            $updatedata->qty_produk = $updatedata->qty_produk + $this->qty_tambah_sj;
            $updatedata->save();
        } else {
            $dataproduksj = [
                'no_sj' => $this->datasj->nomor_surat_jalan,
                'kode_barang' => $this->kode_barang_tambah_sj,
                'qty_produk' => $this->qty_tambah_sj,
                'id_ukuran' => 1,
                'status_kirim' => 21,
                'status_barang' => 21,
                'id_warna' => 135
            ];
            ProdukInoutSj::create($dataproduksj);
        }



        $suratjalan = SuratJalan::where('nomor_surat_jalan', $this->datasj->nomor_surat_jalan)->first();
        $suratjalan->jumlah_produk = $suratjalan->jumlah_produk + $this->qty_tambah_sj;
        $suratjalan->save();
        return redirect(request()->header('Referer'));
        session()->flash('message', 'kode barang' . '' . $this->kode_barang_tambah_sj . '' . 'berhasil ditambahkan');
    }

    public function kirimSj()
    {
        $datakirim = ProdukInoutSj::where('no_sj', $this->datasj->nomor_surat_jalan)
            ->where('status_kirim', 21)
            ->get();

        foreach ($datakirim as $produk) {
            $kirimproduk = ProdukInoutSj::where('id', $produk['id'])->first();
            $kirimproduk->status_kirim = 3;
            $kirimproduk->save();
        }
        $sjkirim = SuratJalan::where('nomor_surat_jalan', $this->datasj->nomor_surat_jalan)->first();
        $sjkirim->status_kirim_sj = 3;
        $sjkirim->save();


        return redirect(request()->header('Referer'));
        session()->flash('message', 'Surat Jalan Berhasil Dikirim');
    }


    public function revisiSj($id)
    {
        $datarevisi = ProdukInoutSj::where('id', $id)->first();
        //dd($datarevisi->qty_produk);
        $this->kodebarang = $datarevisi->kode_barang;
        $this->qty = $datarevisi->qty_produk;
        $this->idrevisi = $datarevisi->id;
        $this->dispatchBrowserEvent('openrevisiSjRetur');
    }

    public function simpanRevisi()
    {

        $dataproduksj = ProdukInoutSj::where('id', $this->idrevisi)->first();

        $qtyrevisi = $dataproduksj->qty_produk - $this->qty;

        if ($qtyrevisi !== 0) {
            if ($dataproduksj->qty_produk < $this->qty) {
                session()->flash('message', 'revisi data tidak bisa ditambah');
            } else {
                $datasuratjalan = SuratJalan::where('nomor_surat_jalan', $dataproduksj->no_sj)->first();
                $datasuratjalan->jumlah_produk = $datasuratjalan->jumlah_produk - $qtyrevisi;
                // dd($datasuratjalan->jumlah_produk);
                $datasuratjalan->save();

                $datastokrevisi = [
                    'no_sj' => $dataproduksj->no_sj,
                    'kode_barang' => $dataproduksj->kode_barang,
                    'id_warna' => $dataproduksj->id_warna,
                    'id_ukuran' => $dataproduksj->id_ukuran,
                    'qty_revisi' => $qtyrevisi,
                    'status_kirim' => 21,
                    'status_barang' => 21,
                    'gudang_asal' => $datasuratjalan->gudang_asal,
                    'keterangan' => $datasuratjalan->keterangan_surat_jalan,
                    'user_input' => Auth::id(),
                ];
                StokRevisi::create($datastokrevisi);

                $dataproduksj->status_kirim = 23;
                $dataproduksj->save();

                $dataprodukbaru = [
                    'no_sj' => $dataproduksj->no_sj,
                    'kode_barang' => $dataproduksj->kode_barang,
                    'qty_produk' => $this->qty,
                    'id_ukuran' => $dataproduksj->id_ukuran,
                    'status_kirim' => 21,
                    'status_barang' => 21,
                    'id_warna' => $dataproduksj->id_warna,
                ];
                ProdukInoutSj::create($dataprodukbaru);

                return redirect(request()->header('Referer'));
            }
        }

        $this->dispatchBrowserEvent('closerevisiSjRetur');
    }

    public function render()
    {
        $resume = ProdukInoutSj::with('detailProduk.kategori')
            ->where('no_sj',  $this->datasj->nomor_surat_jalan)
            ->whereIn('status_kirim', [21, 3])
            ->groupBy('kode_barang')
            ->selectRaw('kode_barang, sum(qty_produk) as jumlah')
            ->get();
        //dd($resume);

        $dataprodukrevisi = ProdukInoutSj::with('warna', 'ukuran')
            ->where('no_sj', $this->datasj->nomor_surat_jalan)
            ->where('status_kirim', 30)
            ->get();
        //dd($dataprodukrevisi);
        return view('livewire.gudang-online.detail-sj-retur', ['resume' => $resume, 'dataprodukrevisi' => $dataprodukrevisi]);
    }
}
