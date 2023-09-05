<?php

namespace App\Exports;

use App\Models\Survey;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
class ExportSurvey implements FromCollection
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    

    public function collection()
    {
        
        return Survey::all();
    }
}
