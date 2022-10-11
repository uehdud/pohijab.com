<?php

namespace App\Http\Livewire;

use App\Models\DetailFotoVideo;
use App\Models\Detailproduk;
use Livewire\Component;

class LoopTest extends Component
{
    public $fotovideo_produk;

    protected $listeners = [
        'tab1' => 'store'
    ];

    public function render()
    {
        return view('livewire.loop-test');
    }

    public function store()
    {
        $data = ['fotovideo_produk_id' => $this->fotovideo_produk];
        DetailFotoVideo::create($data);
    }
}
