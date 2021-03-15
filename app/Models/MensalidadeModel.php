<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensalidadeModel extends Model
{
    protected $table = 'mensalidades';
    protected $fillable = ['data_pagamento'];

    public function conta(){
        return $this->belongsTo('App\Models\ContaModel', 'conta_id', 'id');
    }
}
