<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaModel extends Model
{
    protected $table = 'contas';
    protected $fillable = ['titular_id','plano_id','tipo_status_id'];
}
