<?php

namespace App\Http\Controllers;

use App\Ubicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Str;
class UbicacionController extends Controller
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
    public function store($nome_token_user='',Request $request)
    {
        //return $request;
        $ignorar = array("/", ".", "$");

        $code='';
        $message ='';
        $items ='';

        
        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::with("tipo")->where('nome_token',$nome_token_user)->first();
            // return $validad;
            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {


                try {
                    $code = '200';
                    $message = 'OK';

                    $consulta = Ubicacion::where([["idusuario",$validad->id],["estado_del","1"]])->get();
                    
                    foreach ($consulta as $key => $item) {
                        $item->estado_del=0;
                        $item->update();
                    }
                    
                } catch (\Throwable $th) {
                    $items = ';-)';
                    $code = '418';
                    $message = 'I am a teapot';
                }

                try {
                    $code = '200';
                    $message = 'OK';

                    $items = new Ubicacion();
                    $items->idusuario=$validad->id;
                    $items->latitud=$request->latitud;
                    $items->longitud=$request->longitud;
                    $items->descripcion=$request->descripcion;

                    $items->estado_del = '1';
                    $items->nome_token = str_replace($ignorar,"",bcrypt(Str::random(10)));
                    $items->save();    

                } catch (\Throwable $th) {
                    $items = ';-)';
                    $code = '418';
                    $message = 'I am a teapot';
                }
               
               

            }

        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($items);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacion)
    {
        //
    }
}
