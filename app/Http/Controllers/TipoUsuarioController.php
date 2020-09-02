<?php

namespace App\Http\Controllers;

use App\TipoUsuario;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json("index");
    }

    public function contar(){
        $conteo=  TipoUsuario::where("estado_del", "1")->count();
        return response()->json($conteo);
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

    public function count(){
        
        $contar=TipoUsuario::All()->count();
        return response()->json($contar);
       
    } 
    public function store($nome_token_user='',Request $request)
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

                $code = '200';

                $items = new TipoUsuario();
                $items->cod = Str::random(10);
                $items->descripcion = $request->descripcion;
                $items->estado_del = '1';
                $items->nome_token = str_replace($ignorar,"",bcrypt(Str::random(10)));
                $items->save();  

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
     * Display the specified resource.
     *
     * @param  \App\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\Response
     */
    public function show($nome_token_user='',Request $request)
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
                $items = TipoUsuario::where("nome_token",$request->nome_token)->first();
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
     * @param  \App\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\Response
     */
    public function edit($nome_token_user='',Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\Response
     */
    public function update($nome_token_user='',Request $request)
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
                $items = TipoUsuario::where("nome_token",$request->nome_token)->first();
                $items->descripcion = $request->descripcion;
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
     * @param  \App\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($nome_token_user='',Request $request)
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
                $items = TipoUsuario::where("nome_token",$request->nome_token)->first();
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

    public function Filtro($nome_token_user='',Request $request)
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
                $items = TipoUsuario::where([["estado_del","1"],["descripcion","like","%$request->value%"]])->get();
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
