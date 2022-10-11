<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ControlStokPenjualan implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('kontrol_stoks')
            ->join('mst_tokos', 'kontrol_stoks.tujuan', '=', 'mst_tokos.id')
            ->where('jenis_inout', 11)
            ->where('tujuan', 10)
            ->select('tanggal_sj', 'qty')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Qty'
        ];
    }
}
