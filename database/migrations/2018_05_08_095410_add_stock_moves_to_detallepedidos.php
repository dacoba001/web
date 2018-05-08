<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStockMovesToDetallepedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('importacions', function (Blueprint $table) {
            $table->integer('stock_moves_id')->nullable()->unsigned();
            $table->foreign('stock_moves_id')->references('id')->on('stock_moves')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('importacions', function (Blueprint $table) {
            $table->dropForeign(['stock_moves_id']);
            $table->dropColumn(['stock_moves_id']);
        });
    }
}
