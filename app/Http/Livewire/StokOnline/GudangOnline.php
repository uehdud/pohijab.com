<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\ResumeStokOnline;
use Livewire\Component;
use Livewire\WithPagination;

class GudangOnline extends Component
{
    use WithPagination;
    public $lokasi = null;
    public $lokasistok;
    public $ukuran_allsize;
    public $getID;


    public function openupdateStok($id)
    {
        // dd($this->lokasi);

        $datas = ResumeStokOnline::where('id', $id)->first();
        $this->lokasistok = $datas->lokasi;
        $this->ukuran_allsize = $datas->jumlah_stok_online;
        $this->getID = $datas->id;
        $this->dispatchBrowserEvent('openUpdateGudang');
    }

    public function updateStok()
    {
        // dd($this->lokasi);

        $datas = ResumeStokOnline::where('id', $this->getID)->first();
        //dd($this->getID);
        $datas->lokasi =  $this->lokasistok;
        $datas->jumlah_stok_online = $this->ukuran_allsize;
        $datas->save();
        session()->flash('message', 'data berhasil diupdate');
        $this->dispatchBrowserEvent('closeUpdateGudang');
    }

    public function refreshdata()
    {
        $this->lokasi = null;
    }

    public function uncheckSo()
    {
        $datastok = ResumeStokOnline::all();

        foreach ($datastok as $stok) {
            $updateso = ResumeStokOnline::where('id', $stok['id'])->first();
            $updateso->status_so = 1;
            $updateso->save();
        }
    }
    public function checkSo($id)
    {
        $checkso = ResumeStokOnline::where('id', $id)->first();
        $checkso->status_so = 2;
        $checkso->save();

        $this->render();
    }

    public function uncheck($id)
    {
        $uncheckso = ResumeStokOnline::where('id', $id)->first();
        $uncheckso->status_so = 1;
        $uncheckso->save();
    }

    public function render()
    {
        if ($this->lokasi === null) {
            $datagudang = ResumeStokOnline::with('warna', 'ukuran')
                ->where('jumlah_stok_online', '>', 0)
                ->orderBy('lokasi', 'asc')
                /*  whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])*/

                ->get();
            $jumlahgudang = ResumeStokOnline::all()
                /* whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])
                ->get() */;
            $jumlahstok = 0;
            foreach ($jumlahgudang as $jumlah) {
                $jumlahstok += $jumlah['jumlah_stok_online'];
            }
        } else {
            $datagudang = ResumeStokOnline::with('warna', 'ukuran')
                ->where('jumlah_stok_online', '>', 0)
                /* whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])*/
               // ->where('kode_barang', 'like', '%' . $this->lokasi . '%')
                ->where('lokasi', $this->lokasi )
                ->get();

            $jumlahgudang = ResumeStokOnline::
                /* whereIn('kode_merk', ['K', 'X', 'NN', 'T', 'CL', 'G', 'V'])
                -> */where('lokasi', $this->lokasi)
                ->get();
            $jumlahstok = 0;
            foreach ($jumlahgudang as $jumlah) {
                $jumlahstok += $jumlah['jumlah_stok_online'];
            }
        }
        return view('livewire.stok-online.gudang-online', ['datagudang' => $datagudang, 'jumlahstok' => $jumlahstok]);
    }
}
