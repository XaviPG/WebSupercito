<?php

namespace App\Http\Controllers;

use App\Notificacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function filtro(Request $request)
    {
        $code='500';
        $message ='error';
        $items ='';

        try {
            //code...
            $items = Notificacion::where([['idusuario',$request->idusuario],['estado_del','1']])->get();
            $message = 'ok';
            $code="200";

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

}
