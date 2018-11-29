<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model {

    public $table='prestador_album';

    protected $fillable = [
        'album_id', 'prestador_id', 'path'
    ];

}
