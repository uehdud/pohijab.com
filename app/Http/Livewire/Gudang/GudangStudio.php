<?php

namespace App\Http\Livewire\Gudang;

use App\Models\SuratJalan;
use Livewire\Component;
use Livewire\WithPagination;

class GudangStudio extends Component
{
    use WithPagination;

    public function render()
    {
        $listsj = SuratJalan::where('gudang_tujuan', 11)->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('livewire.gudang.gudang-studio', ['listsj' => $listsj]);
    }
}
