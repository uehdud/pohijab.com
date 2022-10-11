<?php

namespace App\Http\Livewire\Suratjalan;

use App\Imports\SuratJalanPusat;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportSideBar extends Component
{
    use WithFileUploads;

    public $dataimport;


    public function importData()
    {
        if (!is_null($this->dataimport)) {
            Excel::import(new SuratJalanPusat(), $this->dataimport);
            $this->emit('refreshcartimport');
        } else {
            return redirect(request()->header('Referer'));
        }
    }

    public function render()
    {
        return view('livewire.suratjalan.import-side-bar');
    }
}
