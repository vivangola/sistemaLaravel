<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DependenteModel extends Model
{
    protected $table = 'dependentes';
    protected $fillable = ['cpf','nome','nascimento', 'parentesco', 'titular_id'];
}
