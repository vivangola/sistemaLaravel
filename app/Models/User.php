<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuario';
    //protected $primaryKey = 'username';
    
    protected $fillable = [
        'username', 'password', 'tipo', 'fk_status', 'fk_funcionario',
    ];

    protected $hidden = [
        'password'
    ];

    public function funcionario(){
        return $this->hasOne('App\Models\FuncionarioModel', 'id', 'fk_funcionario');
    }

    public function status(){
        return $this->hasOne('App\Models\StatusModel', 'cod', 'fk_status');
    }

}
