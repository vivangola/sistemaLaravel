<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmprestimoModelsTable extends Migration
{
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantidade');
            $table->foreignId('conta_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('material_id')->constrained('materiais')->onDelete('cascade')->onUpdate('cascade');
            $table->date('data_devolucao')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emprestimos');
    }
}
