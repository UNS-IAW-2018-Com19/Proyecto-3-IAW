<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Jugador extends Eloquent{

    protected $connection = 'mongodb';
    protected $collection = 'jugadores';
    protected $primaryKey = 'id_jugador';

    protected $foreign_key = 'id_equipo';
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_jugador', 'userName', 'personaje', 'fotopersonaje', 'avatar',
    ];

    protected $hidden = [
        'nombre',
    ];

    public function get_equipo(){
          return $this->belongsTo('App\Equipo', 'id_equipo', 'id_equipo');
    }
}
