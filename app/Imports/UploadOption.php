<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UploadOption implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public $options=[];
    public function collection(Collection $rows)
    {
       
        foreach ($rows as $row) {
            // Perform your operations on each row
           
            $this->options[]= $row[0];
          
         
        }

    }
}
