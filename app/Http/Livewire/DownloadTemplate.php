<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DownloadTemplate extends Component
{
    public function render()
    {
        return view('livewire.download-template');
    }

    public function downloadTemplate()
    {
        return Storage::disk('s3')->download('dokumen/template_import.xlsx');
    }
}
