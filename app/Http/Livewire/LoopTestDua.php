<?php

namespace App\Http\Livewire;

use App\Models\DetailFotoVideo;
use Livewire\Component;

class LoopTestDua extends Component
{
    public $fotovideo_produk;

    protected $listeners = [
        'tab1' => 'store'
    ];



    public function store()
    {
        $data = ['fotovideo_produk_id' => $this->fotovideo_produk];
        DetailFotoVideo::create($data);
    }

    public function render()
    {
        return view('livewire.loop-test-dua');
    }
}
