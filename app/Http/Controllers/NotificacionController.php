<?php

namespace App\Http\Controllers;

use App\Notificacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NotificacionController extends Controller
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
        $notificacion = new Notificacion();
        $notificacion->idusuario = $request->idUsuario;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Notificacion $notificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Notificacion $notificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notificacion $notificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notificacion $notificacion)
    {
        //
    }
    public function desactivarNotificacion(Request $request){
        $code='500';
        $message ='error';
        $items ='';
        try {            
            $message = 'ok';
            $code="200";
            foreach(json_decode($request->notificaciones) as $item){
              $dato = Notificacion::where([['id',$item->id]])->get()->first();
              if(!empty($dato['id'])){
                $dato->estado_del ='0';
                $dato->update();
              }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        $result =   array(
            'items'     => json_decode($request->notificaciones),
            'code'      => $code,
            'message'   => $message
        );
        return response()->json($result);
    }

    
    public function filtro($idUsuario)
    {
        $code='500';
        $message ='error';
        $items ='';
        try {
            //code...
            $items=Notificacion::where([['idusuario',$idUsuario],['estado_del','1']])->get();
            //    foreach($items as $item){
            //         $item->estado_del ='0';
            //         $item->update();
            //    }
         
            $message = 'ok';
            $code="200";

        } catch (Exception $e) {
            //$message = $e->getMessage();
        }

        $result =   array(
            'items'     => $items,
            'code'      => $code,
            'message'   => $message
        );

        return response()->json($result);

    }

}
