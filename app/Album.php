<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {

    public $table='prestador_album';

    protected $primaryKey = 'album_id';
    protected $fillable = [
        'album_id', 'prestador_id', 'path', 'title', 'descr'
    ];
    
    public $rules = [
        'title' => "required|min:3|max:100",
        'path' => "required",
    ];

}
