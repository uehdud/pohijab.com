<?php

namespace App\Http\Livewire\Suratjalan;

use App\Models\SuratJalan;
use Livewire\Component;

class ListSjKeluarPusat extends Component
{
    public function render()
    {
        $listsjmasuk = SuratJalan::with('toko', 'statusSJ')
            ->where('gudang_asal', 1)
            //->where('status_kirim_sj', 21, 4)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        // dd($listsjmasuk);
        return view('livewire.suratjalan.list-sj-keluar-pusat', ['listsjmasuk' => $listsjmasuk]);
    }
}
