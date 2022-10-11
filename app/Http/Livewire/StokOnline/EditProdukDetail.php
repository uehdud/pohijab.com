<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\DetailFotoVideo;
use App\Models\DetailProdukPlanet;
use App\Models\DetailStokProduksi;
use App\Models\MstWarna;
use App\Models\ProdukProduksi;
use App\Models\ResumeStokOnline;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PDO;

class EditProdukDetail extends Component
{
    public $produkid;
    public $datastok;
    public $fotosatuan;
    public $cekdetail;
    public $hargaup;
    public $hargajx;
    public $hargax;
    public $listwarna;
    public $warna;
    public $qtytambahstok;
    public $liststok;
    public $totalstok = 0;
    public $detail;
    public $ukuran_ld;
    public $ukuran_pb;
    public $ukuran_lp;
    public $ukuran_lph;
    public $ukuran_pc;
    public $editlokasi = null;
    public $editukuran = null;
    public $editdeskripsi = null;
    public $lokasi;
    public $deskripsi;

    protected $rules = [
        'warna' => 'required',
        'qtytambahstok' => 'required',
    ];

    protected $messages = [
        'warna.required' => 'silahkan pilih warna',
        'qtytambahstok.required' => 'silahkan isi qty',
    ];

    public function mount()
    {
        $this->datastok = ResumeStokOnline::with('detail.kategori', 'warna', 'ukuran', 'detailukuran', 'foto')
            ->where('id', $this->produkid)->first();
        $this->fotosatuan = DetailFotoVideo::where('fotovideo_produk_id', $this->datastok->kode_barang)->get();
        if (ProdukProduksi::where('kode_barang', $this->datastok->kode_barang)->exists()) {
            $detail = ProdukProduksi::where('kode_barang', $this->datastok->kode_barang)->first();
            $this->hargax = 'Rp ' . number_format($detail->harga_ta);
            $this->hargajx = 'Rp ' . number_format($detail->harga_planet);
            $this->hargaup = 'Rp ' . number_format($detail->harga_ta + ($detail->harga_ta * 0.3));
        } else {
            $this->hargax = 0;
            $this->hargajx = 0;
            $this->hargaup = 0;
        }

        $this->listwarna = MstWarna::all();
        $this->liststok = DetailStokProduksi::with('warna')
            ->where('produk_id', $this->datastok->id)
            ->get();

        if (DetailStokProduksi::where('produk_id', $this->datastok->id)->exists()) {
            $jumlahstok = DetailStokProduksi::where('produk_id', $this->datastok->id)
                ->get();
            foreach ($jumlahstok as $item) {
                $this->totalstok += $item['stok'];
            }
        }

        if (DetailProdukPlanet::where('kode_barang', $this->datastok->kode_barang)->exists()) {
            $detailukuran = DetailProdukPlanet::where('kode_barang', $this->datastok->kode_barang)->first();
            $this->ukuran_ld = $detailukuran->ukuran_ld;
            $this->ukuran_pb = $detailukuran->ukuran_pb;
            $this->ukuran_lp = $detailukuran->ukuran_lp;
            $this->ukuran_lph = $detailukuran->ukuran_lph;
            $this->ukuran_pc = $detailukuran->ukuran_pc;
            $this->deskripsi = $detailukuran->deskripsi;
            $this->detail = 1;
        } else {
            $this->detail = 0;
        }

        $this->lokasi = $this->datastok->lokasi;
        // dd($this->totalstok);
        // dd($this->datastok);


    }

    public function editLokasi()
    {
        $this->editlokasi = 1;
    }

    public function updateLokasi()
    {
        $updatelokasi =  ResumeStokOnline::where('id', $this->datastok->id)->first();
        $updatelokasi->lokasi = $this->lokasi;
        $updatelokasi->save();
        session()->flash('message', 'lokasi berhasil diupdate');
        return redirect(request()->header('Referer'));
    }

    public function editDeskripsi()
    {
        $this->editdeskripsi = 1;
    }

    public function updateDeskripsi()
    {
        //dd($this->deskripsi);
        $updatedeskripsi =  DetailProdukPlanet::where('kode_barang', $this->datastok->kode_barang)->first();
        $updatedeskripsi->deskripsi = $this->deskripsi;
        $updatedeskripsi->save();
        session()->flash('message', 'deskripsi berhasil diupdate');
        return redirect(request()->header('Referer'));
    }

    public function editUkuran()
    {
        $this->editukuran = 1;
    }

    public function updateUkuran()
    {
        $updateukuran =  DetailProdukPlanet::where('kode_barang', $this->datastok->kode_barang)->first();

        $updateukuran->ukuran_ld = $this->ukuran_ld;


        $updateukuran->ukuran_pb = $this->ukuran_pb;


        $updateukuran->ukuran_lp = $this->ukuran_lp;

        $updateukuran->ukuran_lph = $this->ukuran_lph;

        $updateukuran->ukuran_pc = $this->ukuran_pc;

        // dd($updateukuran->ukuran_ld);
        $updateukuran->save();

        session()->flash('message', 'ukuran berhasil diupdate');
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.stok-online.edit-produk-detail');
    }

    public function tambahStok()
    {
        $validatedData = $this->validate();
        $tambahstok = [
            'produk_id' => $this->datastok->id,
            'warna_id' => $this->warna,
            'stok' => $this->qtytambahstok,
            'user_input' => Auth::id()
        ];

        DetailStokProduksi::create($tambahstok);
        return redirect(request()->header('Referer'));
    }

    public function tambahUkuran()
    {
        $dataukuran = [
            'kode_barang' => $this->datastok->kode_barang,
            'ukuran_ld' => $this->ukuran_ld,
            'ukuran_pb' => $this->ukuran_pb,
            'ukuran_lp' => $this->ukuran_lp,
            'ukuran_lph' => $this->ukuran_lph,
            'ukuran_pc' => $this->ukuran_pc,
        ];
        DetailProdukPlanet::create($dataukuran);
        session()->flash('message', 'ukuran berhasil diupdate');
        return redirect(request()->header('Referer'));
    }

    public function hapusStokWarna($id)
    {
        DetailStokProduksi::findOrFail($id)->delete();
        session()->flash('message', 'stok berhasil diupdate');
        return redirect(request()->header('Referer'));
    }
}
