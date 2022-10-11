<?php

namespace App\Http\Livewire\StokOut;

use App\Http\Livewire\Gudang\SuratJalan;
use App\Http\Livewire\Stok\CartInOut;
use App\Models\CartProduk;
use App\Models\MstToko;
use App\Models\ProdukInoutSj;
use App\Models\ProdukProduksi;
use App\Models\ResumeGudangMakkata;
use App\Models\ResumeStokGudangPusat;
use App\Models\ResumeStokPusat;
use App\Models\StokGudangPusat;
use App\Models\SuratJalan as ModelsSuratJalan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class BuatSuratJalan extends Component
{
    public $cekstok;
    public $search;
    public $cari = null;
    public $produk = null;
    public $status_kirim = 1;
    public $warna;
    public $listwarna;
    public $ukuran_s;
    public $ukuran_m;
    public $ukuran_l;
    public $ukuran_xl;
    public $ukuran_xxl;
    public $ukuran_allsize;
    public $pilih_warna;
    public $cartproduk;
    public $jenis_inout = 11;
    public $itemId;
    public $kb;
    public $nama_warna;
    public $gudang_tujuan;
    public $tanggal_stok;
    public $keterangan_stok;
    public $listgudang;
    public $lproduk;

    public function mount()
    {
        if (empty(ResumeStokGudangPusat::count())) {
            $this->lproduk = 'Stok Belum Tersedia';
        }

        //dd($this->listproduk);
        $this->listgudang = MstToko::all();
    }


    public function tambahItem($itemId, $action)
    {
        //dd($itemId, $action);
        $datamodal = ResumeStokGudangPusat::with('warna')
            ->where('id', $itemId)
            ->first();
        // dd($datamodal);
        $this->kb = $datamodal->kode_barang;
        $this->nama_warna = $datamodal->warna->nama_warna;
        $this->itemId = $itemId;
        $this->dispatchBrowserEvent('openModalCartOut');
    }

    protected $rules = [
        'tanggal_stok' => 'required',
        'gudang_tujuan' => 'required',
    ];

    protected $messages = [
        'tanggal_stok.required' => 'silahkan pilih tanggal',
        'gudang_tujuan.required' => 'silahkan pilih tujuan'
    ];

    public function clearfield()
    {
        $this->ukuran_s = null;
        $this->ukuran_m = null;
        $this->ukuran_l = null;
        $this->ukuran_xl = null;
        $this->ukuran_xxl = null;
        $this->ukuran_allsize = null;
    }

    public function simpanSuratJalan()
    {
        $validatedData = $this->validate();
        $datacart = CartProduk::where('user_input_cart', Auth::id())
            ->where('status_kirim', 1)
            ->where('jenis_inout', 11)
            ->get();

        $config = ['table' => 'surat_jalans', 'field' => 'nomor_surat_jalan', 'length' => 12, 'prefix' => 'STOKOUT-'];
        $nosj = IdGenerator::generate($config);

        $jumlahcart = 0;
        foreach ($datacart as $item) {
            $jumlahcart += $item['quantity'];

            $ceknopo = ProdukProduksi::where('kode_barang', $item['kode_barang'])
                ->orderBy('created_at', 'desc')
                ->first();
            //dd($ceknopo->nomor_po);

            $dataproduksj = [
                'no_sj' => $nosj,
                'kode_barang' => $item['kode_barang'],
                'qty_produk' => $item['quantity'],
                'id_ukuran' => $item['id_ukuran'],
                'status_kirim' => 3,
                'status_barang' => 21,
                'id_warna' => $item['id_warna']
            ];

            ProdukInoutSj::create($dataproduksj);


            $datastok = [
                'kode_barang' => $item['kode_barang'],
                'no_po' => $ceknopo->nomor_po,
                'no_surat_jalan' => $nosj,
                'qty' => $item['quantity'],
                'warna_id' => $item['id_warna'],
                'ukuran_id' => $item['id_ukuran'],
                'status_inout' => 11,
                'keterangan_inout' => $this->keterangan_stok,
                'user_input' => Auth::id()
            ];
            StokGudangPusat::create($datastok);


            if (ResumeStokGudangPusat::where('kode_barang', $item['kode_barang'])
                ->where('warna_id', $item['id_warna'])
                ->where('ukuran_id', $item['id_ukuran'])
                ->exists()
            ) {
                $dataresumestok = ResumeStokGudangPusat::where('kode_barang', $item['kode_barang'])
                    ->where('warna_id', $item['id_warna'])
                    ->where('ukuran_id', $item['id_ukuran'])
                    ->first();
                $dataresumestok->total_stok = $dataresumestok->total_stok - $item['quantity'];
                $dataresumestok->save();
            }


            $ubahstatus = CartProduk::where('id', $item['id'])->first();
            $ubahstatus->status_kirim = 2;
            $ubahstatus->save();
        }
        //dd($jumlahcart);


        $dataresume = [
            'nomor_surat_jalan' => $nosj,
            'jumlah_produk' => $jumlahcart,
            'tanggal_surat_jalan' => $this->tanggal_stok,
            'gudang_asal' => 1,
            'gudang_tujuan' => $this->gudang_tujuan,
            'status_inout' => 11,
            'keterangan_surat_jalan' => $this->keterangan_stok,
            'status_kirim_sj' => 3,
            'user_input' => Auth::id(),
        ];
        ModelsSuratJalan::create($dataresume);
        //dd($nosj);
        session()->flash('message', 'surat jalan berhasil ditambahkan');
        return redirect(request()->header('Referer'));
    }

    public function tambahCartOut()
    {
        $cekstok = ResumeStokGudangPusat::where('id', $this->itemId)->first();
        if ($this->ukuran_allsize <= $cekstok->total_stok) {
            //dd($id);
            $pilihproduk = ResumeStokGudangPusat::where('id',  $this->itemId)->first();
            //dd($pilihproduk);
            $warna = (int)$pilihproduk->warna_id;
            $kode_barang = $pilihproduk->kode_barang;
            $cekkategori = ProdukProduksi::where('kode_barang', $kode_barang)->first();

            $kategori = $cekkategori->id_kategori;
            // $validatedData = $this->validate();
            //$cek = CartProduk::where('kode_barang', $kode_barang)->where('id_warna', $warna)->where('status_kirim', 1)->get();


            /*save ukuran allsize*/
            if (CartProduk::where('kode_barang', $kode_barang)
                ->where('id_warna', $warna)
                ->where('status_kirim', 1)
                ->where('id_ukuran', 1)
                ->where('jenis_inout', 11)
                ->exists()
            ) {
                $cart = CartProduk::where('kode_barang', $kode_barang)
                    ->where('id_warna', $warna)
                    ->where('status_kirim', 1)
                    ->where('id_ukuran', 1)
                    ->where('jenis_inout', 11)
                    ->first();
                $cart->quantity = $cart->quantity + $this->ukuran_allsize;
                $cart->save();
            } else {
                if (!is_null($this->ukuran_allsize)) {
                    $data = [
                        'quantity' => $this->ukuran_allsize,
                        'user_input_cart' => Auth::id(),
                        'kode_barang' => $pilihproduk->kode_barang,
                        'status_kirim' => $this->status_kirim,
                        'id_warna' => $warna,
                        'id_ukuran' => 1,
                        'kategori' => $kategori,
                        'jenis_inout' => $this->jenis_inout
                    ];
                    CartProduk::create($data);
                }
            }

            /*save ukuran s*/
            if (CartProduk::where('kode_barang', $kode_barang)
                ->where('id_warna', $warna)
                ->where('status_kirim', 1)
                ->where('id_ukuran', 2)
                ->where('jenis_inout', 11)
                ->exists()
            ) {
                $cart = CartProduk::where('kode_barang', $kode_barang)
                    ->where('id_warna', $warna)
                    ->where('status_kirim', 1)
                    ->where('id_ukuran', 2)
                    ->where('jenis_inout', 11)
                    ->first();
                $cart->quantity = $cart->quantity + $this->ukuran_s;
                $cart->save();
            } else {
                if (!is_null($this->ukuran_s)) {
                    $data = [
                        'quantity' => $this->ukuran_s,
                        'user_input_cart' => Auth::id(),
                        'kode_barang' => $pilihproduk->kode_barang,
                        'status_kirim' => $this->status_kirim,
                        'id_warna' => $warna,
                        'id_ukuran' => 2,
                        'kategori' => $kategori,
                        'jenis_inout' => $this->jenis_inout
                    ];
                    CartProduk::create($data);
                }
            }

            /*save ukuran m*/
            if (CartProduk::where('kode_barang', $kode_barang)
                ->where('id_warna', $warna)
                ->where('status_kirim', 1)
                ->where('id_ukuran', 3)
                ->where('jenis_inout', 11)
                ->exists()
            ) {
                $cart = CartProduk::where('kode_barang', $kode_barang)
                    ->where('id_warna', $warna)
                    ->where('status_kirim', 1)
                    ->where('id_ukuran', 3)
                    ->where('jenis_inout', 11)
                    ->first();
                $cart->quantity = $cart->quantity + $this->ukuran_m;
                $cart->save();
            } else {
                if (!is_null($this->ukuran_m)) {
                    $data = [
                        'quantity' => $this->ukuran_m,
                        'user_input_cart' => Auth::id(),
                        'kode_barang' => $pilihproduk->kode_barang,
                        'status_kirim' => $this->status_kirim,
                        'id_warna' => $warna,
                        'id_ukuran' => 3,
                        'kategori' => $kategori,
                        'jenis_inout' => $this->jenis_inout
                    ];
                    CartProduk::create($data);
                }
            }

            /*save ukuran l*/
            if (CartProduk::where('kode_barang', $kode_barang)
                ->where('id_warna', $warna)
                ->where('status_kirim', 1)
                ->where('id_ukuran', 4)
                ->where('jenis_inout', 11)
                ->exists()
            ) {
                $cart = CartProduk::where('kode_barang', $kode_barang)
                    ->where('id_warna', $warna)
                    ->where('status_kirim', 1)
                    ->where('id_ukuran', 4)
                    ->where('jenis_inout', 11)
                    ->first();
                $cart->quantity = $cart->quantity + $this->ukuran_l;
                $cart->save();
            } else {
                if (!is_null($this->ukuran_l)) {
                    $data = [
                        'quantity' => $this->ukuran_l,
                        'user_input_cart' => Auth::id(),
                        'kode_barang' => $pilihproduk->kode_barang,
                        'status_kirim' => $this->status_kirim,
                        'id_warna' => $warna,
                        'id_ukuran' => 4,
                        'kategori' => $kategori,
                        'jenis_inout' => $this->jenis_inout
                    ];
                    CartProduk::create($data);
                }
            }

            /*save ukuran xl*/
            if (CartProduk::where('kode_barang', $kode_barang)
                ->where('id_warna', $warna)
                ->where('status_kirim', 1)
                ->where('id_ukuran', 5)
                ->where('jenis_inout', 11)
                ->exists()
            ) {
                $cart = CartProduk::where('kode_barang', $kode_barang)
                    ->where('id_warna', $warna)
                    ->where('status_kirim', 1)
                    ->where('id_ukuran', 5)
                    ->where('jenis_inout', 11)
                    ->first();
                $cart->quantity = $cart->quantity + $this->ukuran_xl;
                $cart->save();
            } else {
                if (!is_null($this->ukuran_xl)) {
                    $data = [
                        'quantity' => $this->ukuran_xl,
                        'user_input_cart' => Auth::id(),
                        'kode_barang' => $pilihproduk->kode_barang,
                        'status_kirim' => $this->status_kirim,
                        'id_warna' => $warna,
                        'id_ukuran' => 5,
                        'kategori' => $kategori,
                        'jenis_inout' => $this->jenis_inout
                    ];
                    CartProduk::create($data);
                }
            }

            /*save ukuran xxl*/
            if (CartProduk::where('kode_barang', $kode_barang)
                ->where('id_warna', $warna)
                ->where('status_kirim', 1)
                ->where('id_ukuran', 6)
                ->where('jenis_inout', 11)
                ->exists()
            ) {
                $cart = CartProduk::where('kode_barang', $kode_barang)
                    ->where('id_warna', $warna)
                    ->where('status_kirim', 1)
                    ->where('id_ukuran', 6)
                    ->where('jenis_inout', 11)
                    ->first();
                $cart->quantity = $cart->quantity + $this->ukuran_xxl;
                $cart->save();
            } else {
                if (!is_null($this->ukuran_xxl)) {
                    $data = [
                        'quantity' => $this->ukuran_xxl,
                        'user_input_cart' => Auth::id(),
                        'kode_barang' => $pilihproduk->kode_barang,
                        'status_kirim' => $this->status_kirim,
                        'id_warna' => $warna,
                        'id_ukuran' => 6,
                        'kategori' => $kategori,
                        'jenis_inout' => $this->jenis_inout
                    ];
                    CartProduk::create($data);
                }
            }

            $this->emit('rendercart');
        } else {
            session()->flash('pesan', 'stok kurang');
        }
        $this->clearfield();
        $this->dispatchBrowserEvent('closeModalCartOut');
    }


    public function render()
    {
        $listproduk = ResumeStokGudangPusat::with('detailProduk', 'warna')
            ->where('kode_barang', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->groupBy('kode_barang', 'warna_id')
            ->paginate(5);
        return view('livewire.stok-out.buat-surat-jalan', ['listproduk' => $listproduk]);
    }
}
