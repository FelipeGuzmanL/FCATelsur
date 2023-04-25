<?php

namespace App\Exports;

use App\Models\Etiquetas;
use Maatwebsite\Excel\Concerns\FromCollection;

class EtiquetasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Etiquetas::all();
    }
}
