<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependenteModelsTable extends Migration
{
    
    public function up()
    {
        Schema::create('dependentes', function (Blueprint $table) {
            $table->id();
            $table->string('cpf');
            //$table->string('rg')->nullable();
            $table->string('nome');
            //$table->string('sexo')->nullable();
            $table->date('nascimento');
            $table->foreignId('parentesco_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('titular_id')->constrained('titulares')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dependentes');
    }
}
