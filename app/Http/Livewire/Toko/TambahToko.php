<?php

namespace App\Http\Livewire\Toko;

use App\Models\MstToko;
use Livewire\Component;

class TambahToko extends Component
{
    public $nama_toko;
    public $alamat_toko;
    public $kontak_toko;
    public $listtoko;


    public function render()
    {
        return view('livewire.toko.tambah-toko');
    }

    protected $rules = [
        'nama_toko' => 'required'
    ];

    public function mount()
    {
        $this->listtoko = MstToko::all()->sortDesc();
    }

    public function clearField()
    {
        $this->nama_toko = null;
        $this->alamat_toko = null;
        $this->kontak_toko = null;
    }

    public function createToko()
    {
        $validatedData = $this->validate();
        $datatoko = [
            'nama_toko' => $this->nama_toko,
            'alamat_toko' => $this->alamat_toko,
            'kontak_toko' => $this->kontak_toko,
        ];
        MstToko::create($datatoko);
        $this->clearField();
        $this->dispatchBrowserEvent('closeTokoInout');
        session()->flash('message', 'Data Toko Berhasil Ditambahkan');
        $this->mount();
        $this->render();
    }

   /*  public function delete($id)
    {
        MstToko::where('id', $id)->delete();
        $this->mount();
        $this->render();
    } */
}
