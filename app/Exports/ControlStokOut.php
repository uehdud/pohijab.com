<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ControlStokOut implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('kontrol_stoks')
            ->join('mst_tokos', 'kontrol_stoks.tujuan', '=', 'mst_tokos.id')
            ->where('jenis_inout', 11)
            ->whereIn('tujuan', ['11', '2'])
            ->select('no_sj', 'tanggal_sj', 'nama_toko', 'qty')
            ->get();
    }
    public function headings(): array
    {
        return [
            'Nomor SJ',
            'Tanggal',
            'Tujuan',
            'Qty'
        ];
    }
}
