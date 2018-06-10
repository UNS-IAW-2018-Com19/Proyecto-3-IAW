<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Equipo extends Eloquent{

    protected $connection = 'mongodb';
    protected $collection = 'equipos';
    protected $primaryKey = 'id_equipo';
    
    protected $foreign_key = 'id_equipo';

    public function get_jugadores(){
        return $this->hasMany('App\Jugador', 'id_equipo', 'id_equipo');
    }
}
