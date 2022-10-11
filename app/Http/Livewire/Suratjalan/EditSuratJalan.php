<?php

namespace App\Http\Livewire\Suratjalan;

use App\Models\ProdukInoutSj;
use App\Models\ResumeStokGudangPusat;
use App\Models\StokGudangPusat;
use App\Models\SuratJalan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditSuratJalan extends Component
{
    public $detailsj;
    public $btn_revisi = 0;
    public $produkid;
    public $qty_revisi;
    public $nosj;
    public $datasurat;
    public $resume;
    public $produkcancel;
    public $jumlahtotal;
    public $status;


    public function revisi()
    {
        $this->btn_revisi = 1;
    }
    public function batal()
    {
        $this->btn_revisi = 0;
    }

    public function openrevisi()
    {

        //dd(1);

    }

    public function mount($no_sj)
    {
        //  dd($no_sj);
        $this->detailsj = ProdukInoutSj::where('no_sj', $no_sj)
            ->where('status_kirim', 3)
            //->where('status_barang', 21)
            ->get();

        $jumlahs = 0;
        foreach ($this->detailsj as $detail) {
            $jumlahs += $detail['qty_produk'];
        }

        $this->status = ProdukInoutSj::where('no_sj', $no_sj)
            ->where('status_kirim', 30)
            ->count('status_kirim', 30);
        //dd($this->status);

        $this->jumlahtotal = $jumlahs;


        $this->nosj = $no_sj;


        $this->resume = ProdukInoutSj::with('detailProduk.kategori')
            ->where('no_sj', $no_sj)
            ->whereIn('status_kirim', [21, 3])
            ->groupBy('kode_barang')
            ->selectRaw('kode_barang, sum(qty_produk) as jumlah')
            ->get();
        // dd($this->resume);
        $this->datasurat = SuratJalan::where('nomor_surat_jalan', $no_sj)->first();

        $this->produkcancel = ProdukInoutSj::with('detailProduk.kategori')
            ->where('no_sj', $no_sj)
            ->whereIn('status_kirim', [23])
            ->get();
    }

    public function tambahItem($itemId, $action)
    {
        //dd($itemId, $action);
        $this->produkid = $itemId;
        if ($action === 'revisi') {
            $this->dispatchBrowserEvent('openModalRevisi');
        } else if ($action === 'detailrevisi') {
            $this->emit('openModalRevisi', $this->produkid);
        } else {
            $batalrevisi = ProdukInoutSj::where('id_revisi', $this->produkid)
                ->where('status_barang', 21)
                ->first();
            $batalrevisi->status_kirim = 23;
            $batalrevisi->status_barang = 23;
            $batalrevisi->save();

            $batal = ProdukInoutSj::where('id', $this->produkid)->first();
            $batal->status_barang = 21;
            $batal->save();

            return redirect(request()->header('Referer'));
        }
    }

    public function revisiSuratJalanMasuk()
    {
        $datarevisi = ProdukInoutSj::where('id', $this->produkid)->first();
        $datarevisi->status_barang = 30;
        $datarevisi->save();
        $insertrevisi = [
            'no_sj' => $datarevisi->no_sj,
            'kode_barang' => $datarevisi->kode_barang,
            'qty_produk' => $this->qty_revisi,
            'id_ukuran' => $datarevisi->id_ukuran,
            'status_kirim' => 30,
            'status_barang' => 21,
            'id_warna' => $datarevisi->id_warna,
            'id_revisi' => $this->produkid,
            'user_input' => Auth::id()
        ];
        ProdukInoutSj::create($insertrevisi);
        // dd($insertrevisi);

        session()->flash('message', 'revisi berhasil diajukan');
        return redirect(request()->header('Referer'));
    }




    public function render()
    {
        return view('livewire.suratjalan.edit-surat-jalan');
    }
}
