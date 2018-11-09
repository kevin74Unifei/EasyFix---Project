<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
        protected $fillable = [
            
            'pag_id', 'pag_empresa_cod','pag_tipoPag','pag_valorPag','pag_desconto',
            'pag_valorTotal','pag_situacao'
        ];
        
        public $rules = [            
            'pag_empresa_cod'=>"required",
            'pag_tipoPag'=>"required",
            'pag_valorPag'=>"required",
            'pag_desconto'=>"required",            
        ];
        
        public $rulesEdit = [         
            'pag_tipoPag'=>"required",
            'pag_valorPag'=>"required",
            'pag_desconto'=>"required",            
        ];
        
 
        
}