<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $ignorar = array("/", ".", "$");

        DB::table('tipo_usuarios')->insert([
            'cod' => '001',
            'descripcion' => 'Admin',
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        ]);
        // DB::table('tipo_usuarios')->insert([
        //     'cod' => '002',
        //     'descripcion' => 'Farmaceutico',
        //     'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        // ]);
        DB::table('tipo_usuarios')->insert([
            'cod' => '002',
            'descripcion' => 'Courier',
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        ]);
        DB::table('tipo_usuarios')->insert([
            'cod' => '003',
            'descripcion' => 'Cliente',
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        ]);
        //usuarios        $ignorar = array("/", ".", "$");
        //usuarios
        DB::table('users')->insert([
            'idtipo'  =>  '1',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'cedula' => '0000000000',
            'celular' => '0000000000',
            'direccion' => 'Arrastradero',
            'referencia' => 'Diagonal al colegio Francisco',
            'password' => bcrypt('adminadmin'),
            'password2' => 'adminadmin',
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        ]);

        DB::table('users')->insert([
            'idtipo'  =>  '2',
            'name' => 'courier',
            'email' => 'courier@courier.com',
            'cedula' => '0000000003',
            'celular' => '0000000003',
            'direccion' => 'Arrastradero',
            'password' => bcrypt('courier'),
            'password2' => 'courier',
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        ]);

        DB::table('users')->insert([
            'idtipo'  =>  '3',
            'name' => 'client',
            'email' => 'client@client.com',
            'cedula' => '0000000004',
            'celular' => '0000000004',
            'direccion' => 'Arrastradero',
            'password' => bcrypt('client'),
            'password2' => 'client',
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        ]);

        DB::table('estado_ventas')->insert([
            'cod' => '001',
            'descripcion' => 'Solicitado',
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        ]);
        DB::table('estado_ventas')->insert([
            'cod' => '002',
            'descripcion' => 'En proceso',
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        ]);
        DB::table('estado_ventas')->insert([
            'cod' => '003',
            'descripcion' => 'Finalizado',
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        ]);

        DB::table('estado_ventas')->insert([
            'cod' => '004',
            'descripcion' => 'Rechazado',
            'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        ]);

        // DB::table('estado_ventas')->insert([
        //     'cod' => '005',
        //     'descripcion' => 'Aceptado',
        //     'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        // ]);

        // DB::table('estado_ventas')->insert([
        //     'cod' => '005',
        //     'descripcion' => 'Cancelado',
        //     'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),
        // ]);
        DB::table('tipo_pagos')->insert([
            'identificador' => '1',
            'descricion' => 'Transferencia',
        ]);
        DB::table('tipo_pagos')->insert([
            'identificador' => '2',
            'descricion' => 'En efectivo',
        ]);
     
        // DB::table('ordens')->insert([
        //     'idUsuario' => '3',
        //     'idestado' => '1',
        //     'idcourier' => '2',
        //     'idTipoPago' => '1',
        //     'Orden' => 'super-orden-000000000000001',
        //     'fechaOrden' => '2020-05-09',
        //     'total' => '2',
        //     'finalizado' => '0',
        //     'latitud' => '-0.843633',
        //     'longitud' => '-80.16894599999999',
          
        // ]);

        DB::table('notificacions')->insert([
            'idusuario' => '1',
            'mensaje' => 'Hola',
            'estado_del' => '1',
        ]);


        // DB::table('productos')->insert([
        //     'id_foraneo'          => '4',
        //     'cod_barra'           => '7730698316062',
        //     'cod_barra_alterno'   => '7861148020977',
        //     'codigo_alterno_1'    => '1901',
        //     'codigo_alterno_2'    => '00006',
        //     'descripcion'         => 'ATLANSIL COMx200MGx20',
        //     'descripcion_larga'   => 'ATLANSIL COMx200MGx20',
        //     'precio'              => '9.4000',
        //     'observacion'         => 'MOLECULA: AMIODARONA CLORHIDRATO DE',
        //     'marca'               => 'ATLANSIL',
        //     'presentacion'        => 'COM',
        //     'medida'              => '',
        //     'concentracion'       => 'G076',
        //     'stock_unidad'        => '1',
        //     'stock_fraccion'      => '5',
        //     'num_fraccion'        => '20',
        //     'estado_item_bodega'  => 'ACTIVO GENERAL',
        //     'cantidad'            => '1',
        //     'estado_del'          => '1',
        //     'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),

        // ]);
        // DB::table('productos')->insert([
        //     'id_foraneo'          => '10',
        //     'cod_barra'           => '7861021605000',
        //     'cod_barra_alterno'   => '7861021605000',
        //     'codigo_alterno_1'    => '8272',
        //     'codigo_alterno_2'    => '00006',
        //     'descripcion'         => 'GAMALATE GRAx100MGx20',
        //     'descripcion_larga'   => 'GAMALATE GRAx100MGx20',
        //     'precio'              => '8.0000',
        //     'observacion'         => 'MOLECULA: BROMHIDRATO DEL GLUTAMATO DE MAGNESIO+ACIDO GAMMA+VITA-B6',
        //     'marca'               => 'GAMALATE',
        //     'presentacion'        => 'GRA',
        //     'medida'              => 'MG02',
        //     'concentracion'       => 'G007',
        //     'stock_unidad'        => '3',
        //     'stock_fraccion'      => '12',
        //     'num_fraccion'        => '20',
        //     'estado_item_bodega'  => 'ACTIVO GENERAL',
        //     'cantidad'            => '3',
        //     'estado_del'          => '1',
        //     'nome_token' => str_replace($ignorar,"",bcrypt(Str::random(10))),

        // ]);


    }

}
