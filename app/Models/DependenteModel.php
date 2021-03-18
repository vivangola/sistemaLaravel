<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Datetime;

class DependenteModel extends Model
{
    protected $table = 'dependentes';
    protected $fillable = ['cpf','nome','nascimento', 'parentesco_id', 'titular_id'];

    public function parentesco(){
        return $this->hasOne('App\Models\ParentescoModel', 'id', 'parentesco_id');
    }

    public function idade(){
        $date = new DateTime($this->nascimento);
        $interval = $date->diff(new DateTime(date('Y-m-d')));
        return $interval->format('%Y');;
    }

}
