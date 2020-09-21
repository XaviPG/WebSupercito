<?php

namespace App\Http\Controllers;

use App\Compra;
use App\RegistroPromociones;
use App\PromocionDelProducto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\tipoPago;
use App\Orden;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\EstadoVenta;
class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }
    public function contar(){
      $conteo= Orden::where("estado_del","1")->where("idestado","<>",1)->count();
      return response()->json($conteo);
  }


    public function ComprarProducto(Request $request)
    {
        $code='';
        $message ='';
        $items ='';
        if (empty($request->idUsuario)) {
            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';
        }else{
            $validad = User::where('nome_token',$request->idUsuario)->first();
            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
              $code='418';
              $message ='ERROR';
                //no existe ese usuarios o fue dado de baja.
            } else {
                try {
                  $tipoPago =tipoPago::where("id",$request->idTipoPago)->first();
                  $estado=EstadoVenta::where("cod","001")->first();
                  $items = new Orden();
                  $items->idUsuario = $validad->id;
                  $items->idestado=$estado->id;
                  $items->idTipoPago = $request->idTipoPago;
                  // $items->Orden = 'super-orden-'.strval(str_pad(Orden::count()+1,0, "0", STR_PAD_LEFT));
                  $items->Orden = strval(str_pad(Orden::count()+1,0, "0", STR_PAD_LEFT));
                  $fecha =Carbon::now();
                  $items->fechaOrden= $fecha->format('Y-m-d');
                  $items->total = $request->total;
                  $items->finalizado = "0";
                  $items->latitud = $request->latitud;
                  $items->longitud = $request->longitud;
                  $items->comprobante = null;
                  $items->save();
                  if (count(json_decode($request->idPromociones)) != 0) {
                    foreach(json_decode($request->idPromociones) as $dato){
                      $itemsCompra = new Compra();
                      $itemsCompra->idOrdenar = $items->id;
                      $itemsCompra->idRegistros = $dato->id;
                      $itemsCompra->cantidad = $dato->Carritocantidad;
                      $itemsCompra->valorPromocion = $dato->PrecioPromocionConDescuento;
                      $itemsCompra->save();

                      $promocion = RegistroPromociones::find($dato->id);
                      $promocion->cantidad = (int)$promocion->cantidad - (int)$dato->Carritocantidad;
                      if ($promocion->cantidad == 0) {
                        $promocion->estado_del = "0";
                      }
                      $promocion->update();
                    }
                  }
                  if (count(json_decode($request->productos)) != 0) {
                      foreach(json_decode($request->productos) as $dato){
                        $itemsCompra = new Compra();
                        if ($dato->promocionesdel_producto == null) {
                          $itemsCompra->idOrdenar = $items->id;
                          $itemsCompra->id_Productos = $dato->id;
                          $itemsCompra->cantidad = $dato->cantidad;
                          $itemsCompra->save();
                          $datoProducto = Producto::find($dato->id);
                          $datoProducto->stock = $datoProducto->stock - $dato->cantidad;
                          $datoProducto->update();
                        }else {
                          $itemsCompra->idOrdenar = $items->id;
                          $itemsCompra->idPromocionProducto = $dato->promocionesdel_producto->id;
                          $itemsCompra->cantidad = $dato->cantidad;
                          $itemsCompra->save();
                          $datoProductoPromociones = PromocionDelProducto::find($dato->promocionesdel_producto->id);
                          $datoProductoPromociones->stock = $datoProductoPromociones->stock - $dato->cantidad;
                          if ($datoProductoPromociones->stock == 0) {
                            $datoProductoPromociones->estado_del = "0";
                          }
                          $datoProductoPromociones->update();
                        }
                      }
                  }
                  $code='200';
                  $message ='EXITO';
                  $items ='';
                } catch (\Exception $e) {
                  $datoEliminar = Compra::where('idOrdenar',$items->id)->delete();
                  $code='418';
                  $message =$e;
                  $items ='';
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

}
