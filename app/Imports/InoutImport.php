<?php

namespace App\Imports;

use App\Models\ProdukProduksi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InoutImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ProdukProduksi([
            'nomor_po' => $row['nomor_po'],
            'art' => $row['art'],
            'kode_supp' => $row['kode_supp'],
            'id_kategori' => $row['id_kategori'],
            'kode_model' => $row['kode_model'],
            'kode_bahan' => $row['kode_bahan'],
            'kode_merk' => $row['kode_merk'],
            'merk' => $row['merk'],
            'kode_barang' => $row['kode_barang'],
            'kb' => $row['kode_barang'],
            'qty_produksi' => $row['qty_produksi'],
            'harga_modal' => $row['harga_modal'],
            'kode_harga_modal' => $row['kode_harga_modal'],
            'harga_ta' => $row['harga_ta'],
            'kode_harga_ta' => $row['kode_harga_ta'],
            'harga_planet' => $row['harga_planet'],
            'kode_harga_planet' => $row['kode_harga_planet'],
            'nama_bahan' => $row['nama_bahan'],
            'qty_seri' => $row['qty_seri'],
            'keterangan_po' => $row['keterangan_po'],
            'user_input_po' => $row['user_input_po'],
        ]);
    }
    
}
