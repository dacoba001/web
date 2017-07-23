<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
	protected $fillable = [
        'stk_cantidad', 'stk_precio', 'stk_cantmin', 'producto_id',
    ];
    function producto(){
    	return $this->belongsTo('App\Producto');
    }
}
