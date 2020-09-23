<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContaModelsTable extends Migration
{

    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_status_id')->constrained('tipo_status')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('plano_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contas');
    }
}
