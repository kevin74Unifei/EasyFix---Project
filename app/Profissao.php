<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profissao extends Model
{
    protected $fillable = ['id','profissao'];
    protected $table = 'TB_Profissoes';
    
    public function curriculo(){
        $this->morphMany(Profissao::class,'curr_obj');
    }
}
