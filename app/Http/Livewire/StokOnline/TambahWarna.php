<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\MstWarna;
use Livewire\Component;

class TambahWarna extends Component
{
    public $namawarna;


    protected $rules = [
        'namawarna' => 'required',
    ];

    protected $messages = [
        'namawarna.required' => 'silahkan isi nama warna',
    ];
    public function tambahWarnas()
    {
        $validatedData = $this->validate();



        MstWarna::create(['nama_warna' => $this->namawarna]);
        session()->flash('message', 'warna berhasil ditambahkan');
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.stok-online.tambah-warna');
    }
}
