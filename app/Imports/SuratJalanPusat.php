<?php

namespace App\Imports;

use App\Models\CartSuratJalan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class SuratJalanPusat implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */ public function startRow(): int
    {
        return 1;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }
    public function model(array $row)
    {
        return new CartSuratJalan([
            'gudang_penerima' => $row[0],
            'tanggal_sj' => $row[1],
            'kode_barang' => $row[2],
            'quantity' => $row[3],
            'status_kirim' => 1,
            'user_id' => Auth::id(),
        ]);
    }
}
