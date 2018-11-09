<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
        protected $fillable = [
            'func_imagem', 'func_nome','func_CPF','func_RG','func_cartTrab',
            'func_cargo','func_dataNasc','func_end_cidade','func_end_estado',
            'func_end_bairro','func_end_rua','func_end_numero','func_end_complemento', 
            'func_end_logradouro','func_email','func_telefone','func_telefoneCel',
            'func_sexo','func_cargaHor',
        ];
        
        public $rules = [
            'func_nome' => "required|min:3|max:100",
            'func_CPF' => "required|min:14|max:14",
            'func_RG'  => "required",
            'func_cartTrab'=> "required",
            'func_cargo'=> "required",
            'func_dataNasc'=> "required|min:10|max:10",
            'func_end_cidade'=> "required",
            'func_end_estado'=> "required",
            'func_end_bairro'=> "required",
            'func_end_rua'=> "required",
            'func_end_numero'=>"required",            
            'func_end_logradouro' =>"required",
            'func_sexo'=>"required",
            'func_cargaHor'=>"required",
        ];
        
        public $rulesEdit = [
            'func_cargo'=> "required",            
            'func_end_cidade'=> "required",
            'func_end_estado'=> "required",
            'func_end_bairro'=> "required",
            'func_end_rua'=> "required",
            'func_end_numero'=>"required",            
            'func_end_logradouro' =>"required",            
            'func_cargaHor'=>"required",
        ];
        
 
        
}
