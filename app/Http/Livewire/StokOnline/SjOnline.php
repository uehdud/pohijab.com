<?php

namespace App\Http\Livewire\StokOnline;

use App\Models\SuratJalan;
use Livewire\Component;
use Livewire\WithPagination;

class SjOnline extends Component
{
    use WithPagination;
    public function render()
    {
        $datasj = SuratJalan::with('gudangtujuan', 'statusSJ')
            ->whereIn('gudang_tujuan', ['2', '11'])
            ->paginate(10);

        return view('livewire.stok-online.sj-online', ['datasj' => $datasj]);
    }
}
