<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmprestimoModel extends Model
{
    protected $table = 'emprestimos';
    protected $fillable = ['quantidade','material_id','conta_id','data_devolucao'];

    public function conta(){
        return $this->hasOne('App\Models\ContaModel', 'id', 'conta_id');
    }

    public function material(){
        return $this->hasOne('App\Models\MaterialModel', 'id', 'material_id');
    }

}
