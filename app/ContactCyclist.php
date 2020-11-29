<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactCyclist extends Model
{
    //
    protected $fillable = [
        'id_cyclist', 'id_contact'
    ];
    
    protected $table = 'contact_cyclist';
}
