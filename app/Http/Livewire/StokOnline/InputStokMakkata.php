<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\CartProduk;
use App\Models\GudangOnline;
use App\Models\MstWarna;
use App\Models\ProdukProduksi;
use App\Models\ResumeStokOnline;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class InputStokMakkata extends Component
{
    use WithPagination;
    public $search = null;
    public $qty;
    public $status_inout = 10;
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
    public $jenis_inout = 10;
    public $lokasi;



    public function mount()
    {
        $this->listwarna = MstWarna::all();
    }

    public function updateProduk()
    {
        $this->search;
        $this->render();
        // dd($this->search);
    }

    protected $rules = [
        'warna' => 'required',
    ];

    protected $messages = [
        'warna.required' => 'silahkan pilih warna',
    ];
    public function clearField()
    {
        $this->search = null;
        $this->warna = null;
        $this->lokasi = null;
        $this->ukuran_allsize = null;
        $this->ukuran_s = null;
        $this->ukuran_m = null;
        $this->ukuran_l = null;
        $this->ukuran_xl = null;
        $this->ukuran_xxl = null;
    }

    public function tambahStokAllsize($kode_barang)
    {
        $warna = (int)$this->warna;
        $pilihproduk = ProdukProduksi::where('kode_barang', $kode_barang)->first();

        $kategori = $pilihproduk->id_kategori;
        $merk = $pilihproduk->kode_merk;

        $datacartallsize = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $kode_barang,
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

    public function tambahStokS($kode_barang)
    {
        $warna = (int)$this->warna;
        $pilihproduk = ProdukProduksi::where('kode_barang', $kode_barang)->first();

        $kategori = $pilihproduk->id_kategori;
        $merk = $pilihproduk->kode_merk;

        $datacarts = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $kode_barang,
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

    public function tambahStokM($kode_barang)
    {
        $warna = (int)$this->warna;
        $pilihproduk = ProdukProduksi::where('kode_barang', $kode_barang)->first();

        $kategori = $pilihproduk->id_kategori;
        $merk = $pilihproduk->kode_merk;

        $datacartm = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $kode_barang,
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

    public function tambahStokL($kode_barang)
    {
        $warna = (int)$this->warna;
        $pilihproduk = ProdukProduksi::where('kode_barang', $kode_barang)->first();

        $kategori = $pilihproduk->id_kategori;
        $merk = $pilihproduk->kode_merk;

        $datacartl = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $kode_barang,
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

    public function tambahStokXL($kode_barang)
    {
        $warna = (int)$this->warna;
        $pilihproduk = ProdukProduksi::where('kode_barang', $kode_barang)->first();

        $kategori = $pilihproduk->id_kategori;
        $merk = $pilihproduk->kode_merk;

        $datacartxl = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $kode_barang,
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

    public function tambahStokXXL($kode_barang)
    {
        $warna = (int)$this->warna;
        $pilihproduk = ProdukProduksi::where('kode_barang', $kode_barang)->first();

        $kategori = $pilihproduk->id_kategori;
        $merk = $pilihproduk->kode_merk;

        $datacartxxl = [
            'user_input_cart' => Auth::id(),
            'kode_barang' => $kode_barang,
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


    public function tambahStok($kode_barang)
    {
        $validatedData = $this->validate();
        if ($this->ukuran_allsize !== null) {
            $this->tambahStokAllsize($kode_barang);
        }
        if ($this->ukuran_s !== null) {
            $this->tambahStokS($kode_barang);
        }
        if ($this->ukuran_m !== null) {
            $this->tambahStokM($kode_barang);
        }
        if ($this->ukuran_l !== null) {
            $this->tambahStokL($kode_barang);
        }
        if ($this->ukuran_xl !== null) {
            $this->tambahStokXL($kode_barang);
        }
        if ($this->ukuran_xxl !== null) {
            $this->tambahStokXXL($kode_barang);
        }
        $this->emit('refreshcartout');
        $this->emit('rendercart');
        $this->clearField();
    }


    public function tambahCart($kode_barang)
    {
        //dd($this->warna);
        $warna = (int)$this->warna;
        $pilihproduk = ProdukProduksi::where('kode_barang', $kode_barang)->first();
        $kategori = $pilihproduk->id_kategori;
        $merk = $pilihproduk->kode_merk;
        $validatedData = $this->validate();

        //dd(ResumeStokOnline::where('kode_barang', $kode_barang)->where('warna_id', $this->warna)->where('ukuran_id', $this->ukuran_allsize)->exists());

        /* all size */


        /* s */
        if (ResumeStokOnline::where('kode_barang', $kode_barang)->where('warna_id', $this->warna)->where('ukuran_id', 2)->exists()) {
            if (!is_null($this->ukuran_s)) {
                $s =   ResumeStokOnline::where('kode_barang', $kode_barang)
                    ->where('warna_id', $this->warna)
                    ->where('ukuran_id', 2)
                    ->first();
                // dd($allsize);
                session()->flash('message', 'data berhasil ditambahkan, lokasi dirubah dari ' . $s->lokasi . ' menjadi ' . $this->lokasi);
                $s->jumlah_stok_online = $s->jumlah_stok_online + $this->ukuran_s;
                $s->lokasi = $this->lokasi;
                $s->save();

                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_s,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 2,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);
            }
        } else {
            if (!is_null($this->ukuran_s)) {
                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_s,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 2,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);

                $dataresume = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'jumlah_stok_online' => $this->ukuran_s,
                    'warna_id' => $warna,
                    'kode_merk' => $merk,
                    'ukuran_id' => 2,
                    'lokasi' => $this->lokasi
                ];
                ResumeStokOnline::create($dataresume);
            }
            session()->flash('message', 'data berhasil ditambahkan');
        }

        /* m */
        if (ResumeStokOnline::where('kode_barang', $kode_barang)->where('warna_id', $this->warna)->where('ukuran_id', 3)->exists()) {
            if (!is_null($this->ukuran_m)) {
                $m =   ResumeStokOnline::where('kode_barang', $kode_barang)
                    ->where('warna_id', $this->warna)
                    ->where('ukuran_id', 3)
                    ->first();
                // dd($allsize);
                session()->flash('message', 'data berhasil ditambahkan, lokasi dirubah dari ' . $m->lokasi . ' menjadi ' . $this->lokasi);
                $m->jumlah_stok_online = $m->jumlah_stok_online + $this->ukuran_m;
                $m->lokasi = $this->lokasi;
                $m->save();

                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_m,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 3,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);
            }
        } else {
            if (!is_null($this->ukuran_m)) {
                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_m,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 3,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);

                $dataresume = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'jumlah_stok_online' => $this->ukuran_m,
                    'warna_id' => $warna,
                    'kode_merk' => $merk,
                    'ukuran_id' => 3,
                    'lokasi' => $this->lokasi
                ];
                ResumeStokOnline::create($dataresume);
            }
            session()->flash('message', 'data berhasil ditambahkan');
        }

        /* l */
        if (ResumeStokOnline::where('kode_barang', $kode_barang)->where('warna_id', $this->warna)->where('ukuran_id', 4)->exists()) {
            if (!is_null($this->ukuran_l)) {
                $l =   ResumeStokOnline::where('kode_barang', $kode_barang)
                    ->where('warna_id', $this->warna)
                    ->where('ukuran_id', 4)
                    ->first();
                // dd($allsize);
                session()->flash('message', 'data berhasil ditambahkan, lokasi dirubah dari ' . $l->lokasi . ' menjadi ' . $this->lokasi);
                $l->jumlah_stok_online = $l->jumlah_stok_online + $this->ukuran_l;
                $l->lokasi = $this->lokasi;
                $l->save();

                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_l,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 4,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);
            }
        } else {
            if (!is_null($this->ukuran_l)) {
                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_l,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 4,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);

                $dataresume = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'jumlah_stok_online' => $this->ukuran_l,
                    'warna_id' => $warna,
                    'kode_merk' => $merk,
                    'ukuran_id' => 4,
                    'lokasi' => $this->lokasi
                ];
                ResumeStokOnline::create($dataresume);
            }
            session()->flash('message', 'data berhasil ditambahkan');
        }

        /* xl */
        if (ResumeStokOnline::where('kode_barang', $kode_barang)->where('warna_id', $this->warna)->where('ukuran_id', 5)->exists()) {
            if (!is_null($this->ukuran_xl)) {
                $xl =   ResumeStokOnline::where('kode_barang', $kode_barang)
                    ->where('warna_id', $this->warna)
                    ->where('ukuran_id', 5)
                    ->first();
                // dd($allsize);
                session()->flash('message', 'data berhasil ditambahkan, lokasi dirubah dari ' . $xl->lokasi . ' menjadi ' . $this->lokasi);
                $xl->jumlah_stok_online = $xl->jumlah_stok_online + $this->ukuran_xl;
                $xl->lokasi = $this->lokasi;
                $xl->save();

                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_xl,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 5,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);
            }
        } else {
            if (!is_null($this->ukuran_xl)) {
                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_xl,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 5,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);

                $dataresume = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'jumlah_stok_online' => $this->ukuran_xl,
                    'warna_id' => $warna,
                    'kode_merk' => $merk,
                    'ukuran_id' => 5,
                    'lokasi' => $this->lokasi
                ];
                ResumeStokOnline::create($dataresume);
            }
            session()->flash('message', 'data berhasil ditambahkan');
        }

        /* xxl */
        if (ResumeStokOnline::where('kode_barang', $kode_barang)->where('warna_id', $this->warna)->where('ukuran_id', 6)->exists()) {
            if (!is_null($this->ukuran_xxl)) {
                $xxl =   ResumeStokOnline::where('kode_barang', $kode_barang)
                    ->where('warna_id', $this->warna)
                    ->where('ukuran_id', 6)
                    ->first();
                // dd($allsize);
                session()->flash('message', 'data berhasil ditambahkan, lokasi dirubah dari ' . $xxl->lokasi . ' menjadi ' . $this->lokasi);
                $xxl->jumlah_stok_online = $xxl->jumlah_stok_online + $this->ukuran_xxl;
                $xxl->lokasi = $this->lokasi;
                $xxl->save();

                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_xxl,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 6,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);
            }
        } else {
            if (!is_null($this->ukuran_xxl)) {
                $data = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'quantity' => $this->ukuran_xxl,
                    'status_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'warna_id' => $warna,
                    'ukuran_id' => 6,
                    'kode_merk' => $merk,
                    'lokasi' => $this->lokasi
                ];
                GudangOnline::create($data);

                $dataresume = [
                    'kode_barang' => $pilihproduk->kode_barang,
                    'lokasi',
                    'jumlah_stok_online' => $this->ukuran_xxl,
                    'warna_id' => $warna,
                    'kode_merk' => $merk,
                    'ukuran_id' => 6,
                    'lokasi' => $this->lokasi
                ];
                ResumeStokOnline::create($dataresume);
            }
            session()->flash('message', 'data berhasil ditambahkan');
        }

        $this->clearField();

        $this->emit('refreshcartout');
        $this->emit('rendercart');
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        $listproduk = ProdukProduksi::where('kode_barang', 'like', '%' . $this->search . '%')
            ->orWhere('kode_model', 'like', '%' . $this->search . '%')
            ->orWhere('nomor_po', 'like', '%' . $this->search . '%')
            ->orWhere('merk', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')

            ->paginate(1);
        return view('livewire.stok-online.input-stok-makkata', ['listproduk' => $listproduk]);
    }
}
