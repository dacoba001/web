<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
	//protected $primaryKey = 'id';
	protected $fillable = [
        'pro_nombre', 'pro_descripcion', 'pro_image', 'pro_codigo', 'tipo_id',
    ];
	
	function tipo(){
    	return $this->belongsTo('App\Tipo');
    }
}