<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentoEstoqueModel extends Model
{
    protected $table = 'movimento_estoque';
    protected $fillable = ['operacao','tipo', 'observacao', 'material_id'];
}
