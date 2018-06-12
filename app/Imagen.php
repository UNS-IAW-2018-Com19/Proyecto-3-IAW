<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Imagen extends Eloquent{

    protected $connection = 'mongodb';
    protected $collection = 'imagenes';
    protected $primaryKey = 'nombre';

}
