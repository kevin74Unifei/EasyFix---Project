<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CurrExperiencia;

class Curriculo extends Model
{
     protected $fillable = [        
        'curr_idiomas','curr_extra','curr_dataEmit','curr_active',
         'cand_cod','curr_obj_id','curr_obj_type'  
     ];
     
     public function curr_obj(){         

          $r = $this->hasMany(Profissao::class,'id','curr_obj_id')->get()->first();          
          if(isset($r['id'])){
             return $r; 
          }
     }
     
     public function experienciaProfissionais(){
         return $this->hasOne(CurrExperiencia::class);
     }
}
