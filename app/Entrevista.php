<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    protected $fillable = [
        'ent_cod','ent_entrevistado','ent_entrevistador','ent_data','ent_horario',
        'ent_end_cidade','ent_end_estado','ent_end_bairro','ent_end_rua',
        'ent_end_numero','ent_end_complemento','ent_end_logradouro','ent_status',
        'ent_empresa','ent_obs'
    ];
    
       public $rules = [
            'ent_entrevistado' => "required|min:3|max:100",
            'ent_entrevistador'=>'required|min:3|max:100',
            'ent_data'=>'required',
            'ent_empresa'=>'required',
            'ent_horario'=>'required',
            'ent_end_cidade'=> "required",
            'ent_end_estado'=> "required",
            'ent_end_bairro'=> "required",
            'ent_end_rua'=> "required",
            'ent_end_numero'=>"required", 
        ];
        
        public $rulesEdit = [           
            'ent_end_cidade'=> "required",
            'ent_end_estado'=> "required",
            'ent_end_bairro'=> "required",
            'ent_end_rua'=> "required",
            'ent_end_numero'=>"required",            
            'ent_end_logradouro' =>"required"
        ];
}
