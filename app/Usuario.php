<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	protected $table = 'users';
	//protected $primaryKey = 'id';
	protected $fillable = [
        'nombre', 'nombredeusuario', 'appaterno', 'apmaterno', 'fecha_nac', 'telefono', 'email', 'password', 'tipo_cuenta',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
