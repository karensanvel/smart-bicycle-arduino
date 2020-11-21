<?php

namespace App;
use App\Coordenada;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $table = 'rutas';

    public function coordenadas(){
        return $this->hasMany(Coordenada::class, 'ruta_id');
    }
}
