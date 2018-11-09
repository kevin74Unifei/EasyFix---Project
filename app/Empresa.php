<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
     protected $fillable = [
        'emp_cod','emp_nome','emp_CNPJ','emp_inscricaEst','emp_razao',
        'emp_end_cidade','emp_end_estado','emp_end_bairro','emp_end_rua',
        'emp_end_numero','emp_end_complemento','emp_end_logradouro','emp_email',
        'emp_telefone','emp_telefoneCel','emp_status',   
    ];
    
       public $rules = [
            'emp_nome' => "required|min:3|max:100",
            'emp_razao'=>'required|min:3|max:100',
            'emp_CNPJ'=>'required|min:18|max:18',
            'emp_inscricaEst'=>'required|min:11|max:15',
            'emp_email'=>'required',
            'emp_telefone'=>'required',
            'emp_end_cidade'=> "required",
            'emp_end_estado'=> "required",
            'emp_end_bairro'=> "required",
            'emp_end_rua'=> "required",
            'emp_end_numero'=>"required", 
        ];
        
        public $rulesEdit = [           
            'emp_end_cidade'=> "required",
            'emp_end_estado'=> "required",
            'emp_end_bairro'=> "required",
            'emp_end_rua'=> "required",
            'emp_end_numero'=>"required",            
            'emp_end_logradouro' =>"required", 
            'emp_email'=>"required"
        ];
}
