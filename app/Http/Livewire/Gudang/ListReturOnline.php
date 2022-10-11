<?php

namespace App\Http\Livewire\Gudang;

use App\Models\SuratJalan;
use Livewire\Component;

class ListReturOnline extends Component
{
    protected $listeners = [
        'refreshSJ' => 'render'
    ];

    public function render()
    {
        $suratjalan = SuratJalan::all()->sortDesc();
        return view('livewire.gudang.list-retur-online', ['suratjalan' => $suratjalan]);
    }
}
