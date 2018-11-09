<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrFormacao extends Model
{
    protected $table ='currformacaos';
    protected $fillable = [
        'curr_nomeInst','curr_curso','curr_situacaoCurso','curr_dataForm','curr_cod' 
    ];
}
