<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsEstimacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets_estimacaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('especie');
            $table->float('peso');
            $table->string('pelagem');
            $table->integer('sexo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets_estimacaos');
    }
}
