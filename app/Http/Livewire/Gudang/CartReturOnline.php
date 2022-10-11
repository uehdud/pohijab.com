<?php

namespace App\Http\Livewire\Gudang;

use App\Models\MstGudang;
use App\Models\ProdukInout;
use App\Models\SuratJalan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartReturOnline extends Component
{
    public $btnretur = 0;
    public $btnproses = 0;
    public $no_sj;
    public $mstgudang;
    public $jumlah;
    public $gudang_tujuan;
    public $tanggal_surat_jalan;
    public $keterangan_surat_jalan;
    public $gudang_asal = 3;
    public $status_inout = 11;



    protected $listeners = [
        'refreshCart' => 'render'
    ];

    protected $rules = [
        'gudang_tujuan' => 'required',
        'tanggal_surat_jalan' => 'required',
    ];
    protected $messages = [
        'gudang_tujuan.required' => 'silahkan pilih tujuan',
        'tanggal_surat_jalan.required' => 'tanggal tidak boleh kosong',
    ];

    public function mount()
    {
        $this->mstgudang = MstGudang::all()->sortDesc();
    }

    public function render()
    {
        $produk_inout = ProdukInout::where('user_input_cart', Auth::id())
            ->get();
        return view('livewire.gudang.cart-retur-online', ['produk_inout' => $produk_inout]);
    }

    public function retur()
    {
        $this->emit('tambahProduk');
        $config = ['table' => 'surat_jalans', 'field' => 'nomor_surat_jalan', 'length' => 12, 'prefix' => 'ONLINE-'];
        $nosj = IdGenerator::generate($config);
        $this->no_sj = $nosj;
        $this->btnretur = 1;
    }

    public function selesai()
    {
        $validatedData = $this->validate();
        $jumlahcart = ProdukInout::where('user_input_cart', Auth::id())
            ->select('quantity')
            ->get();
        $jmlh = 0;
        foreach ($jumlahcart as $produkcart) {
            $jmlh += $produkcart->quantity;
        }
        $this->jumlah = $jmlh;
        $this->btnproses = 1;

        //dd($jmlh);
    }

    public function deleteCart()
    {
        $cartdel = ProdukInout::where('user_input_cart', 'like', Auth::id())->delete();
    }

    public function proses()
    {
        $datasuratjalan = [
            'nomor_surat_jalan' => $this->no_sj,
            'jumlah_produk' => $this->jumlah,
            'tanggal_surat_jalan' => $this->tanggal_surat_jalan,
            'gudang_asal' => $this->gudang_asal,
            'gudang_tujuan' => $this->gudang_tujuan,
            'status_inout' => $this->status_inout,
            'keterangan_surat_jalan' => $this->keterangan_surat_jalan,

        ];
        //dd($datasuratjalan);
        $createSJ = SuratJalan::create($datasuratjalan);
        $this->deleteCart();
        session()->flash('message', 'Surat Jalan Retur Berhasil Ditambahkan');
        return redirect(request()->header('Referer'));
    }

    public function delete($id)
    {
        $this->btnproses = 0;
        $deletecart = ProdukInout::where('id', $id)->delete();
        $this->deleterefresh = '$refresh';
    }
}
