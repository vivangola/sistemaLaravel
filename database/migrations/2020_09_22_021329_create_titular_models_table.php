<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitularModelsTable extends Migration
{

    public function up()
    {
        Schema::create('titulares', function (Blueprint $table) {
            $table->id();
            $table->string('cpf');
            $table->string('rg');
            $table->string('nome');
            $table->string('sexo');
            $table->string('telefone');
            $table->string('email');
            $table->foreignId('estado_civil_id')->constrained('estado_civil')->onDelete('cascade')->onUpdate('cascade');
            $table->string('endereco');
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado_uf');
            $table->foreign('estado_uf')->references('uf')->on('estados')->onDelete('cascade')->onUpdate('cascade');
            $table->string('cep');
            $table->date('nascimento');
            $table->foreignId('conta_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('titulares');
    }
}
