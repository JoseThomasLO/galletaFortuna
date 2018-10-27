<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    /**
     * Campos de la galleta que están autorizados a ser manipulados por el usuario.
     */
    protected $fillable = [
        'message'
    ];
}
