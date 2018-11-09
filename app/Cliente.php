<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected $fillable = [
        'cliente_imagem', 'cliente_nome', 'cliente_CPF',
        'cliente_dataNasc', 'cliente_end_cidade', 'cliente_end_estado',
        'cliente_end_bairro', 'cliente_end_rua', 'cliente_end_numero', 'cliente_end_complemento',
        'cliente_end_logradouro', 'cliente_email', 'cliente_telefone', 'cliente_telefoneCel',
        'cliente_sexo'
    ];
    public $rules = [
        'cliente_nome' => "required|min:3|max:100",
        'cliente_CPF' => "required|min:14|max:14",
        'cliente_dataNasc' => "required|min:10|max:10",
        'cliente_end_cidade' => "required",
        'cliente_end_estado' => "required",
        'cliente_end_bairro' => "required",
        'cliente_end_rua' => "required",
        'cliente_end_numero' => "required",
        'cliente_end_logradouro' => "required",
        'cliente_sexo' => "required",
        'cliente_email' => "required"
    ];
    public $rulesEdit = [
        'cliente_end_cidade' => "required",
        'cliente_end_estado' => "required",
        'cliente_end_bairro' => "required",
        'cliente_end_rua' => "required",
        'cliente_end_numero' => "required",
        'cliente_end_logradouro' => "required",
        'cliente_email' => "required"
    ];

}
