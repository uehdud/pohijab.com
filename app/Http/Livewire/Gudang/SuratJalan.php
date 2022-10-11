<?php

namespace App\Http\Livewire\Gudang;

use App\Models\CartProduk;
use App\Models\MstGudang;
use App\Models\MstToko;
use App\Models\ProdukInoutSj;
use App\Models\ResumeStokGudangPusat;
use App\Models\ResumeStokPusat;
use App\Models\StokGudangPusat;
use App\Models\SuratJalan as ModelsSuratJalan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SuratJalan extends Component
{
    use WithPagination;
    public $search;
    public $mstgudang;
    public $gudang_tujuan;
    public $gudang_asal = 1;
    public $no_sj;
    public $tanggal_sj;
    public $keterangan_sj;
    public $status_inout = 11;
    public $status_kirim = 2;
    public $listsj;
    //public $cartproduk;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshcart' => 'render'
    ];

    protected $rules = [
        'gudang_tujuan' => 'required',
        'no_sj' => 'required',
        'tanggal_sj' => 'required',
    ];

    protected $messages = [
        'gudang_tujuan.required' => 'pilih gudang tujuan',
        'no_sj.required' => 'silahkan masukan no sj',
        'tanggal_sj.required' => 'pilih tanggal sj',
    ];

    public function render()
    {
        $this->listsj = ModelsSuratJalan::with('toko')
            ->orderBy('id', 'desc')
            ->get();
        $cartproduk = DB::table('cart_produks')
            ->join('produk_produksis', 'cart_produks.kode_barang', '=', 'produk_produksis.kode_barang')
            ->join('mst_kategoris', 'produk_produksis.id_kategori', '=', 'mst_kategoris.id')
            ->select(
                'cart_produks.id',
                'cart_produks.quantity',
                'produk_produksis.nomor_po',
                'produk_produksis.kode_barang',
                'kode_model',
                'kode_bahan',
                'nama_bahan',
                'harga_ta',
                'harga_planet',
                'qty_produksi',
                'keterangan_po',
                'merk',
                'kode_supp',
                'id_kategori',
                'kode_merk',
                'kode_harga_modal',
                'kode_kategori',
                'nama_kategori',
            )
            ->where('cart_produks.status_kirim', 1)
            ->orderBy('cart_produks.id', 'desc')
            ->get();

        return view('livewire.gudang.surat-jalan', ['cartproduk' => $cartproduk], ['listsj' => $this->listsj]);
    }

    public function mount()
    {

        //dd( $this->listsj);
        $this->mstgudang = MstToko::all();
    }

    public function hapus($id)
    {
        CartProduk::find($id)->delete();
    }

    public function clearField()
    {
        $this->gudang_asal = null;
        $this->no_sj = null;
        $this->tanggal_sj = null;
        $this->keterangan_sj = null;
    }

    public function simpan()
    {
        $status_kirim = 1;
        $validatedData = $this->validate();
        $datacart = CartProduk::where('user_input_cart', Auth::id())
            ->where('status_kirim', 1)
            ->get();

        $jumlah = 0;
        foreach ($datacart as $item) {
            $datajumlahstok = ResumeStokGudangPusat::where('kode_barang', $item['kode_barang'])
                ->first();
            $sisastok = $datajumlahstok->total_stok - $item['quantity'];
            $datajumlahstok->total_stok = $sisastok;
            $datajumlahstok->save();

            StokGudangPusat::create([
                'no_surat_jalan' => $this->no_sj,
                'kode_barang' => $item['kode_barang'],
                'qty' => $item['quantity'],
                'status_inout' => $this->status_inout,
                'keterangan_inout' => $this->keterangan_sj,
                'user_input' => Auth::id()
            ]);

            ProdukInoutSj::create([
                'no_sj' => $this->no_sj,
                'kode_barang' => $item['kode_barang'],
                'qty_produk' => $item['quantity'],
                'id_ukuran' => 1,
                'status_kirim' => 1
            ]);

            $jumlah += $item['quantity'];

            $ubahstatus = CartProduk::where('id', $item['id'])->first();
            $ubahstatus->status_kirim = $this->status_kirim;
            $ubahstatus->save();
        }
        ModelsSuratJalan::create([
            'nomor_surat_jalan' => $this->no_sj,
            'jumlah_produk' => $jumlah,
            'tanggal_surat_jalan' => $this->tanggal_sj,
            'gudang_asal' => $this->gudang_asal,
            'gudang_tujuan' => $this->gudang_tujuan,
            'status_inout' => $this->status_inout,
            'keterangan_inout' => $this->keterangan_sj,
            'user_input' => Auth::id()
        ]);
        $this->clearField();
        session()->flash('message', 'surat jalan berhasil ditambahkan');
        //dd($sisastok);
    }


    public function hapusSj($id)
    {
        ModelsSuratJalan::find($id)->delete();
        $this->render();
    }
}
