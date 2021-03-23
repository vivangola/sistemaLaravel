<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MensalidadeModel;
use DateTime;
use DateInterval;

class ContaModel extends Model
{
    protected $table = 'contas';
    protected $fillable = ['plano_id','tipo_status_id'];
    
    public function contasAtivas($id = null){
        if($id){
            return $this->where('id',$id)->where('tipo_status_id','<>',0);
        }else{
            return $this->all()->where('tipo_status_id','<>',0);
        }
    }

    public function titular(){
        return $this->hasOne('App\Models\TitularModel', 'conta_id', 'id');
    }

    public function status(){
        return $this->hasOne('App\Models\StatusModel', 'id', 'tipo_status_id');
    }

    public function plano(){
        return $this->hasOne('App\Models\PlanoModel', 'id', 'plano_id');
    }

    public function mensalidades(){
        return $this->hasMany('App\Models\MensalidadeModel', 'conta_id', 'id');
    }

    public function mensalidadesDebito(){
        return $this->hasMany('App\Models\MensalidadeModel', 'conta_id', 'id')->where('data_pagamento', null);
    }

    public function inativar(){
        $this->update([
            'tipo_status_id' => 0,
        ]);  
        $date = new DateTime(date('Y-m-d'));
        $date->sub(new DateInterval('P3M'));
        $mensalidades = new MensalidadeModel;
        $mensalidades = $mensalidades->where('created_at','<', $date->format('Y-m-'.'01'))->where('data_pagamento', null);
        $mensalidades->update([
            'data_pagamento' => '1900-01-01'
        ]);
    }

}
