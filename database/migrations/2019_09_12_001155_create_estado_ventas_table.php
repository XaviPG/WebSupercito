<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cod','3');
            $table->string('descripcion');
            $table->string('estado_del','1')->default('1');
            $table->string('nome_token');
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
        Schema::dropIfExists('estado_ventas');
    }
}
