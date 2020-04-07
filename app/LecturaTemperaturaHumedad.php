<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LecturaTemperaturaHumedad extends Model
{
    protected $table = 'lecturas_temperatura_humedad';

    protected $fillable = [
        'lectura_temperatura','lectura_humedad','proximity_back','proximity_front','lectura_fecha'
    ];

}
