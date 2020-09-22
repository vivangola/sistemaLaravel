<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentescoModelsTable extends Migration
{
    public function up()
    {
        Schema::create('parentescos', function (Blueprint $table) {
            $table->id();
            $table->string('parentesco');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parentescos');
    }
}
