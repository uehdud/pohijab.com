<?php

namespace App\Exports;

use App\Models\KontrolStok;
use App\Models\ProdukProduksi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ControlStokIn implements FromCollection, WithHeadings, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('kontrol_stoks')
            ->join('mst_tokos', 'kontrol_stoks.tujuan', '=', 'mst_tokos.id')
            ->where('kontrol_stoks.jenis_inout', 10)
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



    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
