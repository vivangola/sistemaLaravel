<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObitoModel extends Model
{
    protected $table = 'obitos';
    protected $fillable = ['conta_id','cpf_falecido','local_falecimento','data_falecimento','local_velorio','data_velorio','local_enterro','data_enterro'];

    public function conta(){
        return $this->hasOne('App\Models\ContaModel', 'id', 'conta_id');
    }

    public function falecido(){
        $falecido = $this->conta->titular->where('cpf',$this->cpf_falecido)->first();
        if(!$falecido){
            $falecido = $this->conta->titular->dependentes->where('cpf',$this->cpf_falecido)->first();
        }
        return $falecido;
    }

}
