<?php

namespace App\Http\Controllers;

use App\Venta;
use App\DetalleVenta;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use App\Producto;
class DetalleVentaController extends Controller
{

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($nome_token_user,Request $request)
    {

        $ignorar = array("/", ".", "$");

        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

              try {

                $code = '200';
                $message = 'OK';

                $items = DetalleVenta::with('producto')->where([['estado_del','1'],['idventa',null],['idcliente',$validad->id],['idproducto',$request->idproducto]])->first();
                $producto = Producto::where('id',$request->idproducto)->first();


                if (empty($items['idproducto'])) {
                    $items = new DetalleVenta();
                    $items->idcliente = $validad->id; //idcliente //
                    $items->idproducto = $request->idproducto; //se necesita
                    // $items->fecha = $request->fecha;
                    $items->precio_u = $producto->precio;
                    $items->cantidad = $request->cantidad; //se necesita
                    $items->subtotal = $producto->precio*$request->cantidad;
                    // for ($i=0; $i < $request->cantidad; $i++) {
                    //   $items->subtotal+=$producto->precio;
                    // }
                    $items->estado_del = '1';
                    $items->nome_token = str_replace($ignorar,"",bcrypt(Str::random(10)));
                    $items->save();

                    $items = DetalleVenta::with('producto')->where('id',$items->id)->first();
                }else{
                    $cantidadTotal = ($request->cantidad+$items->cantidad);

                    $items->cantidad = $cantidadTotal;
                    $items->precio_u = $producto->precio;
                    $items->subtotal = $producto->precio*$cantidadTotal;
                    $items->update();
                }



                // if (empty($items['idventa']) ){



                //   // return response()->json('no existe todavia');
                //   $items = new DetalleVenta();
                //   // $items->idventa = $request->idventa;  //se necesita
                //   $items->idcliente = $validad->id; //idcliente //
                //   $items->idproducto = $request->idproducto; //se necesita
                //   // $producto = Producto::find($request->idproducto);
                //   // $items->fecha = $request->fecha;
                //   $items->precio_u = $producto->precio;
                //   $items->cantidad = $request->cantidad; //se necesita
                //   $items->subtotal = $producto->precio*$request->cantidad;
                //   $items->estado_del = '1';
                //   $items->nome_token = str_replace($ignorar,"",bcrypt(Str::random(10)));
                //   $items->save();

                //   $items = DetalleVenta::with('producto')->where('id',$items->id)->first();

                //   // $producto->cantidad -= $request->cantidad;
                //   // $producto->update();

                // }else{
                //   // return response()->json('si existe');

                //   $cantidadTotal = ($request->cantidad+$items->cantidad);

                //   $items->cantidad = $cantidadTotal;
                //   $items->precio_u = $producto->precio;
                //   $items->subtotal = $producto->precio*$cantidadTotal;
                //   $items->update();

                //   // $producto->cantidad -= $request->cantidad;
                //   // $producto->update();

                // }

                // $producto->cantidad -= $request->cantidad;
                // $producto->update();


              } catch (\Exception $e) {

              }

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function show($nome_token_user,Request $request)
    {
        //return response()->json($request);
        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

                $code = '200';
                $items = DetalleVenta::with('producto')->where("nome_token",$request->nome_token)->first();
                $message = 'OK';

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function edit($nome_token_user,Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function update($nome_token_user,Request $request)
    {
        //return response()->json($request);
        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

                $code = '200';
                $items = DetalleVenta::with('producto')->where("nome_token",$request->nome_token)->first();
                $items->idventa = $request->idventa;
                $items->idproducto = $request->idproducto;
                // $items->fecha = $request->fecha;
                $items->precio_u = $request->precio_u;
                $items->cantidad = $request->cantidad;
                $items->subtotal = $request->subtotal;
                $items->update();
                $message = 'OK';

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy($nome_token_user,Request $request)
    {
        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

                $code = '200';
                $items = DetalleVenta::with('producto')->where("nome_token",$request->nome_token)->first();
                $items->estado_del='0';
                $items->update();
                $message = 'OK';

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }
    public function Filtro($nome_token_user,Request $request)
    {
        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

                $code = '200';
                //traer todos los registros de la tabla detalleventa que no tengan idventa, esto porque son items del carrito del usuario de la app
                $items = DetalleVenta::with('producto')->where([["estado_del","1"],['idventa',null],["idcliente","$validad->id"]])->get();
                $message = 'OK';

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }



}
