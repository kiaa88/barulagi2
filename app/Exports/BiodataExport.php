<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\BiodataModel;

class BiodataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BiodataModel::select( 'name',
        'email',
        'phone',
        'alamat',)->get();
    }

    /**
    * Add column headers
    */
    public function headings(): array
    {
        return [ 'name',
        'email',
        'phone',
        'alamat',];}
}
