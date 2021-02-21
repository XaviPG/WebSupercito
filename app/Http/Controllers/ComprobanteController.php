<?php

namespace App\Http\Controllers;

use App\Comprobante;
use Illuminate\Http\Request;
use App\User;
use App\tipoPago;
use App\Orden;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\EstadoVenta;
use App\RegistroPromociones;
use App\PromocionDelProducto;
use App\Compra;
class ComprobanteController extends Controller
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
     * @param  \App\Comprobante  $comprobante
     * @return \Illuminate\Http\Response
     */
    public function show(Comprobante $comprobante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comprobante  $comprobante
     * @return \Illuminate\Http\Response
     */
    public function edit(Comprobante $comprobante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comprobante  $comprobante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comprobante $comprobante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comprobante  $comprobante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comprobante $comprobante)
    {
        //
    }

    // public function guardarDocumentoTransaccion($token,$idTipoPago){
    public function guardarDocumentoTransaccion($token,$idTipoPago,$total,$latitud,$longitud,$promociones,$productos){
      header('Access-Control-Allow-Origin: *');
      return response()->json($result);
      $code='';
      $message ='';
      $items ='';
      if (empty($token)) {
          $code='403';
          $items = 'null';
          $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';
      }else{
        $validad = User::where('nome_token',$token)->first();
        if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
          $code='418';
          $message ='ERROR';
        } else {
          $tipoPago =tipoPago::where("id",$idTipoPago)->first();
          if (empty($tipoPago['id'])) {
            $code='418';
            $message ='ERROR';
          }else{
            if ($tipoPago['identificador']==1) {
              $estado=EstadoVenta::where("cod","001")->first();
              $Orden = new Orden();
              $Orden->idUsuario = $validad->id;
              $Orden->idestado=$estado->id;
              $Orden->idTipoPago = $tipoPago['id'];
              $Orden->Orden = strval(str_pad(Orden::count()+1,0, "0", STR_PAD_LEFT));
              $fecha = Carbon::now();
              $Orden->fechaOrden= $fecha->format('Y-m-d');
              $Orden->total = $total;
              $Orden->finalizado = "0";
              $Orden->latitud = $latitud;
              $Orden->longitud = $longitud;
              $target_path = "uploads/";
              //$target_path = $target_path.basename( $_FILES['file']['name']);

              //se agrega el id a nombre_img mas extension .jpg para acceder directamente a el
              $Orden->nombre_img = $Orden->Orden.".jpg";
              
              $target_path = $target_path.$Orden->Orden.".jpg";
              if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                $code='200';
                $message ='EXITO';
              } else {
                $code='418';
                $message ='ERROR';
              }
              $Orden->comprobante = $target_path;
              $Orden->save();
              if (count(json_decode($promociones)) != 0) {
                foreach(json_decode($promociones) as $dato){
                  $itemsCompra = new Compra();
                  $itemsCompra->idOrdenar = $Orden->id;
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
              if (count(json_decode($productos)) != 0) {
                  foreach(json_decode($productos) as $dato){
                    $itemsCompra = new Compra();
                    if ($dato->promocionesdel_producto == null) {
                      $itemsCompra->idOrdenar = $Orden->id;
                      $itemsCompra->id_Productos = $dato->id;
                      $itemsCompra->cantidad = $dato->cantidad;
                      $itemsCompra->save();
                      $datoProducto = Producto::find($dato->id);
                      $datoProducto->stock = $datoProducto->stock - $dato->cantidad;
                      $datoProducto->update();
                    }else {
                      $itemsCompra->idOrdenar = $Orden->id;
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
              //$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
             // $check = getimagesize($_FILES["file"]["tmp_name"]);
           }else {
             $code='418';
             $message ='ERROR';
           }
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
