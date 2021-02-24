<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensalidadeModel extends Model
{
    protected $table = 'mensalidades';
    protected $fillable = ['data_pagamento'];

    
    public function conta(){
        return $this->hasOne('App\Models\ContaModel', 'id', 'conta_id');
    }
}
