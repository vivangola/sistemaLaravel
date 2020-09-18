<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanoModel extends Model
{
    protected $table = 'planos';
    protected $fillable = ['plano', 'mensalidade', 'carencia', 'dependentes', 'tipo_status_id'];
}
