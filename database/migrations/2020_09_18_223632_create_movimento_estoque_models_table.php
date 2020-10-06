<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentoEstoqueModelsTable extends Migration
{
    
    public function up()
    {
        Schema::create('movimento_estoque', function (Blueprint $table) {
            $table->id();
            $table->string('operacao');
            $table->string('tipo');
            $table->string('observacao')->nullable();
            $table->foreignId('material_id')->constrained('materiais')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('movimento_estoque');
    }
}
