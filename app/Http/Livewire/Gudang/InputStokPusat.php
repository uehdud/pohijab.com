<?php

namespace App\Http\Livewire\Gudang;

use App\Models\GudangPusat;
use App\Models\MstToko;
use App\Models\PembagianStokPusat;
use App\Models\ResumePembagianStokPusat;
use App\Models\ResumeStokPusat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InputStokPusat extends Component
{
    public $no_po;
    public $nomor_po;
    public $stok_awal;
    public $stok_akhir;
    public $stok_akhirs;
    public $jumlah_produksi;
    public $keterangan_inout = 'Stok Awal';
    public $listpo = [];
    public $tokos = [];
    public $nama_toko;
    public $toko = [];
    public $listtoko = [];
    public $tokos1quantity;
    public $pembagian;
    public $listpembagian = [];
    public $buttonsimpan = 0;
    public $valid = 0;

    protected $listeners = [
        'getPoId',
        'forcedCloseModal',
        'refreshdata' => '$refresh'
    ];

    protected $rules = [
        'tokos' => 'required'
    ];


    public function getPoId($poId)
    {
        $this->poId = $poId;
        $poProduk = ResumePembagianStokPusat::find($this->poId);
        $this->no_po = $poProduk->no_po;
        $this->stok_awal = $poProduk->stok_po;
        $this->stok_akhir = $poProduk->sisa_stok_po;
        $this->listpembagian = PembagianStokPusat::where('no_po', '=', $this->no_po)
            ->get();
    }

    public function mount()
    {
        $this->listtoko = MstToko::all();
        $this->tokos = [
            ['toko_id' => '', 'quantity' => 0]
        ];
    }

    public function tambahToko()
    {
        $this->tokos[] = ['toko_id' => '', 'quantity' => 0];
        $cekstok = $this->tokos;
        $jumlah = 0;
        foreach ($cekstok  as $item) {
            $jumlah += $item['quantity'];
        }
        $this->pembagian = $jumlah;
        $this->stok_akhirs = $this->stok_akhir - $this->pembagian;
    }
    public function removeToko($index)
    {
        unset($this->tokos[$index]);
        $this->tokos = array_values($this->tokos);
    }

    public function cekstok()
    {
        $cekstok = $this->tokos;
        $jumlah = 0;
        foreach ($cekstok  as $item) {
            $jumlah += $item['quantity'];
        }
        $this->pembagian = $jumlah;
        $this->stok_akhirs = $this->stok_akhir - $this->pembagian;
        $validasi = $this->tokos;
        foreach ($this->tokos as $toko) {
            $jumlah = $toko['toko_id'];
        }
        if ($jumlah === "") {
            $this->valid = 1;
        } else {
            $this->valid = 0;
        }
        //dd($this->valid);
        $this->buttonsimpan = 1;
    }


    public function clearField()
    {
        $this->nomor_po = null;
        $this->jumlah_produksi = null;
    }
    public function resumeStok()
    {
        $dataStokPusat = [
            'no_po' => $this->nomor_po,
            'jumlah_stok_pusat' => $this->jumlah_produksi,
        ];
        ResumeStokPusat::create($dataStokPusat);
    }

    public function resumePembagian()
    {
        $dataStokPusat = [
            'no_po' => $this->nomor_po,
            'stok_po' => $this->jumlah_produksi,
            'sisa_stok_po' => $this->jumlah_produksi,
        ];
        ResumePembagianStokPusat::create($dataStokPusat);
    }

    public function inputStokPusat()
    {
        $validatedData = $this->validate();
        $dataStokPusat = [
            'no_po' => $this->nomor_po,
            'stok_pusat' => $this->jumlah_produksi,
            'keterangan_inout' => $this->keterangan_inout,
            'user_update_stok_pusat' => Auth::id()
        ];
        GudangPusat::create($dataStokPusat);
        $this->resumeStok();
        $this->resumePembagian();
        $this->emit('listRefresh');
        $this->clearField();
        return redirect(request()->header('Referer'));
        session()->flash('message', 'Stok Pusat Berhasil Ditambahkan');
    }

    public function render()
    {

        return view('livewire.gudang.input-stok-pusat');
    }

    public function updateResumePembagianStok()
    {
        $sisastok = ResumePembagianStokPusat::where('no_po', '=', $this->no_po)
            ->select('stok_po')
            ->first();
        $jumlahpembagian = DB::table('pembagian_stok_pusats')
            ->where('no_po', '=', $this->no_po)
            ->sum('jumlah_stok_pembagian');
        $jumlahpembagianint = (int) $jumlahpembagian;

        $stok_akhir = $sisastok->stok_po -  $jumlahpembagianint;

        $poProduk = ResumePembagianStokPusat::where('no_po', '=', $this->no_po)
            ->first();
        $poProduk->sisa_stok_po = $stok_akhir;
        //dd($stok_akhir, $sisastok->sisa_stok_po, $jumlahpembagian);

        $poProduk->save();
    }


    public function simpanPembagian()
    {
        $nopo = $this->no_po;
        $jumlahstok = $this->stok_awal;

        foreach ($this->tokos as $toko) {
            $namatoko = $toko['toko_id'];
            $jumlah = $toko['quantity'];
            $sisa = $jumlahstok - $jumlah;
            $arrpembagian = [
                ['toko_id', '=', $namatoko],
                ['no_po', '=', $nopo]
            ];

            if (PembagianStokPusat::where($arrpembagian)
                ->whereNotNull('jumlah_stok_pembagian')
                ->exists()
            ) {
                foreach ($this->tokos as $toko) {
                    $jumlah = $toko['quantity'];
                    $pembagiantoko = PembagianStokPusat::where($arrpembagian)
                        ->update(['jumlah_stok_pembagian' => $toko['quantity']]);
                }
                // $pembagiantoko['sisa_stok_po'] = ;
                // $pembagiantoko->save();

            } else {
                foreach ($this->tokos as $toko) {
                    $namatoko = $toko['toko_id'];
                    $jumlah = $toko['quantity'];
                    $order = PembagianStokPusat::create([
                        'no_po' => $nopo,
                        'jumlah_stok_pembagian' => $jumlah,
                        'toko_id' => $namatoko
                    ]);
                }
                // $this->updateResumePembagianStok();

            }
        }
        $this->updateResumePembagianStok();
        $this->emit('listRefresh');
        $this->dispatchBrowserEvent('closepembagianStok');
        return redirect(request()->header('Referer'));
        session()->flash('message', 'Pembagian Berhasil Ditambahkan');
    }

    public function delete($id)
    {
        PembagianStokPusat::where('id', $id)->delete();
        $this->updateResumePembagianStok();
    }
}
