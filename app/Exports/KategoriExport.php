<?php

namespace App\Exports;

use App\Models\KategoriModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class KategoriExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KategoriModel::select('nama', 'deskripsi')->get();
    }

    /**
    * Add column headers
    */
    public function headings(): array
    {
        return ["nama", "deskripsi"];
    }
}
