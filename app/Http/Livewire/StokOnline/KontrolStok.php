<?php

namespace App\Http\Livewire\StokOnline;

use App\Exports\ControlStokIn;
use App\Exports\ControlStokOut;
use App\Exports\ControlStokPenjualan;
use App\Models\CartProduk;
use App\Models\GudangOnline;
use App\Models\KontrolStok as ModelsKontrolStok;
use App\Models\MstWarna;
use App\Models\ResumeStokOnline;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class KontrolStok extends Component
{
    use WithPagination;
    public $jenis_inout;
    public $tujuan;
    public $no_sj;
    public $tanggal_sj;
    public $tanggal_penjualan;
    public $qty;
    public $qty_penjualan;
    public $keterangan;
    public $search_masuk;
    public $search_keluar;
    public $search_penjualan = null;
    public $jumlahmasuk;
    public $jumlahkeluar;
    public $jumlahpenjualan;
    public $listwarna;

    public $status_inout = 10;
    public $warna;
    public $ukuran_s;
    public $ukuran_m;
    public $ukuran_l;
    public $ukuran_xl;
    public $ukuran_xxl;
    public $ukuran_allsize;
    public $pilih_warna;
    public $cartproduk;
    public $jenisinout = 10;
    public $lokasi;
    public $kode_barang;
    public $kode_merk;

    public $id_kategori;


    protected $listeners = [
        'rendercart' => 'render'
    ];
    protected $rules = [
        'tujuan' => 'required',
        'no_sj' => 'required',
        'tanggal_sj' => 'required',
    ];

    public function clearField()
    {
        $this->no_sj = null;
        $this->tanggal_sj = null;
        $this->qty = null;
        $this->keterangan = null;
        $this->tujuan = null;
        $this->jenis_inout = null;
    }

    public function clearDATA()
    {
        
        $this->ukuran_allsize = null;
        $this->ukuran_s = null;
        $this->ukuran_m= null;
        $this->ukuran_l = null;
        $this->ukuran_xl = null;
        $this->ukuran_xxl = null;
    }
    public function clearpenjualan()
    {
        $this->tanggal_penjualan = null;
        $this->qty_penjualan = null;
    }
    public function mount()
    {
        $this->listwarna = MstWarna::all();
        $jumlahdatamasuk = ModelsKontrolStok::where('jenis_inout', 10)
            ->get();
        foreach ($jumlahdatamasuk as $masuk) {
            $this->jumlahmasuk += $masuk['qty'];
        }
        $jumlahdatakeluar = ModelsKontrolStok::where('jenis_inout', 11)->whereIn('tujuan', ['11', '2'])
            ->get();
        foreach ($jumlahdatakeluar as $keluar) {
            $this->jumlahkeluar += $keluar['qty'];
        }
        $jumlahdatapenjualan = ModelsKontrolStok::where('jenis_inout', 11)
            ->where('tujuan', 10)
            ->get();
        foreach ($jumlahdatapenjualan as $penjualan) {
            $this->jumlahpenjualan += $penjualan['qty'];
        }
    }


    public function simpanSuratJalan()
    {
        $validatedData = $this->validate();
        $ceksjumlah = CartProduk::with('warna', 'ukuran')
            ->where('user_input_cart', Auth::id())
            ->where('status_kirim', 1)
            ->get();

        if ($this->tujuan === 11) {
            $lokasi = 'Foto';
        } else {
            $lokasi = 0;
        }

        $jumlah = 0;
        foreach ($ceksjumlah as $cek) {
            $jumlah += $cek['quantity'];
        }

        foreach ($ceksjumlah as $ceks) {

            $gudangonline = [
                'no_surat_jalan' => $this->no_sj,
                'lokasi' => $lokasi,
                'kode_barang' => $ceks['kode_barang'],
                'quantity' => $ceks['quantity'],
                'status_inout' => 10,
                'keterangan_inout' => $this->keterangan,
                'user_input_stok_online' => Auth::id(),
                'tanggal_inout' => $this->tanggal_sj,
                'warna_id' => $ceks['id_warna'],
                'ukuran_id' => $ceks['id_ukuran'],
                'kode_merk' => $ceks['kode_merk']
            ];
            GudangOnline::create($gudangonline);

           /*  if (ResumeStokOnline::where('kode_barang', $ceks['kode_barang'])->exists()) {
                $updateresume = ResumeStokOnline::where('kode_barang', $ceks['kode_barang'])->first();
                $updateresume->jumlah_stok_online = $updateresume->jumlah_stok_online + $ceks['quantity'];
                $updateresume->save();
            } else { */
                $resumestok = [
                    'kode_barang' => $ceks['kode_barang'],
                    'lokasi' => $lokasi,
                    'jumlah_stok_online' => $ceks['quantity'],
                    'warna_id' => $ceks['id_warna'],
                    'ukuran_id' => $ceks['id_ukuran'],
                    'kode_merk' => $ceks['kode_merk']
                ];
                ResumeStokOnline::create($resumestok);
            /* } */
            $stat = CartProduk::where('id', $ceks['id'])->first();
            $stat->status_kirim = 2;
            $stat->save();
        }
        $inout = 10;
        $kontrolstok = [
            'no_sj' => $this->no_sj,
            'tanggal_sj' => $this->tanggal_sj,
            'qty' => $jumlah,
            'keterangan_sj' => $this->keterangan,
            'tujuan' => $this->tujuan,
            'jenis_inout' => $inout,
            'user_input' => Auth::id()
        ];
        ModelsKontrolStok::create($kontrolstok);


        //dd($jumlah);
        $this->clearField();
        $this->render();
        session()->flash('message', 'Surat jalan dan stok berhasil ditambahkan');
    }

    public function hapusCart($id)
    {
        // dd($id);
        $cart = CartProduk::find($id);
        if ($cart) {
            $cart->delete();
        }
        //dd($cart);
    }

    public function render()
    {
        $listcart = CartProduk::with('warna', 'ukuran')
            ->where('user_input_cart', Auth::id())
            ->where('status_kirim', 1)
            ->get();

        $datamasuk = ModelsKontrolStok::where('no_sj', 'like', '%' . $this->search_masuk . '%')
            ->where('jenis_inout', 10)
            ->orderBy('tanggal_sj', 'desc')
            ->paginate(10);
        $datakeluar = ModelsKontrolStok::where('no_sj', 'like', '%' . $this->search_keluar . '%')
            ->where('jenis_inout', 11)
            ->whereIn('tujuan', ['11', '2'])
            ->orderBy('tanggal_sj', 'desc')
            ->paginate(10);
        $datapenjualan = ModelsKontrolStok::where('tanggal_sj', 'like', '%' . $this->search_penjualan . '%')
            ->where('jenis_inout', 11)
            ->where('tujuan', 10)
            ->orderBy('tanggal_sj', 'desc')
            ->paginate(10);
        //dd( $datapenjualan);
        return view('livewire.stok-online.kontrol-stok', ['datamasuk' => $datamasuk], ['listcart' => $listcart, 'datakeluar' => $datakeluar, 'datapenjualan' => $datapenjualan]);
    }



    public function simpanSJ()
    {
        $validatedData = $this->validate();
        $datasj = [
            'no_sj' => $this->no_sj,
            'tanggal_sj' => $this->tanggal_sj,
            'qty' => $this->qty,
            'keterangan_sj' => $this->keterangan,
            'tujuan' => $this->tujuan,
            'jenis_inout' => $this->jenis_inout,
            'user_input' => Auth::id()
        ];
        ModelsKontrolStok::create($datasj);
        $this->clearField();
        $this->render();
        session()->flash('message', 'data berhasil ditambahkan');
    }

    public function simpanpenjualan()
    {
        $datasj = [
            'tanggal_sj' => $this->tanggal_penjualan,
            'qty' => $this->qty_penjualan,
            'tujuan' => 10,
            'jenis_inout' => 11,
            'user_input' => Auth::id()
        ];
        ModelsKontrolStok::create($datasj);
        $this->clearpenjualan();
        $this->render();
        session()->flash('pesan', 'data berhasil ditambahkan');
    }

    public function hapuspenjualan($id)
    {
        ModelsKontrolStok::find($id)->delete();
        session()->flash('hapus', 'data berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new ControlStokIn, 'in.xlsx');
    }
    public function exportout()
    {
        return Excel::download(new ControlStokOut, 'out.xlsx');
    }
    public function exportpenjualan()
    {
        return Excel::download(new ControlStokPenjualan, 'penjualan.xlsx');
    }





    public function tambahStokAllsize()
    {
        $warna = (int)$this->warna;
        $kategori = $this->id_kategori;
        $merk = $this->kode_merk;

        $datacartallsize = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $this->kode_barang,
            'kode_merk' => $merk,
            'quantity' => $this->ukuran_allsize,
            'jenis_inout' => 10,
            'status_kirim' => 1,
            'id_ukuran' => 1,
            'id_warna' => $warna,
            'kategori' => $kategori
        ];
        CartProduk::create($datacartallsize);
    }

    public function tambahStokS()
    {
        $warna = (int)$this->warna;
        $kategori = $this->id_kategori;
        $merk = $this->kode_merk;

        $datacarts = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $this->kode_barang,
            'kode_merk' => $merk,
            'quantity' => $this->ukuran_s,
            'jenis_inout' => 10,
            'status_kirim' => 1,
            'id_ukuran' => 2,
            'id_warna' => $warna,
            'kategori' => $kategori
        ];
        CartProduk::create($datacarts);
    }

    public function tambahStokM()
    {
        $warna = (int)$this->warna;
        $kategori = $this->id_kategori;
        $merk = $this->kode_merk;

        $datacartm = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $this->kode_barang,
            'kode_merk' => $merk,
            'quantity' => $this->ukuran_m,
            'jenis_inout' => 10,
            'status_kirim' => 1,
            'id_ukuran' => 3,
            'id_warna' => $warna,
            'kategori' => $kategori
        ];
        CartProduk::create($datacartm);
    }

    public function tambahStokL()
    {
        $warna = (int)$this->warna;
        $kategori = $this->id_kategori;
        $merk = $this->kode_merk;

        $datacartl = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $this->kode_barang,
            'kode_merk' => $merk,
            'quantity' => $this->ukuran_l,
            'jenis_inout' => 10,
            'status_inout',
            'status_kirim' => 1,
            'id_ukuran' => 4,
            'id_warna' => $warna,
            'kategori' => $kategori
        ];
        CartProduk::create($datacartl);
    }

    public function tambahStokXL()
    {
        $warna = (int)$this->warna;
        $kategori = $this->id_kategori;
        $merk = $this->kode_merk;

        $datacartxl = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $this->kode_barang,
            'kode_merk' => $merk,
            'quantity' => $this->ukuran_xl,
            'jenis_inout' => 10,
            'status_kirim' => 1,
            'id_ukuran' => 5,
            'id_warna' => $warna,
            'kategori' => $kategori
        ];
        CartProduk::create($datacartxl);
    }

    public function tambahStokXXL()
    {
        $warna = (int)$this->warna;

        $kategori = $this->id_kategori;
        $merk = $this->kode_merk;

        $datacartxxl = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $this->kode_barang,
            'kode_merk' => $merk,
            'quantity' => $this->ukuran_xxl,
            'jenis_inout' => 10,
            'status_kirim' => 1,
            'id_ukuran' => 6,
            'id_warna' => $warna,
            'kategori' => $kategori
        ];
        CartProduk::create($datacartxxl);
    }


    public function tambahStok()
    {
       
        if ($this->ukuran_allsize !== null) {
            $this->tambahStokAllsize();
        }
        if ($this->ukuran_s !== null) {
            $this->tambahStokS();
        }
        if ($this->ukuran_m !== null) {
            $this->tambahStokM();
        }
        if ($this->ukuran_l !== null) {
            $this->tambahStokL();
        }
        if ($this->ukuran_xl !== null) {
            $this->tambahStokXL();
        }
        if ($this->ukuran_xxl !== null) {
            $this->tambahStokXXL();
        }
        $this->emit('refreshcartout');
        $this->emit('rendercart');
        $this->clearDATA();
    }
}
