<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DependenteModel extends Model
{
    protected $table = 'dependentes';
    protected $fillable = ['cpf','nome','nascimento', 'parentesco_id', 'titular_id'];

    public function parentesco(){
        return $this->hasOne('App\Models\ParentescoModel', 'id', 'parentesco_id');
    }

}
