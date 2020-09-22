<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialModelsTable extends Migration
{

    public function up()
    {
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->string('material');
            $table->string('modelo')->nullable();
            $table->string('tamanho')->nullable();
            $table->string('descricao')->nullable();
            $table->integer('qtd_minima');
            $table->integer('estoque');
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materiais');
    }
}
