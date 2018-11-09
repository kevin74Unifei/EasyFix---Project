<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;

class Vaga extends Model
{
    protected $fillable = [
        'vag_id','vag_nome','vag_tipoPag','vag_valorPag','vag_escolar',
        'vag_idioma','vag_estado','vag_regime','vag_dias',
        'vag_horario','vag_beneficios', 'vag_email',
        'vag_telefone','vag_telefoneCel', 'vag_nomeEmpresa','vag_empresa_cod',
        'created_at',
    ];
    
    public $rules = [
            'vag_nome' => "required|min:3|max:100",
            'vag_tipoPag'=>'required|max:100',
            'vag_valorPag'=>'required',
            'vag_escolar'=>'required',
            'vag_idioma'=>'required',
            'vag_estado'=>'required',
            'vag_regime'=> "required",
            'vag_dias'=> "required",
            'vag_horario'=> "required",
            'vag_beneficios'=> "required",
            'vag_email'=>'required',
            'vag_telefone'=>'required',
            'vag_nomeEmpresa'=>'required'
            
    ];
        
    public $rulesEdit = [           
            'vag_nome' => "required",
            'vag_tipoPag'=>'required',
            'vag_valorPag'=>'required',
            'vag_escolar'=>'required',
            'vag_idioma'=>'required',
            'vag_estado'=>'required',
            'vag_regime'=> "required",
            'vag_dias'=> "required",
            'vag_horario'=> "required",
            'vag_beneficios'=> "required",
            'vag_email'=>'required',
            'vag_telefone'=>'required'
    ];
    
    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }
}

