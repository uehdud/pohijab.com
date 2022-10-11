<?php

namespace App\Http\Livewire\Gudang;

use App\Models\Cart;
use App\Models\GudangStudio;
use App\Models\ProdukInoutSj;
use App\Models\ResumeGudangStudio;
use App\Models\SuratJalan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListStokStudio extends Component
{
    use WithPagination;
    public $lokasi = null;
    public $lokasistok;
    public $search;
    public $jumlahstokstudio;
    public $cartproduk;
    public $jumlahcart;
    public $editfield = 0;
    public $selesai = 0;
    public $tanggal_sj;
    public $keterangan_sj;
    public $editedProductIndex = null;
    public $editedProductField = null;
    public $products = [];
    public $no_suratjalan;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $listeners = [
        'renderCart' => '$refresh'
    ];

    protected $rules = [
        'products.*.qty_cart' => ['required'],
        'tanggal_sj' => 'required',
        'keterangan_sj' => 'required',
    ];

    protected $messages = [
        'tanggal_sj.required' => 'silahkan pilih tanggal',
        'keterangan_sj.required' => 'silahkan masukan keterangan',
    ];

    public function refreshdata()
    {
        $this->render();
        $this->mount();
    }

    public function mount()
    {

        $this->products = Cart::with('produk.warna', 'produk.ukuran')
            ->where('user_input', Auth::id())
            ->where('jenis_inout', 11)
            ->where('status_kirim', 21)
            ->get();
       // dd($this->products);

        $jumlah = 0;
        foreach ($this->products as $carts) {
            $jumlah += $carts['qty_cart'];
        }
        $this->jumlahcart = $jumlah;

        $this->jumlahstokstudio = 0;
        $stokstudio = ResumeGudangStudio::all();
        foreach ($stokstudio as $studio) {
            $this->jumlahstokstudio += $studio['jumlah_stok_foto'];
        }
    }

    public function selesaiCart()
    {
        $this->selesai = 1;
        //dd($this->selesai);

        $ceksj = SuratJalan::latest()->first()->id;
        // dd($ceksj);
        $nosj =  'Online-00000' . $ceksj + 1;
        $this->no_suratjalan = $nosj;
    }

    public function render()
    {

        $listsjretur = SuratJalan::where('gudang_asal', 11)
            ->where('status_inout', 11)
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        //dd($this->products);
        /* $cart = CartProduk::with('warna', 'ukuran')
            ->where('user_input_cart', Auth::id())
            ->where('jenis_inout', 11)
            ->where('status_kirim', 21)
            ->get();
        //dd($cart);
        $this->cartproduk = $cart; */



        if ($this->lokasi === null) {
            $datagudang = ResumeGudangStudio::with('warna', 'ukuran')
                ->where('jumlah_stok_foto', '>', 0)
                ->orderBy('lokasi', 'asc')
                /*  whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])*/
                ->where('kode_barang', 'like', '%' . $this->search . '%')
                ->paginate(20);
            $jumlahgudang = ResumeGudangStudio::all()
                /* whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])
                ->get() */;
            $jumlahstok = 0;
            foreach ($jumlahgudang as $jumlah) {
                $jumlahstok += $jumlah['jumlah_stok_foto'];
            }
        } else {
            $datagudang = ResumeGudangStudio::with('warna', 'ukuran')
                ->where('jumlah_stok_foto', '>', 0)
                /* whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])*/
                ->where('kode_barang', 'like', '%' . $this->search . '%')
                ->where('lokasi', $this->lokasi)
                ->get();

            $jumlahgudang = ResumeGudangStudio::
                /* whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])
                -> */where('lokasi', $this->lokasi)
                ->get();
            $jumlahstok = 0;
            foreach ($jumlahgudang as $jumlah) {
                $jumlahstok += $jumlah['jumlah_stok_foto'];
            }
        }
        return view('livewire.gudang.list-stok-studio', ['listsjretur' => $listsjretur, 'datagudang' => $datagudang, 'jumlahstok' => $jumlahstok, 'products' => $this->products]);
    }

    public function editProduct($productIndex)
    {
        $this->editedProductIndex = $productIndex;
    }

    public function editProductField($productIndex, $fieldName)
    {
        $this->editedProductField = $productIndex . '.' . $fieldName;
    }

    public function saveProduct($productIndex)
    {
        $this->validate();
        $product = $this->products[$productIndex] ?? NULL;

        if (!is_null($product)) {
            optional(Cart::find($product['id']))->update($product->toArray());
        }
        $this->editedProductIndex = null;
        $this->editedProductField = null;
        $this->render();
        $this->mount();
    }


    public function hapusCart($id)
    {
        Cart::find($id)->delete();
        $this->render();
        $this->mount();
    }
    public function addCart($id)
    {
        $cartsj = ResumeGudangStudio::where('id', $id)->first();
        //dd($cartsj);
        $produkcart = Cart::where('produk_id', $cartsj->id)
            ->where('jenis_inout', 11)
            ->where('status_kirim', 21)
            ->where('user_input', Auth::id())
            ->first();

        if (Cart::where('produk_id', $cartsj->id)
            ->where('jenis_inout', 11)
            ->where('status_kirim', 21)
            ->where('user_input', Auth::id())
            ->exists()
        ) {
            if ($produkcart->qty_cart >= $cartsj->jumlah_stok_online) {
                session()->flash('pesan', 'stok kurang');
            } else {
                $produkcart->qty_cart = $produkcart->qty_cart + $cartsj->jumlah_stok_online;
                $produkcart->save();
            }
        } else {
            $datacart = [
                'produk_id' => $cartsj->id,
                'qty_cart' => $cartsj->jumlah_stok_foto,
                'jenis_inout' => 11,
                'status_kirim' => 21,
                'user_input' => Auth::id()
            ];
            //dd($datacart);
            Cart::create($datacart);
        }

        $this->render();
        $this->mount();
    }

    public function editCart()
    {
        $this->editfield = 1;
    }

    public function simpanSJ()
    {
        $validatedData = $this->validate();
        $jumlah = 0;
        $cekjumlah = Cart::with('produk.warna', 'produk.ukuran')
            ->where('user_input', Auth::id())
            ->where('jenis_inout', 11)
            ->where('status_kirim', 21)
            ->get();

        foreach ($cekjumlah as $cek) {
            $jumlah += $cek['qty_cart'];
        }

        foreach ($cekjumlah as $produks) {

            $dataproduksj = [
                'no_sj' => $this->no_suratjalan,
                'kode_barang' => $produks->produk['kode_barang'],
                'qty_produk' => $produks['qty_cart'],
                'id_ukuran' => $produks->produk['ukuran_id'],
                'status_kirim' => 21,
                'status_barang' => 21,
                'id_warna' => $produks->produk['warna_id']
            ];
            //dd($produks);
            ProdukInoutSj::create($dataproduksj);

            $datastok = [
                'no_surat_jalan' => $this->no_suratjalan,
                'lokasi' => 'retur',
                'kode_barang' => $produks->produk['kode_barang'],
                'qty_cart' => $produks['qty_cart'],
                'status_inout' => 11,
                'keterangan_inout' => $this->keterangan_sj,
                'user_input_stok_online' => Auth::id(),
                'tanggal_inout' => $this->tanggal_sj,
                'warna_id' => $produks->produk['warna_id'],
                'ukuran_id' => $produks->produk['ukuran_id'],
                'kode_merk' => $produks->produk['kode_merk'] ?? null
            ];
            GudangStudio::create($datastok);

            $updatestok = ResumeGudangStudio::where('id', $produks['produk_id'])->first();
            $updatestok->jumlah_stok_foto = $updatestok->jumlah_stok_foto - $produks['qty_cart'];
            $updatestok->save();

            $status = Cart::where('id', $produks['id'])->first();
            //dd($status);
            $status->status_kirim = 3;
            $status->save();
        }

        $datasj = [
            'nomor_surat_jalan' => $this->no_suratjalan,
            'jumlah_produk' => $jumlah,
            'tanggal_surat_jalan' => $this->tanggal_sj,
            'gudang_asal' => 11,
            'gudang_tujuan' => 1,
            'status_inout' => 11,
            'keterangan_surat_jalan' => $this->keterangan_sj,
            'status_kirim_sj' => 21,
            'user_input' => Auth::id(),
        ];
        SuratJalan::create($datasj);
        session()->flash('message', 'Surat berhasil dibuat');
        return redirect(request()->header('Referer'));
    }
}
