<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroPromocionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_promociones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idTipoPromocion');
            $table->string('descripcion');
            $table->integer('descuento')->nullable();
            $table->Integer('cantidad');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('estado_del','1')->default('1');
            $table->Integer('publicado')->nullable();
            $table->timestamps();
            $table->foreign('idTipoPromocion')->references('id')->on('tipo_promocions');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_promociones');
    }
}
