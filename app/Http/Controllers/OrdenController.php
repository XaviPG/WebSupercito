<?php

namespace App\Http\Controllers;

use App\Orden;
use App\Compra;
use App\EstadoVenta;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Notificacion;
class OrdenController extends Controller
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
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */

    public function sacar_de_la_orden(Request $request)
    {
        $code ='500';
        $items ='';
        $message = 'Error';

        $orden = Orden::with(['Detalle'])->where('id',$request->idorden)->first();
        $compra = Compra::with('Producto')->where('idOrdenar',$request->idorden)->where('id',$request->idcompra)->first();

        if ( sizeof($orden->detalle) == 1 ) {

            try {
                
                $compra->delete();
                $orden->delete();
                $code='200';
                $message='Listo';
                
            } catch (\Throwable $th) {
                $message = $th->getMessage();
            }
        }
        if ( sizeof($orden->detalle) > 1 ) {
            $orden->total = ( floatval( $orden['total']) - floatval($compra['producto']['PRICE']));
            try {
                $orden->update();
                $compra->delete();
                $code='200';
                $message='Listo';
            } catch (\Throwable $th) {
                $message = $th->getMessage();
            }
            
        }

        $items = Orden::with(['TipoPago','Courier','Cliente','Detalle','Estado'])->where('id',$request->idorden)->first();
        if ($items == null) {
            $items = 0;
        }
        $result =   array(
            'items'     => $items,
            'code'      => $code,
            'message'   => $message
        );
        return response()->json($result);

    }
   
    public function show(Request $request)
    {
        $code ='';
        $items ='';
        $message = '';


        try{
            $items = Orden::with(['TipoPago','Courier','Cliente','Detalle','Estado'])->where('id',$request->nome_token)->first();
        } catch (\Throwable $th) {
            return response()->json($th);
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
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Orden $orden)
    // {
    //     //
    // }

    public function contar(){
        $conteo= Orden::where("idestado","1")->count();
        return response()->json($conteo);
    }

    public function FiltroOrdenes(Request $request)
    {
      $code='200';
      $message ='';
      $items =Orden::with(['TipoPago','Estado','Usuarios'])->where([['idestado',2],['idcourier',$request->idcourier]])->get();
      $result =   array(
          'items'     => $items,
          'code'      => $code,
          'message'   => $message
      );
      return Response()->json($result);
    }
    public function ConsultarComprasHechas(Request $request)
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
          if ($request->fechaInicio != null && $request->fechafinal != null) {
            $from = date($request->fechaInicio);
            $to = date($request->fechafinal);
            $items = Orden::with('Compras','TipoPago','Estado','Usuarios')->where('idUsuario',$validad->id)->whereBetween('fechaOrden', [$from,$to])->get();
          }else {
            $items = Orden::with('Compras','TipoPago','Estado','Usuarios')->where('idUsuario',$validad->id)->limit(4)->get();
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
    public function SoloPedidos(Request $request)
    {

        $code='';
        $message ='';
        $items ='';
        $estado=EstadoVenta::where("cod", "001")->first();
        $items= Orden::with('Compras','TipoPago','Estado','Usuarios')->where("idestado", $estado->id)->get();
        $result =   array(
            'items'     => $items,
            'code'      => $code,
            'message'   => $message
        );
        return response()->json($result);
    }


   


    public function AsignarCourier(Request $request) // paso dos de la venta es asignar el courier
    {
        // return response()->json($request);

        $code='';
        $message ='';
        $items ='';

        try {
            $items = Orden::where("id",$request->idOrden)->first();

        // como la venta pasa al 2 nivel que es asigar el courier entonces se debe cambiar el estado de la venta.
        $estado = EstadoVenta::where('cod','002')->first();

        $items->idestado = $estado->id;


        $courier = User::where('id',$request->nome_token_courier)->first();
        $items->idcourier = $courier->id;
        //return response()->json($items);

        $items->update();


        ///CREAR NOTIFICACION
        $notificacion = new Notificacion();
        $notificacion->idusuario = $items->idUsuario;
        $notificacion->mensaje = "Le ha sido asignado su pepido al personal de entrega";
        $notificacion->estado_del = "1";
        $notificacion->save();
        //se listan las notificaciones anterioress a esta para cambiarles el estado;
        // $listadenotificacionesdeesteusuario = Notificacion::where([['idusuario',$orden->idUsuario],['estado_del','1']])->get();
        // $count = count($listadenotificacionesdeesteusuario);
        ////
        //se listan las notificaciones anterioress a esta para cambiarles el estado a cero;
        //Notificacion::where([['idusuario',$orden->idUsuario],['estado_del','1'],['id','<>',$notificacion->id]])->update(['estado_del'=>0]);


        $result =   array(
            'items'     => $items,
            'code'      => $code,
            'message'   => $message
        );
        } catch (\Throwable $th) {
            return response()->json($th);
        }

        return response()->json($result);
    }
    public function ImgComprobante(Request $request){
        //return response()->json($request);
            $code='500';
            $message ='error';
            $items =null;
    
            try {
                $estado=EstadoVenta::where("cod", "001")->first();
                if(empty($request->fecha_inicio)||empty($request->fecha_fin)){
                $items= Orden::with('Compras','TipoPago','Estado','Usuarios','Courier')->where("estado_del","1")
                                                                                        ->where("id" ,$request->idorden)
                                                                                        ->first();
    
                }else{
                    $items= Orden::with('Compras','TipoPago','Estado','Usuarios','Courier')->where(
                        "idestado",'<>' ,$estado->id)->whereDate("fechaOrden",">=",$request->fecha_inicio)
                                                    ->whereDate("fechaOrden","<=",$request->fecha_fin)
                                                    ->where("id" ,$request->idorden)
                                                    ->first();
    
                }
    
    
            $code='200';
            $message = 'ok';
            $result =   array(
                              'items'     => $items,
                              'code'      => $code,
                              'message'   => $message
                            );      
            } catch (\Throwable $th) {
                $items = $th->getMessage;
                $result =   array(
                    'items'     => $items,
                    'code'      => $code,
                    'message'   => $message
            );
            }
         
        return response()->json($result);
    
   }
   public function todasLasVentas(Request $request)
   { //corrige ka sangria que no puedo
       ///return response()->json($request);
       $code='500';
       $message ='error';
       $items =null;

       try {
           $estado=EstadoVenta::where("cod", "001")->first();
           if(empty($request->fecha_inicio)||empty($request->fecha_fin)){
            $items= Orden::with('Compras','TipoPago','Estado','Usuarios','Courier')->where("estado_del","1")
                                                                                   ->where("idestado",'<>' ,$estado->id)
                                                                                   ->get();

           }else{
               $items= Orden::with('Compras','TipoPago','Estado','Usuarios','Courier')->where(
                   "idestado",'<>' ,$estado->id)->whereDate("fechaOrden",">=",$request->fecha_inicio)->whereDate("fechaOrden","<=",$request->fecha_fin)->get();

           }


           $code='200';
           $message = 'ok';

       } catch (\Throwable $th) {
           $items = $th->getMessage;
          
           // $items= Orden::with('Compras','TipoPago','Estado','Usuarios','Courier')->where("estado_del","1")
           //                                                                         ->where("idestado",'<>' ,$estado->id)
           //                                                                         ->where("id", $request->idorden)
                                                                                   // ->get();

       }



       $result =   array(
           'items'     => $items,
           'code'      => $code,
           'message'   => $message
       );
       return response()->json($result);
   }
   public function finalizarOrden(Request $request)
   {
        $code='500';
        $message ='error';
        $items =null;

        try {
            $estado=EstadoVenta::where("cod", "003")->first();
            $items= Orden::where("id", $request->nome_token)->first();
            $items->idestado = $estado->id;
            $items->finalizado = '1';
            $items->update();

            $code='200';
            $message = 'ok';


        } catch (\Throwable $th) {
            //throw $th;
        }

        $result =   array(
            'items'     => $items,
            'code'      => $code,
            'message'   => $message
        );
        return response()->json($result);
    }

    public function RechazarOrden(Request $request)
    {
        $code='500';
        $message ='error';
        $items =null;
        // return response()->json('hola: ',$request);
        try {
            $estado=EstadoVenta::where("cod", "004")->first();
            $items= Orden::where("id", $request->nome_token)->first();
            $items->idestado = $estado->id;
            $items->rechazado = '1';
            $items->finalizado = '1';
            $items->update();

            $code='200';
            $message = 'ok';


        } catch (\Throwable $th) {
            //throw $th;
        }

        $result =   array(
            'items'     => $items,
            'code'      => $code,
            'message'   => $message
        );
        return response()->json($result);

    }

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
                $items = Orden::where("id",$request->nome_token)->first();
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
    public function saber_si_hay_un_nuevo_pedido(Request $request)
    {
        $code='500';
        $message ='error';
        $items =null;

        $conteo= Orden::where("idestado","1")->count();
        // $conteo = '2';
        if ($conteo > $request->conteo) {
            $items = $conteo;
        }else {
            $items = 0;
        }
        $code = '200';
        $message = 'ok';

        $result =   array(
            'items'     => $items,
            'code'      => $code,
            'message'   => $message
        );
        return response()->json($result);

    }

}
