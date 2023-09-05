<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportSurvey;
use App\Exports\ExportSurvey;
use App\Imports\UploadOption;
use App\Models\Suvery;

class ImportExport extends Controller
{
    public function import(Request $request){
        if(!$request->file('file')){
            return redirect()->back();
        }
     
        $survey=new ImportSurvey;
        Excel::import( $survey,
                      $request->file('file')->store('files'));

                 $survey=json_encode($survey->contents);
                   return $survey;
                //    $data=compact('survey');
                //      return redirect()->back()->with(['survey' => $survey]);
                   
    }

    public function upload(Request $request){
    
        if(!$request->file('options')){
            return redirect()->back();
        }
       
       
        $file =   $request->file('options')->store('options') ;// Replace with the actual path to your Excel file
    $options = new UploadOption();

    Excel::import($options,  $file);
        //$option=json_encode($options->options);
        $option=$options->options;
        $data = compact('option');
        return $options->options;
     
    }

    public function export(Request $request ){
       

        return (new ExportSurvey)->download('survey.xlsx');
     }
}
