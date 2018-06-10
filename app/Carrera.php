<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Carrera extends Eloquent{

    protected $connection = 'mongodb';
    protected $collection = 'carreras';
    protected $primaryKey = 'id_carrera';

    protected $foreign_key = 'id_jugador';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_carrera', 'fecha', 'mapa', 'fotoMapa', 'vueltas', 'posiciones',
    ];

}
