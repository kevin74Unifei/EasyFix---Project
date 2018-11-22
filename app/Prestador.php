<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestador extends Model {

    protected $fillable = [
        'prestador_nome', 'prestador_vinculo',
        'prestador_tipo', 'prestador_representacao', 'prestador_descricao'
    ];
    public $rules = [
        //'prestador_nome' => "required|min:3|max:100",
        'prestador_tipo' => "required",
        'prestador_representacao' => "required",
        'prestador_descricao' => "required"
    ];
    public $rulesEdit = [
        'prestador_tipo' => "required",
        'prestador_descricao' => "required"
    ];

}
