<?php

namespace App\Http\Livewire\GudangPusat;

use App\Models\ResumeStokGudangPusat;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListStokGsp extends Component
{
    use WithPagination;

    public function render()
    {
        $datastok = ResumeStokGudangPusat::with('detailProduk')
            ->orderBy('no_po')
            ->groupBy('kode_barang')
           
            ->selectRaw('no_po,kode_barang, sum(total_stok) as jumlahstok')
            ->paginate(15);

        return view('livewire.gudang-pusat.list-stok-gsp', ['datastok' => $datastok]);
    }
}
