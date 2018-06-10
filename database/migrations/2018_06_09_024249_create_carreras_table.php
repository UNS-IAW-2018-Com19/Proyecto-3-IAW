<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrerasTable extends Migration
{
    /**
     * 
     * 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->integer('id_carrera');
            $table->integer('fecha');
            $table->string('mapa');
            $table->string('fotoMapa');
            $table->string('vueltas');
            $table->array('posiciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::connection("mongodb")->dropIfExists('carreras');
    }
}
