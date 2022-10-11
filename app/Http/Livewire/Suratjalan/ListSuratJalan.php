<?php

namespace App\Http\Livewire\Suratjalan;

use App\Models\ProdukInoutSj;
use App\Models\ResumeStokGudangPusat;
use App\Models\StokGudangPusat;
use App\Models\SuratJalan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListSuratJalan extends Component
{
    use WithPagination;

    public function cancelSuratJalan($itemId)
    {
        // dd($itemId);

        $ceksj = SuratJalan::where('id', $itemId)->first();
        /* update cancel status SJ */
        $ceksj->status_kirim_sj = 23;
        $ceksj->save();
        /*  cancel produk sj */
        ProdukInoutSj::where('no_sj', $ceksj->nomor_surat_jalan)
            ->update(['status_kirim' => 4, 'status_barang' => 23]);
        /*  insert stok pusat */
        /*  update resume stok pusat */
        $cekproduksjs = ProdukInoutSj::where('no_sj', $ceksj->nomor_surat_jalan)->get();

        foreach ($cekproduksjs as $cekproduksj) {

            $datastok = [
                'kode_barang' => $cekproduksj['kode_barang'],
                'no_surat_jalan' => $cekproduksj['no_sj'],
                'qty' => $cekproduksj['qty_produk'],
                'warna_id' => $cekproduksj['id_warna'],
                'ukuran_id' => $cekproduksj['id_ukuran'],
                'status_inout' => 10,
                'keterangan_inout' => 'retur dari SJ' . $cekproduksj['no_sj'],
                'user_input' => Auth::id()
            ];
            StokGudangPusat::create($datastok);

            /* update stok pusat, revisi dari sj */
            $cekstokpusat = ResumeStokGudangPusat::where('kode_barang', $cekproduksj['kode_barang'])
                ->where('warna_id', $cekproduksj['id_warna'])
                ->where('ukuran_id', $cekproduksj['id_ukuran'])
                ->first();
            $cekstokpusat->total_stok = $cekstokpusat->total_stok + $cekproduksj['qty_produk'];
            $cekstokpusat->save();
        }
        session()->flash('message', 'surat jalan berhasil dicancel ');
    }



    public function render()
    {
        $listsj = SuratJalan::with('toko', 'statusSJ')
            ->where('gudang_asal', 1)
            ->orderBy('id', 'desc')
            ->paginate(10);

        $listsjmasuk = SuratJalan::with('toko', 'statusSJ')
            ->where('gudang_tujuan', 1)
            ->where('status_kirim_sj', 3, 4)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('livewire.suratjalan.list-surat-jalan', ['listsj' => $listsj, 'listsjmasuk' => $listsjmasuk]);
    }
}
