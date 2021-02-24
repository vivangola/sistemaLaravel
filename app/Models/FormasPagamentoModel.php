<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormasPagamentoModel extends Model
{
    protected $table = 'formas_pagamento';
    protected $fillable = ['descricao'];
}
