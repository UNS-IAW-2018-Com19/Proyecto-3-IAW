<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJugadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('jugadores', function (Blueprint $table) {
            $table->integer('id_jugador');
            $table->string('userName');
            $table->integer('id_equipo');
            $table->string('personaje');
            $table->string('fotopersonaje');
            $table->string('avatar');
            $table->string('json');
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
        Schema::connection("mongodb")->dropIfExists('jugadores');
    }
}
