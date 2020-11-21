<?php

namespace App;
use App\Ruta;

use Illuminate\Database\Eloquent\Model;

class coordenada extends Model
{
    protected $fillable = [
        'id', 'ruta_id', 'latitud', 'longitud', 'created_at',
    ];
    protected $table = 'coordenadas';

    public function ruta(){
        return $this->belongsTo(Ruta::class, 'ruta_id');
    }
}