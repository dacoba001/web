<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEntregadoAndDevueltoToPedidos extends Migration
{
    public function up()
    {
        Schema::table('detallepedidos', function (Blueprint $table) {
            $table->integer('ped_cantidad_entregado');
            $table->integer('ped_cantidad_devuelto');
        });
    }

    public function down()
    {
        Schema::table('detallepedidos', function (Blueprint $table) {
            $table->integer('ped_cantidad_entregado');
            $table->integer('ped_cantidad_devuelto');
        });
    }
}
