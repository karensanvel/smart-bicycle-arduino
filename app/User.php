<?php

namespace App;

use App\NumeroSerie;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    //use LaratrustUserTrait;
    use Notifiable;

    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idNumero','name', 'username', 'password', 'email_contact'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
    ];


    public function numero(){
        return $this->belongsTo(NumeroSerie::class, 'idNumero');
    }
    public function getNumber($id)
    {
        $numero = NumeroSerie::where('id', $id)->get();
        return $numero;
    }
}
