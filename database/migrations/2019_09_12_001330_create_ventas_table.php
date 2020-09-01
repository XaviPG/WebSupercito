<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('idestado');
            $table->unsignedBigInteger('idcliente');
            $table->unsignedBigInteger('idcourier')->nullable();

            $table->string('fecha');
            $table->string('fecha_f')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();

            $table->string('estado_del','1')->default('1');

            $table->string('ubicacion_descripcion')->nullable();
            $table->string('ubicacion_latitud')->nullable();
            $table->string('ubicacion_longitud')->nullable();

            $table->string('nome_token');
            $table->timestamps();

            $table->foreign('idestado')->references('id')->on('estado_ventas');
            $table->foreign('idcliente')->references('id')->on('users');
            $table->foreign('idcourier')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
