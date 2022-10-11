<?php

namespace App\Exports;

use App\Models\ProdukProduksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class InoutExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProdukProduksi::all();
    }
}
