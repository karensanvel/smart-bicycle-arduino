<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class NumeroSerie extends Model
{
    protected $table = 'numero_serie';

    protected $fillable = [
        'numero'
    ];
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
}
