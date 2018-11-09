<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrExperiencia extends Model
{
    protected $table = 'currexperiencias';
    protected $fillable = [
        'curr_nomeEmpresa','curr_cargo','curr_dataInicioExp','curr_dataSaidaExp','curr_descExp','curr_cod'  
    ];
}
