<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Str;
use App\TipoUsuario;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loguearAdmin()
    {

        if(auth()->User()->idtipo!=1){
            auth()->logout();
            return redirect('/login');
        }else{

            return redirect('/home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function contar(){
      $conteo=  User::where("estado_del", "1")->count();
      return response()->json($conteo);
    }

    public function todosUsuarios(){
        $user=  User::where("estado_del", "1")->get();
        return response()->json($user);
      }
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
    // store
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

                $items = new User();
                // $tipo = TipoUsuario::where('nome_token',$request->nome_token_tipo)->first();
                $items->idtipo = (TipoUsuario::where('nome_token',$request->nome_token_tipo)->first())->id;
                $items->name = $request->name;
                $items->email = $request->email;
                $items->cedula = $request->cedula;
                $items->celular = $request->celular;
                $items->direccion = $request->direccion;
                $items->referencia = $request->referencia;
                $items->imagen = $request->imagen;
                $items->password = bcrypt($request->password);
                $items->password2 = $request->password;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // show
    public function show($nome_token_user='',Request $request)
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
                $items = User::with(['tipo','ubicacion'])->where("nome_token",$request->nome_token)->first();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // update
    public function update($nome_token_user='',Request $request)
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
                $code='403';
                $items = 'null';
                $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';
            } else {
                $code = '200';
                $items = User::where("nome_token",$request->nome_token)->first();
                try {
                    $items->idtipo = (TipoUsuario::where('nome_token',$request->nome_token_tipo)->first())->id;
                } catch (\Throwable $th) {
                }
                $items->name = $request->name;
                $items->email = $request->email;
                $items->cedula = $request->cedula;
                $items->celular = $request->celular;
                $items->direccion = $request->direccion;
                $items->referencia = $request->referencia;
                $items->password = bcrypt($request->password);
                //$items->password2 = $request->password;
                //$items->imagen = $url;
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
    public function updateContrasena($nome_token_user='',Request $request)
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
                $code='403';
                $items = 'null';
                $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';
            } else {
                $code = '200';
                $items = User::where("nome_token",$request->nome_token)->first();
                try {
                    $items->idtipo = (TipoUsuario::where('nome_token',$request->nome_token_tipo)->first())->id;
                } catch (\Throwable $th) {
                }
                //$items->name = $request->name;
                //$items->email = $request->email;
                //$items->cedula = $request->cedula;
                //$items->celular = $request->celular;
                $items->password = bcrypt($request->password);
                $items->password2 = $request->password;
                //$items->imagen = $url;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //destroy
    public function destroy ($nome_token_user='',Request $request)
    {
        //return response()->json($nome_token_user);
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
                $items = User::where("nome_token",$request->nome_token)->first();
                $items->email=$items->email.'*';
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
    //filtro
    public function Filtro($nome_token_user='',Request $request)
    //public function Filtro($value='')
    {
        // $items = User::with('tipo')->where([["estado_del","1"]])->first();//->orderBy('name', 'desc')->get();


        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::with('tipo')->where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {

                $code = '200';
                $items = User::with('tipo')->where([["estado_del","1"],["name","like","%$request->value%"]])->orderBy('name', 'desc')->get();
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

    // //filtro Courier
    public function FiltroCourier($nome_token_user='',Request $request)
    //public function Filtro($value='')
    {

        // $tipo = TipoUsuario::where('cod','003')->first();
        // $items = User::with('tipo')->where([["estado_del","1"],["idtipo","$tipo->id"],["name","like","%$request->value%"]])->orderBy('name', 'desc')->get();


        $code='';
        $message ='';
        $items ='';

        if (empty($nome_token_user)) {

            $code='403';
            $items = 'null';
            $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';

        }else{

            $validad = User::with('tipo')->where('nome_token',$nome_token_user)->first();

            if (empty($validad['name'])|| $validad['estado_del']=='0' ) {
                //no existe ese usuarios o fue dado de baja.
            } else {
                try {
                    $tipo = TipoUsuario::where('cod','002')->first(); //Courier

                    $code = '200';
                    $items = User::with('tipo')->where([["estado_del","1"],["idtipo","$tipo->id"],["name","like","%$request->value%"]])->orderBy('name', 'desc')->get();
                    $message = 'OK';
                } catch (\Throwable $th) {
                    //throw $th;
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

    public function prueba()
    {
      // $request->email = 'hola';
      // return response()->json($request);
      // $code='';
      // $message ='';
      // $items ='';
      //
      // $result =   array(
      //                 'items'     => $items = User::all(),
      //                 'code'      => $code,
      //                 'message'   => $message
      //             );
      $result=User::with('tipo')->first();
      return response()->json($result);
    }

    public function login(Request $request)
    {
      $code='';
      $message ='';
      $items ='';
      //
      // if (empty($request->email) || empty($request->password)) {
      //
      //     $code='403';
      //     $items = 'null';
      //     $message = 'Forbidden: La solicitud fue legal, pero el servidor rehúsa responderla dado que el cliente no tiene los privilegios para hacerla. En contraste a una respuesta 401 No autorizado, la autenticación no haría la diferencia';
      //
      // }else{
      //
      //     $validad = User::with('tipo')->where('email',$request->email)->first();
      //     dd($validad);
      //     return;
      //     if (empty($validad['name']) || $validad['estado_del']=='0' ) {
      //         //no existe ese usuarios o fue dado de baja.
      //     }
      //     else {
      //
      //         $code = '200';
      //         $items = $validad;
      //         $message = 'OK';
      //
      //     }
      //
      // }
      //
      // $result =   array(
      //                 'items'     => $items,
      //                 'code'      => $code,
      //                 'message'   => $message
      //             );
      $items = User::with("tipo")->where([["estado_del","1"],["email",$request->email]])->first();
      $result =   array(
                      'items'     => $items,
                      'code'      => $code,
                      'message'   => $message
                  );
      return response()->json($result);

    }
    public function register(Request $request)
    {
        //return $request;
        $ignorar = array("/", ".", "$");

        $code='';
        $message ='';
        $items ='';
        //return response()->json("dsadasd");
        try {

            $items = User::where([["estado_del","1"],["email",$request->email]])
                            ->orWhere([["estado_del","1"],["cedula",$request->cedula]])
                            // ->orWhere([["estado_del","1"],["celular",$request->celular]])
                            ->first();
            $nombre = User::where('name',$request->name)->first();
            if (empty($items['cedula']) == false) {
                $items = '';
                $code = '418';
                $message = 'Ya existe un usuario con la misma cedula';
            }else if(empty($nombre['name']) == false){
                $items = '';
                $code = '418';
                $message = 'Ya existe un usuario con la misma nombre';
            }else{
                $items = new User();
                $items->idtipo = (TipoUsuario::where('cod','003')->first())->id;
                $items->name = $request->name;
                $items->email = $request->email;
                $items->cedula = $request->cedula;
                $items->celular = $request->celular;
                $items->direccion = $request->direccion;
                $items->referencia = $request->referencia;
                $items->imagen = $request->imagen;
                $items->password = bcrypt($request->password);
                $items->password2 = $request->password;
                $items->estado_del = '1';
                $items->nome_token = str_replace($ignorar,"",bcrypt(Str::random(10)));
                $items->save();

                $items = User::with("tipo")->where("nome_token",$items->nome_token)->first();

                $code = '200';
                $message = 'OK';
            }

        } catch (\Throwable $th) {
            $items ='';
            $code = '418';
            $message = 'I am a teapot';
        }

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }

    public function consultar_ubicacion_courier(Request $request)
    {
      $ignorar = array("/", ".", "$");

      $code='';
      $message ='';
      $items ='';

      try {
        $tipoId = (TipoUsuario::where('cod','003')->first())->id;
        $couriers = User::with('ubicacion')->where([['idtipo',$tipoId],['estado_del', '1']])->get();
        $code = '200';
        $message = 'ok';
        $items = $couriers;
      } catch (\Exception $e) {
        $code = '500';
        $message = 'error';
      }

      $result =   array(
                      'items'     => $items,
                      'code'      => $code,
                      'message'   => $message
                  );

      return response()->json($result);

    }

    public function setImagenUsuario($token)
    {
      header('Access-Control-Allow-Origin: *');
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
          $target_path = "Usuarios/";
          $target_path = $target_path.$validad->id.".jpg";
          if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
            $validad->imagen = $target_path;
            $validad->update();
            $code='200';
            $message ='EXITO';
          } else {
            $code='418';
            $message ='ERROR';
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
