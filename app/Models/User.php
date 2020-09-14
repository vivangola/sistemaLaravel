<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuario';
    protected $primaryKey = 'login';
    
    protected $fillable = [
        'login', 'senha',
    ];

    protected $hidden = [
        'senha'
    ];

    public function relBooks(){
        return $this->hasMany('App\Models\ModelBook', 'id_user');
    }
}
