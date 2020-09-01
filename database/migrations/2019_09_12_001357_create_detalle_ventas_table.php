<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('idventa')->nullable();
            $table->unsignedBigInteger('idcliente');
            $table->unsignedBigInteger('idproducto');
            // $table->string('fecha')->nullable();
            $table->string('precio_u');
            $table->string('cantidad');
            $table->string('subtotal');
            $table->string('estado_del','1')->default('1');
            $table->string('nome_token');
            $table->timestamps();

            $table->foreign('idventa')->references('id')->on('ventas');
            $table->foreign('idcliente')->references('id')->on('users');
            $table->foreign('idproducto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ventas');
    }
}
