<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idPromocionProducto')->nullable();
            $table->unsignedBigInteger('idRegistros')->nullable();
            $table->unsignedBigInteger('id_Productos')->nullable();
            $table->unsignedBigInteger('idOrdenar');
            $table->Integer('cantidad');
            $table->timestamps();
            
           
            $table->foreign('idPromocionProducto')->references('id')->on('promocion_del_productos');
            $table->foreign('idRegistros')->references('id')->on('registro_promociones');
            $table->foreign('id_Productos')->references('id')->on('productos');
            $table->foreign('idOrdenar')->references('id')->on('ordens');

           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
