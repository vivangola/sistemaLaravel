<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Datetime;

class TitularModel extends Model
{
    protected $table = 'titulares';
    protected $fillable = ['cpf','rg','nome','sexo','telefone','email','estado_civil_id','endereco','numero','bairro','cidade','estado_uf','cep','nascimento','conta_id'];

    public function conta(){
        return $this->belongsTo('App\Models\ContaModel', 'conta_id', 'id');
    }

    public function dependentes(){
        return $this->hasMany('App\Models\DependenteModel', 'titular_id', 'id');
    }

    public function idade(){
        $date = new DateTime($this->nascimento);
        $interval = $date->diff(new DateTime(date('Y-m-d')));
        return $interval->format('%Y');;
    }

}
