<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idestado');
            $table->unsignedBigInteger('idcourier')->nullable();
            $table->unsignedBigInteger('idTipoPago');
            $table->string('Orden');
            $table->date('fechaOrden');
            $table->string('total')->nullable();
            $table->string('finalizado','0')->default('0');
            $table->string('rechazado','0')->default('0');
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('estado_del','1')->default('1');
            $table->timestamps();
            $table->longtext('comprobante')->nullable();
            $table->string('nombre_img')->nullable();

            $table->foreign('idestado')->references('id')->on('estado_ventas');
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idcourier')->references('id')->on('users');
          $table->foreign('idTipoPago')->references('id')->on('tipo_pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordens');
    }
}
