<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_foraneo');
            $table->string('NAME')->nullable();
            $table->string('PRICE')->nullable(); //longText
            $table->string('IDBRAND')->nullable();
            $table->string('MARCA')->nullable();
            $table->string('PESOITEM')->nullable();
            $table->string('stock')->nullable();
            $table->string('estado_del','1')->default('1');
            
            $table->string('file_name')->nullable();
            $table->string('file_extension')->nullable();
            $table->string('file_ruta')->nullable();
           
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
        Schema::dropIfExists('productos');
    }
}
