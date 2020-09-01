<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocionDelProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocion_del_productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idProducto');
            $table->integer('descuento')->nullable();
            $table->integer('stock');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->string('estado_del')->nullable();
          
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
        Schema::dropIfExists('promocion_del_productos');
    }
}
