<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoCivilModelsTable extends Migration
{
    public function up()
    {
        Schema::create('estado_civil', function (Blueprint $table) {
            $table->id();
            $table->string('estado_civil');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estado_civil');
    }
}
