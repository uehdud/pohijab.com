<?php

namespace App\Http\Livewire\Gudang;

use App\Models\GudangOnline;
use App\Models\MstGudang;
use App\Models\ResumeStokOnline;
use App\Models\SuratJalan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class InoutStokOnline extends Component
{
    use WithPagination;

    public $suratjalan;
    public $no_surat_jalan;
    public $tanggal_surat_jalan;
    public $keterangan;
    public $kode_barang;
    public $quantity;
    public $mstgudang;
    public $gudang_asal;
    public $gudang_tujuan;
    public $status_inout = 10;
    public $sjalan;
    public $btnsimpan = 0;
    public $jmlh;

    public $nsj;
    public $tanggal_sj;
    public $gd_asal;
    public $gd_tujuan;
    public $ket;
    public $produkSj = [];

    protected $rules = [
        'gudang_asal' => 'required',
        'gudang_tujuan' => 'required',
        'no_surat_jalan' => 'required',
        'tanggal_surat_jalan' => 'required',
    ];

    protected $messages = [
        'gudang_asal.required' => 'pilih gudang asal ',
        'gudang_tujuan.required' => 'silahkan pilih tujuan',
        'no_surat_jalan.required' => 'silahkan masukan no SJ',
        'tanggal_surat_jalan.required' => 'silahkan pilih tanggal SJ',
    ];

    public function mount()
    {
        $this->sjalan = SuratJalan::where('status_inout', $this->status_inout)->get();
        $this->mstgudang = MstGudang::all();
        $this->suratjalan = [
            ['kode_barang' => '', 'quantity' => 0]
        ];
    }

    public function tambahBarang()
    {
        $this->suratjalan[] =  ['kode_barang' => '', 'quantity' => 0];
        $this->btnsimpan = 0;
    }

    public function removeBarang($index)
    {
        unset($this->suratjalan[$index]);
        $this->suratjalan = array_values($this->suratjalan);
    }


    public function render()
    {
        return view('livewire.gudang.inout-stok-online');
    }

    public function showSJmasuk($id)
    {
        $showSj = SuratJalan::where('id', $id)->first();
        //dd($showSj->nomor_surat_jalan);
        $this->nsj = $showSj->nomor_surat_jalan;
        // dd($this->nsj);
        $this->tanggal_sj = $showSj->tanggal_surat_jalan;
        $this->ket = $showSj->keterangan_surat_jalan;
        $this->gd_asal = $showSj->gudangAsal->nama_gudang;
        $this->gd_tujuan = $showSj->gudangTujuan->nama_gudang;

        $this->produkSj = GudangOnline::where('no_surat_jalan', $this->nsj)
            ->get();
        //dd($this->produkSj);
    }

    public function deleteProduk($id)
    {
        $deleteprodukSj= GudangOnline::find($id)->delete();
    }

    public function selesai()
    {
        $validatedData = $this->validate();
        $jumlahbarangsj = 0;
        foreach ($this->suratjalan as $barangsj) {
            $jumlahbarangsj += $barangsj['quantity'];
            $kbproduk = $barangsj['kode_barang'];
        }
        $this->jmlh = $jumlahbarangsj;
        if ($jumlahbarangsj === 0 || is_null($kbproduk)) {
            $this->btnsimpan = 0;
        } else {
            $this->btnsimpan = 1;
        }
    }



    public function tambahStok()
    {

        $mastergudang = MstGudang::where('id', $this->gudang_asal)->get();
        foreach ($mastergudang as $gudang) {
            $namagudang = $gudang->nama_gudang;
        }


        $no_sj = $namagudang . '-' . $this->tanggal_surat_jalan . '-' . $this->no_surat_jalan;

        $jumlahbarangsj = 0;
        foreach ($this->suratjalan as $barangsj) {
            $jumlahbarangsj += $barangsj['quantity'];
        }

        //dd($jumlahbarangsj);

        foreach ($this->suratjalan as $barang) {

            $inputstokonline = GudangOnline::create(
                [
                    'no_surat_jalan' => $no_sj,
                    'kode_barang' => $barang['kode_barang'],
                    'quantity' => $barang['quantity'],
                    'keterangan_inout' => $this->status_inout,
                    'user_input_stok_online' => Auth::id(),
                    'tanggal_inout' => $this->tanggal_surat_jalan
                ]
            );
            $cekresume = ResumeStokOnline::where('kode_barang', $barang['kode_barang'])
                ->select('jumlah_stok_online')
                ->first();

            if (is_null($cekresume)) {
                $resumestokonline = ResumeStokOnline::create([
                    'kode_barang' => $barang['kode_barang'],
                    'jumlah_stok_online' => $barang['quantity']
                ]);
            } else {
                $getresume = ResumeStokOnline::where('kode_barang', $barang['kode_barang'])
                    ->first();
                //dd($getresume->jumlah_stok_online);
                $getresume->jumlah_stok_online = $cekresume->jumlah_stok_online + $barang['quantity'];
                $getresume->save();
            }
        }

        $dataproduk = GudangOnline::where('no_surat_jalan', $no_sj)
            ->select('quantity')
            ->get();
        $jumlahstokonline = 0;
        foreach ($dataproduk as $produk) {
            $jumlahstokonline += $produk['quantity'];
        }
        $ceksj = SuratJalan::where('nomor_surat_jalan', $no_sj)
            ->first();

        if (is_null($ceksj)) {
            $data = [
                'nomor_surat_jalan' => $no_sj,
                'tanggal_surat_jalan' => $this->tanggal_surat_jalan,
                'gudang_asal' => $this->gudang_asal,
                'gudang_tujuan' => $this->gudang_tujuan,
                'status_inout' => $this->status_inout,
                'keterangan_surat_jalan' => $this->keterangan,
                'jumlah_produk' =>  $jumlahbarangsj
            ];
            $inputstokonline = SuratJalan::create($data);
        } else {
            $ceksj->jumlah_produk = $jumlahstokonline;
            $ceksj->save();
        }
        return redirect(request()->header('Referer'));
    }
}
