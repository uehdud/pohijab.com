<?php

namespace App\Http\Livewire\Gudang;

use App\Models\ResumeStokOnline;
use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class ListStokOnline extends Component
{
    use WithPagination;

    public function render()
    {
        $stokonline = ResumeStokOnline::orderBy('created_at', 'desc')
            ->paginate(5);
        return view('livewire.gudang.list-stok-online', ['stokonline' => $stokonline]);
    }
}
