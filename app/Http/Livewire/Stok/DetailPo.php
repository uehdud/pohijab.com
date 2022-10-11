<?php

namespace App\Http\Livewire\Stok;

use App\Models\FotoVideoProduk;
use App\Models\ProdukProduksi;
use App\Models\ResumeStokGudangPusat;
use App\Models\StokGudangPusat;
use App\Models\SuratJalanStok;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailPo extends Component
{
    public $nomorpo;
    public $kb;
    public $supplier;
    public $kode_model;
    public $kode_bahan;
    public $kode_merk;
    public $kode_supp;
    public $merk;
    public $kategori;
    public $qtyproduksi;
    public $namabahan;
    public $kode_harga_modal;
    public $kode_harga_ta;
    public $kode_harga_planet;
    public $keterangan;
    public $ceksuratJalan;
    public $tanggal_nota;
    public $status_nota;
    public $qty_nota;
    public $keterangan_nota;
    public $sj_supp;
    public $foto;
    public $jumlahsetor;
    public $sisa;
    public $cacat;



    public function mount($nopo)
    {
        $datapo = ProdukProduksi::with('kategori')
            ->where('nomor_po', $nopo)
            ->first();
        //dd($datapo);

        $this->nomorpo = $datapo->nomor_po;
        $this->kb = $datapo->kode_barang;
        $this->kode_model = $datapo->kode_model;
        $this->kode_bahan = $datapo->kode_bahan;
        $this->kode_merk = $datapo->kode_merk;
        $this->kode_supp = $datapo->kode_supp;
        $this->kode_harga_modal = $datapo->kode_harga_modal;
        $this->kode_harga_ta = $datapo->kode_harga_ta;
        $this->kode_harga_planet = $datapo->kode_harga_planet;
        $this->merk = $datapo->merk;
        $this->namabahan = $datapo->nama_bahan;
        $this->keterangan = $datapo->keterangan_po;
        $this->qtyproduksi = $datapo->qty_produksi;
        $this->kategori = $datapo->kategoris->kode_kategori;
        $kodebarang = (int)$datapo->kode_barang;
        if (FotoVideoProduk::where('kode_barang', $kodebarang)->exists()) {

            $fotokombo = FotoVideoProduk::where('kode_barang', $kodebarang)->first();
            //dd($fotokombo);

            $this->foto = $fotokombo->image_comp;
        } else {
            $this->foto = "https://planetfashion.s3.ap-southeast-1.amazonaws.com/onprosess.jpg";
        }


        $datanota = SuratJalanStok::where('nomor_po', $this->nomorpo)
            ->where('status_inout', 1)
            ->get();
        $retur = SuratJalanStok::where('nomor_po', $this->nomorpo)
            ->where('status_inout', 2)
            ->first();
        $jumlah = 0;
        if ($datanota !== null) {
            foreach ($datanota as $data) {
                $jumlah += $data->jumlah_produk;
            }
            $this->jumlahsetor = $jumlah;
        } else {
            $this->jumlahsetor = 0;
        }


        if ($retur !== null) {
            $this->cacat = $retur->jumlah_produk;
        } else {
            $this->cacat = 0;
        }

        $this->sisa = $datapo->qty_produksi - ($this->jumlahsetor + $this->cacat);
    }

    public function clearField()
    {
        $this->qty_nota = null;
        $this->tanggal_nota = null;
        $this->status_nota = null;
        $this->keterangan_nota = null;
        $this->ceksuratJalan = null;
        $this->sj_supp = null;
    }

    protected $rules = [
        'tanggal_nota' => 'required',
        'qty_nota' => 'required',
        'status_nota' => 'required',
    ];

    public function simpanSetor()
    {
        $validatedData = $this->validate();
        $config = ['table' => 'surat_jalan_stoks', 'field' => 'nomor_surat_jalan', 'length' => 12, 'prefix' => 'STOKIN-'];
        $nosj = IdGenerator::generate($config);

        $datanota = [
            'nomor_surat_jalan' => $nosj,
            'nomor_po' => $this->nomorpo,
            'jumlah_produk' => $this->qty_nota,
            'tanggal_surat_jalan' => $this->tanggal_nota,
            'gudang_tujuan' => 1,
            'status_inout' => $this->status_nota,
            'keterangan_surat_jalan' => $this->keterangan_nota,
            'cek_sj_supp' => $this->ceksuratJalan,
            'sj_supplier' => $this->sj_supp,
            'supplier' => $this->kode_supp,
            'user_input' => Auth::id(),
        ];
        SuratJalanStok::create($datanota);

        $datastok = [
            'kode_barang' => $this->kb,
            'no_po' => $this->nomorpo,
            'no_surat_jalan' => $nosj,
            'qty' => $this->qty_nota,
            'warna_id' => 135,
            'ukuran_id' => 1,
            'status_inout' => 10,
            'keterangan_inout' => $this->keterangan_nota,
            'user_input' => Auth::id()
        ];
        StokGudangPusat::create($datastok);

        if (ResumeStokGudangPusat::where('kode_barang', $this->kb)->exists()) {
            $resumestok = ResumeStokGudangPusat::where('kode_barang', $this->kb)->first();
            $resumestok->total_stok = $resumestok->total_stok + $this->qty_nota;
            $resumestok->save();
        } else {
            $dataresumestok = [
                'kode_barang' => $this->kb,
                'no_po' => $this->nomorpo,
                'total_stok' => $this->qty_nota,
                'warna_id' => 135,
                'ukuran_id' => 1
            ];
            ResumeStokGudangPusat::create($dataresumestok);
        }



        $this->clearField();
        session()->flash('message', 'data berhasil ditambahkan');
        $this->render();
    }
    public function render()
    {
        $datanota = SuratJalanStok::where('nomor_po', $this->nomorpo)->get();

        return view('livewire.stok.detail-po', ['datanota' => $datanota]);
    }
}
