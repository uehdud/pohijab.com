<?php

namespace App\Http\Livewire\GudangMakkata;

use App\Models\CartProduk;
use App\Models\MstMerk;
use App\Models\MstToko;
use App\Models\ProdukInoutSj;
use App\Models\ResumeGudangMakkata;
use App\Models\StokGudangMakkata;
use App\Models\SuratJalan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InputStok extends Component
{
    
    
    public $gudangtujuan;
    public $merk;
    
    public $keterangan_nota;
    public $mstgudang;
    public $mstmerk;
   
    
    public  $selesai = 1;


    protected $listeners = [
        'refreshcart' => '$refresh',
        'rendercart' => 'render'
    ];

    protected $rules = [
        'gudangtujuan' => 'required',
        //'merk' => 'required',
        'tanggal_nota' => 'required',
    ];

    protected $messages = [
        'gudangtujuan.required' => 'silahkan pilih gudang tujuan',
        //'merk.required' => 'silahkan pilih merk',
        'tanggal_nota.required' => 'silahkan pilih tanggal',
    ];
    public function render()
    {
        $cartproduk = CartProduk::groupBy('kode_barang', 'id_warna')
            ->where('status_kirim', 1)
            ->get();
        //dd($cartproduk);
        return view('livewire.gudang-makkata.input-stok', ['cartproduk' => $cartproduk]);
    }




    public function simpanNota()
    {

        //$validatedData = $this->validate();
       
        

        //dd($datacart);
        /* if ($this->gudangtujuan === 1) { */
        
            
        
    }
    public function mount()
    {
        //$this->mstgudang = MstToko::all();
        $this->mstmerk = MstMerk::all();
    }

   
}
