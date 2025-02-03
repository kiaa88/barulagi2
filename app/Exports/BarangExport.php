<?php

namespace App\Exports;

use App\Models\BarangModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BarangModel::select('kode_barang', 'nama_barang', 'stock', 'gambar', 'kategori')->get();
    }

    /**
    * Add column headers
    */
    public function headings(): array
    {
        return ["Kode Barang", "Nama Barang", "Stock", "Gambar", "Kategori"];
    }
}
