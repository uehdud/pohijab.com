<?php

namespace App\Http\Livewire\Gudang;

use App\Models\GudangPusat;
use App\Models\ResumePembagianStokPusat;
use App\Models\ResumeStatus;
use App\Models\ResumeStokGudangPusat;
use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class ListGudangPusat extends Component
{
    use WithPagination;
    public $search;
    public $action;
    public $selectedItem;
    public $listdetail = 0;


    protected $listeners = [
        'listRefresh' => '$refresh',
        'refreshParent' => '$refresh'
    ];


    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;
        if ($action == 'delete') {
            $this->dispatchBrowserEvent('openStokDelete');
        } else {
            if ($action == 'update') {
                $this->emit('getPoId', $this->selectedItem);
                $this->dispatchBrowserEvent('openpembagianStok');
            } else {
                $this->emit('getPoId', null);
            }
        }
    }

    public function openList()
    {
        $this->listdetail = 1;
    }
    public function closeList()
    {
        $this->listdetail = 0;
    }


    public function render()
    {

        $datagudangpusat = ResumeStokGudangPusat::where('no_po', 'like', '%' . $this->search . '%')
            ->groupBy('kode_barang')
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view(
            'livewire.gudang.list-gudang-pusat',
            
        );
    }
}
