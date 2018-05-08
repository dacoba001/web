<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockMoveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_moves', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->integer('cantidad_move');
            $table->integer('cantidad_stock');
            $table->integer('detallepedidos_id')->nullable()->unsigned();
            $table->foreign('detallepedidos_id')->references('id')->on('detallepedidos')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('stock_id')->unsigned();
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stock_moves');
    }
}
