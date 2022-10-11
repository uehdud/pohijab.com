<?php

namespace App\Http\Livewire\Gudang;

use App\Models\CartProduk;
use App\Models\ResumeStokGudangPusat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListStokPusat extends Component
{
    use WithPagination;
    public $search = null;
    public $qty;
    public $status_kirim = 1;



    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        $produkProduksi = DB::table('resume_stok_gudang_pusats')
            ->join('produk_produksis', 'resume_stok_gudang_pusats.kode_barang', '=', 'produk_produksis.kode_barang')
            ->join('mst_kategoris', 'produk_produksis.id_kategori', '=', 'mst_kategoris.id')
            ->select(
                'resume_stok_gudang_pusats.id',
                'resume_stok_gudang_pusats.total_stok',
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
            ->where('produk_produksis.kode_barang', 'like', '%' . $this->search . '%')
            ->orWhere('kode_model', 'like', '%' . $this->search . '%')
            ->orWhere('nomor_po', 'like', '%' . $this->search . '%')
            ->orWhere('nama_bahan', 'like', '%' . $this->search . '%')
            ->orWhere('merk', 'like', '%' . $this->search . '%')
            ->orderBy('produk_produksis.id', 'desc')
            ->paginate(1);

        return view('livewire.gudang.list-stok-pusat', ['datainout' => $produkProduksi]);
    }

    protected $rules = [
        'qty' => 'required'
    ];

    protected $messages = [
        'qty.required' => 'silahkan isi qty'
    ];

    public function clearField()
    {
        $this->qty = null;
        $this->search = null;
    }

    public function tambahCart($kode_barang)
    {
        $pilihproduk = ResumeStokGudangPusat::where('kode_barang', $kode_barang)->first();
        $validatedData = $this->validate();
        //dd($pilihproduk->kode_barang);

        if (CartProduk::where('kode_barang', $kode_barang)->where('status_kirim', 1)->exists()) {
            session()->flash('message', 'KB sudah ditambahkan');
        } else {
            $data = [
                'quantity' => $this->qty,
                'user_input_cart' => Auth::id(),
                'kode_barang' => $pilihproduk->kode_barang,
                'status_kirim' => $this->status_kirim
            ];
            CartProduk::create($data);
        }
        $this->clearField();
        $this->emit('refreshcart');
    }
}
