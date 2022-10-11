<?php

namespace App\Http\Livewire\Stok;

use App\Models\CartProduk;
use App\Models\ProdukInoutSj;
use App\Models\ProdukProduksi;
use App\Models\ResumeStokGudangPusat;
use App\Models\StokGudangPusat;
use App\Models\SuratJalan;
use App\Models\SuratJalanStok;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InputStokPusat extends Component
{
    public $selesai = 0;
    public $tanggal_stok;
    public $keterangan_stok;
    public $ceksuratjalan;

    public function selesaiCart()
    {
        $this->selesai = 1;
    }
    public function cancelCart()
    {
        $this->selesai = 0;
    }

    public function render()
    {
        return view('livewire.stok.input-stok-pusat');
    }

    protected $rules = [
        'tanggal_stok' => 'required'
    ];

    protected $messages = [
        'tanggal_stok.required' => 'silahkan pilih tanggal'
    ];

    public function simpanStok()
    {
        dd($this->ceksuratjalan);
        $validatedData = $this->validate();
        $datacart = CartProduk::where('user_input_cart', Auth::id())
            ->where('status_kirim', 1)
            ->where('jenis_inout', 10)
            ->get();

        $config = ['table' => 'surat_jalan_stoks', 'field' => 'nomor_surat_jalan', 'length' => 12, 'prefix' => 'STOKIN-'];
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
                'status_kirim' => 21,
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
                'status_inout' => 10,
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
                $dataresumestok->total_stok = $dataresumestok->total_stok + $item['quantity'];
                $dataresumestok->save();
            } else {
                $resumestok = [
                    'kode_barang' => $item['kode_barang'],
                    'no_po' => $ceknopo->nomor_po,
                    'total_stok' => $item['quantity'],
                    'warna_id' => $item['id_warna'],
                    'ukuran_id' => $item['id_ukuran']
                ];
                ResumeStokGudangPusat::create($resumestok);
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
            'gudang_asal' => 33,
            'gudang_tujuan' => 1,
            'status_inout' => 10,
            'keterangan_surat_jalan' => $this->keterangan_stok,
            'status_kirim_sj' => 3,
            'user_input' => Auth::id(),
        ];
        SuratJalanStok::create($dataresume);
        //dd($nosj);
        session()->flash('message', 'stok dan surat jalan berhasil ditambahkan');
        return redirect(request()->header('Referer'));
    }
}
