<?php

namespace App\Http\Livewire\Suratjalan;

use App\Imports\SuratJalanPusat;
use App\Models\CartProduk;
use App\Models\CartSuratJalan;
use App\Models\ProdukInoutSj;
use App\Models\StokGudangPusat;
use App\Models\SuratJalan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class SjPusat extends Component
{
    public $filesj;
    public $nosj;
    public $tanggal_surat_jalan;
    public $gudang_tujuan;
    public $keterangan_sj;
    public $jumlah;

    protected $listeners = [
        'refreshcart' => 'render'
    ];

    protected $rules = [
        'tanggal_surat_jalan' => 'required',
        'gudang_tujuan' => 'required',
    ];

    protected $messages = [
        'tanggal_surat_jalan.required' => 'silahkan pilih tanggal',
        'gudang_tujuan.required' => 'silahkan pilih tujuan'
    ];

    public function mount()
    {
        $ceksj = SuratJalan::latest()->first()->id;
        // dd($ceksj);
        $nosj =  'GSP-STOKOUT-000' . $ceksj + 1;
        $this->nosj = $nosj;
    }

    public function clearform()
    {
        $this->tanggal_surat_jalan = null;
        $this->gudang_tujuan = null;
        $this->keterangan_sj = null;
    }

    public function buatSJ()
    {
        $validatedData = $this->validate();
        $carts = CartSuratJalan::where('user_id', Auth::id())
            ->where('status_kirim', 3)
            ->get();
        $jumlahcart = 0;
        foreach ($carts as $cart) {
            $jumlahcart += $cart['quantity'];
        }

        foreach ($carts as $item) {
            $dataproduksj = [
                'no_sj' => $this->nosj,
                'kode_barang' => $item['kode_barang'],
                'qty_produk' => $item['quantity'],
                'id_ukuran' => 1,
                'status_kirim' => 21,
                'status_barang' => 21,
                'id_warna' => 135
            ];
            ProdukInoutSj::create($dataproduksj);

            $datagudangpusat = [
                'kode_barang' => $item['kode_barang'],
                'no_po' => 0,
                'no_surat_jalan' => $this->nosj,
                'qty' => $item['quantity'],
                'warna_id' => 135,
                'ukuran_id' => 1,
                'status_inout' => 11,
                'keterangan_inout' => $this->keterangan_sj,
                'user_input' => Auth::id()
            ];

            StokGudangPusat::create($datagudangpusat);

            $cartsj = CartSuratJalan::where('id', $item['id'])->first();
            $cartsj->status_kirim = 2;
            $cartsj->save();
        }

        $datasj = [
            'nomor_surat_jalan' => $this->nosj,
            'jumlah_produk' => $jumlahcart,
            'tanggal_surat_jalan' => $this->tanggal_surat_jalan,
            'gudang_asal' => 1,
            'gudang_tujuan' => $this->gudang_tujuan,
            'status_inout' => 11,
            'keterangan_surat_jalan' => $this->keterangan_sj,
            'status_kirim_sj' => 21,
            'user_input' => Auth::id(),
        ];
        //dd($datasj);
        SuratJalan::create($datasj);
        session()->flash('pesan', 'surat jalan berhasil ditambahkan');
        $this->clearform();
        $this->clea = '$refresh';
        return redirect(request()->header('Referer'));
    }

    public function batalCart()
    {
        $batalcarts = CartSuratJalan::where('user_id', Auth::id())
            ->where('status_kirim', 3)
            ->get();

        foreach ($batalcarts as $item) {
            $cartsjbatal = CartSuratJalan::where('id', $item['id'])->first();
            $cartsjbatal->status_kirim = 1;
            $cartsjbatal->save();
        }
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        $cartsuratjalan = CartSuratJalan::with('detail.kategori')
            ->where('user_id', Auth::id())
            ->where('status_kirim', 3)
            ->get();

        $countcart = CartSuratJalan::with('detail.kategori')
            ->where('user_id', Auth::id())
            ->where('status_kirim', 3)
            ->count();
        // dd($countcart);

        $total = 0;
        foreach ($cartsuratjalan as $sj) {
            $total += $sj['quantity'];
        }

        $this->jumlah = $total;
        return view('livewire.suratjalan.sj-pusat', ['carts' => $cartsuratjalan, 'jumlah' => $this->jumlah, 'countcart' => $countcart]);
    }

    public function delete($id)
    {
        // dd($id);
        $batal =  CartSuratJalan::where('id', $id)->first();
        $batal->status_kirim = 1;
        $batal->save();
        $this->render();
        $this->emit('refreshdata');
    }
}
