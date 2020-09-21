<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idtipo')->default('4');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cedula','10');
            $table->string('celular','20');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('direccion');
            $table->string('referencia')->nullable();
            $table->string('imagen')->nullable();
            $table->string('password');
            $table->string('password2');
            $table->string('estado_del','1')->default('1');
            $table->string('nome_token');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
