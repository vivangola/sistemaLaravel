<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialModel extends Model
{
    protected $table = 'materiais';
    protected $fillable = ['material','modelo', 'tamanho', 'descricao', 'qtd_minima', 'estoque', 'categoria_id'];
}
