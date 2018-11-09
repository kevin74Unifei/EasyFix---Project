<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = [
        'cand_cod','cand_imagem','cand_nome','cand_CPF','cand_dataNasc',
        'cand_end_cidade','cand_end_estado','cand_end_bairro','cand_end_rua',
        'cand_end_numero','cand_end_complemento','cand_end_logradouro','cand_email',
        'cand_telefone','cand_telefoneCel','cand_sexo','cand_status',   
    ];
    
       public $rules = [
            'cand_nome' => "required|min:3|max:100",
            'cand_CPF' => "required|min:14|max:14",
            'cand_dataNasc'=> "required|min:10|max:10",
            'cand_end_cidade'=> "required",
            'cand_end_estado'=> "required",
            'cand_end_bairro'=> "required",
            'cand_end_rua'=> "required",
            'cand_end_numero'=>"required",            
            'cand_end_logradouro' =>"required",
            'cand_sexo'=>"required",
            'cand_email'=>"required"
        ];
        
        public $rulesEdit = [           
            'cand_end_cidade'=> "required",
            'cand_end_estado'=> "required",
            'cand_end_bairro'=> "required",
            'cand_end_rua'=> "required",
            'cand_end_numero'=>"required",            
            'cand_end_logradouro' =>"required", 
            'cand_email'=>"required"
        ];
}
