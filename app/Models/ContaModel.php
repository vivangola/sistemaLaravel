<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaModel extends Model
{
    protected $table = 'contas';
    protected $fillable = ['plano_id','tipo_status_id'];

    public function titular(){
        return $this->hasOne('App\Models\TitularModel', 'conta_id', 'id');
    }

    public function status(){
        return $this->hasOne('App\Models\StatusModel', 'id', 'tipo_status_id');
    }

    public function plano(){
        return $this->hasOne('App\Models\PlanoModel', 'id', 'plano_id');
    }

}
