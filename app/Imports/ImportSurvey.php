<?php

namespace App\Imports;

use App\Models\Survey;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSurvey implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   public $contents=[];
   public $logics=[];
   public $options=[];
    public $questions=[];
    public function question($index,$row){

        $numOfques=$row[$index];
    $i=1;
    while($numOfques >  count($this->questions)){
        $value =$row[$index + $i++];
        $this->questions[]=  [
            'name'=>str_replace(' ','-',$value),
            'label'=>$value,
        ];
    }
    
       }


   public function option($index,$row){

    $numOfOption=$row[$index];
$i=1;
while($numOfOption >  count($this->options)){
    $value =$row[$index + $i++];
    $this->options[]=  [
        'option'=>str_replace(' ','-',$value),
        'value'=>$value,
    ];
}

   }
   public function logic($index,$row){
    $i=$index;
    $len=count($row);
while($i< $len){
$this->logics[] = [
    'type'=>'skip',
    'name'=>$row[$i],
    'value'=>$row[$i+1],
];
$i += 2;
}

   }

   public function add_date($label,$required){
    return [
        'type'=>'date',
        "name"=> str_replace(' ','-',$label),
        "label"=> $label,
        "required"=> $required,
        "logics"=> $this->logics,
        "format"=> "YYYY-MM-DD",
    ];
   }
   public function add_date_picker($label,$min,$max,$required){
    return [
        'type'=>'date_picker',
        "name"=> str_replace(' ','-',$label),
        "label"=> $label,
        "min"=>$min,
        "max"=>$max,
        "required"=> $required,
        "logics"=> $this->logics,
       
    ];
   }
public function add_textbox_list($type,$label,$required){
    return [
        'type'=> $type,
        "name"=> str_replace(' ','-',$label),
        "label"=> $label,
        "question"=>$this->questions,
        "required"=> $required,
        "logics"=> $this->logics,
    ];
}
   public  function add_text($type,$label,$required){
    return [
    'type'=> $type,
    "name"=> str_replace(' ','-',$label),
    "label"=> $label,
    "required"=> $required,
    "logics"=> $this->logics,
   ];}
  
   public function add_radio($type,$label,$required){
    return [
        'type'=>$type,
        "name"=> str_replace(' ','-',$label),
        "label"=> $label,
        "options"=>$this->options,
        "required"=> $required,
        "logics"=> $this->logics,
       ];

   }
public function add_likert_grid($type,$label,$required){
    return [
        'type'=>$type,
        "name"=> str_replace(' ','-',$label),
        "label"=> $label,
        "question"=>$this->questions,
        "options"=>$this->options,
        "required"=> $required,
        "logics"=> $this->logics,
       ];  
}

public function add_slider_list($label,$row,$start,$required){
   
        return [
            'type'=>'slider_list',
            "name"=> str_replace(' ','-',$label),
            "label"=> $label,
            "min"=>$row[$start],
            "max"=>$row[$start + 1],
            "step"=>$row[$start + 2],
            "defalut"=>$row[$start +3 ],
            "label_min"=>$row[$start + 4],
            "label_max"=>$row[$start + 5],
            "label_mid"=>$row[$start + 6],
            "required"=> $required,
            "logics"=> $this->logics,
            "question"=>$this->questions,
        ];
}
public function add_slider($label,$row,$start,$required){
        return [
            'type'=>'slider',
            "name"=> str_replace(' ','-',$label),
            "label"=> $label,
            "min"=>$row[$start],
            "max"=>$row[$start + 1],
            "step"=>$row[$start + 2],
            "defalut"=>$row[$start +3 ],
            "label_min"=>$row[$start + 4],
            "label_max"=>$row[$start + 5],
            "label_mid"=>$row[$start + 6],
            "required"=> $required,
            "logics"=> $this->logics,
        ];
    
    
}
    public function model(array $row)
    {
        $type=$row[0];
        if($type=='text' || $type=='description'){

           if($row[2]== true){
          $this->logic(3,$row);
           }
            $this->contents[]= $this->add_text($type,$row[1],$row[2]);
       
            $this->logics=[];
        }
        
        
        elseif($type=='checkbox' || $type=='radio' || $type=='drag_and_drop_ranking' || $type == 'likert' || $type=='select' ){

           $this->option(2,$row);

$required=$row[3+$row[2]];
if($required== true){
    $this->logic($row[2]+4,$row);
}
            $this->contents[] = $this->add_radio($type,$row[1],$required);

            $this->logics=[];
            $this->options=[];
        }elseif($type=='likert_grid' || $type=='radio_grid' || $type=='checkbox_grid'){

            $this->question(2,$row);
           
            $this->option(3 + $row[2],$row);
            $numodquest =$row[2];
           $numOfOption=$row[3 + $row[2]];
            $reqindex= $numodquest + $numOfOption + 4;
if($row[$reqindex] == true){
    $this->logic($reqindex + 1 , $row);
}
            $this->contents[]= $this->add_likert_grid($type,$row[1],$row[$reqindex]);
            $this->questions=[];
            $this->options=[];
            $this->logics=[];

        }elseif($type=='slider_list'){
            $this->question(2,$row);
            $reqidx=10+ $row[2];
            $start=3+$row[2];
            if($row[$reqidx]== true){
                $this->logic($reqidx + 1,$row);
            }
$this->contents[]= $this->add_slider_list($row[1],$row,$start,$row[$reqidx]);
$this->questions=[];
$this->logics=[];
        }elseif($type == 'slider'){
            $required = $row[9];
            if($required ==true){
                $this->logic(10,$row);
            }
            $start=2;
            $this->contents[] = $this->add_slider_list($row[1],$row,$start, $required);
            $this->questions=[];
            $this->options=[];
            $this->logics=[];
        }elseif($type=='textbox_list' || $type== 'continuous_sum'){
            $this->question(2,$row);
            $required=$row[3+$row[2]];
            if($required == true){
                $this->logic(4+$row[2],$row); 
            }
            $this->contents[]=$this->add_textbox_list($type,$row[1],$required);
            $this->questions=[];
            $this->logics=[];
                }elseif($type=='date'){
                
                    $required=$row[2];
                    if($required == true){
                        $this->logic(3,$row);
                    }
                    $this->contents[]=$this->add_date($row[1],$required);
               
                    $this->logics=[];
                }elseif($type=='date_picker'){
                    $min=$row[2];
                    $max=$row[3];
                    $required=$row[4];
                    if($required == true){
                        $this->logic(5,$row);  
                    }
                    $this->contents[]=$this->add_date_picker($row[1],$min,$max,$required);
                   
                    $this->logics=[];
                }

                return null;

         return new Survey([
         'name'=> "surevy name1",
         'contents'=>json_encode($this->contents),
         ]);
    }
}
