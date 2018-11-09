<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'username', 'user_perfil', 'password','user_vinculo','user_imagem','user_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $rules = [
        'username' => "required|min:5|max:40",
        'password' => "required|min:7|max:24",
        'user_perfil' => "required",
    ];
    
    public $rulesEdit = [
        'password' => "required",
        ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

}
