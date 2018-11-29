<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
   
    protected $fillable = [
        'ent_cod','ent_tipo_prof','ent_data_inicial','ent_data_final','ent_cod_pres', 'ent_cod_clie', 'ent_status'
    ];
    
       public $rules = [
            'ent_data_inicial' => "required",
            'ent_data_final'=>'required',
            'ent_tipo_prof'=>'required',
             
        ];
        
        public $rulesEdit = [           
            'ent_data_inicial' => "required",
            'ent_data_final'=>'required',
        ];
}
