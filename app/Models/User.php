<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuarios';
    
    protected $fillable = [
        'username', 'password', 'tipo', 'tipo_status_id', 'funcionario_id',
    ];

    protected $hidden = [
        'password'
    ];

    public function funcionario(){
        return $this->hasOne('App\Models\FuncionarioModel', 'id', 'funcionario_id');
    }

    public function status(){
        return $this->hasOne('App\Models\StatusModel', 'id', 'tipo_status_id');
    }

}
