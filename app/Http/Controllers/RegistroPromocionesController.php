<?php

namespace App\Http\Controllers;

use App\RegistroPromociones;
use App\TipoPromocion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistroPromocionesController extends Controller
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
        $code='';
        $message ='';
        $items ='';
        if($request->idTipoPromocion == null){
            $code='403';
            $items = 'null';
            $message = 'El producto a aplicar la promocion esta vacio';
        }else if($request->descripcion == null){
            $code='403';
            $items = 'null';
            $message = 'El producto a aplicar la promocion esta vacio';
        }else if($request->descuento == null){
            $code='403';
            $items = 'null';
            $message = 'La cantidad a descontar esta vacio';
        }else if($request->cantidad == null){
            $code='403';
            $items = 'null';
            $message = 'La cantidad a colocar en promocion esta vacio';
        }else if($request->fecha_inicio == null){
            $code='403';
            $items = 'null';
            $message = 'La fecha de inicion de la promoción esta vacio';
        }else if($request->fecha_fin== null){
            $code='403';
            $items = 'null';
            $message = 'La fecha final de la promoción  esta vacio';
        }else
            {
            $Promociones =(TipoPromocion::where('id',$request->idTipoPromocion)->first());
            if($Promociones['id'] == ""){
                $code='403';
                $items = 'null';
                $message = 'El promocion no existe ';
            }else{
                if((int)$request->cantidad <=0){
                    $code='403';
                    $items = 'null';
                    $message = 'No puede existir un cantidad igual o menor a cero ';
                }else if((int)$request->descuento <=0){
                    $code='403';
                    $items = 'null';
                    $message = 'No puede existir un descuento igual o menor a cero';
                }else{
                    // $DataPromocion = RegistroPromociones::where([["estado_del","1"],["idTipoPromocion",$Promociones['id']]])->get();
                    // if(count($DataPromocion) == 0){
                        $items = new RegistroPromociones();
                        $items->idTipoPromocion =$Promociones['id'];
                        $items->descripcion =$request->descripcion;           
                        $items->descuento = $request->descuento;
                        $items->cantidad = $request->cantidad ;  
                        $items->fecha_inicio = $request->fecha_inicio;
                        $items->fecha_fin = $request->fecha_fin;    
                        $items->estado_del = "1";
                        //$items->publicado=$request->publicado;
                        $items->save();       
                        $code = '200';
                        $message = 'OK';
                    // }else{
                    //     $code='403';
                    //     $items = 'null';
                    //     $message = 'Ya existe una promocion activa en este momento';
                    // }
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
     * @param  \App\RegistroPromociones  $registroPromociones
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroPromociones $registroPromociones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegistroPromociones  $registroPromociones
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistroPromociones $registroPromociones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistroPromociones  $registroPromociones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroPromociones $registroPromociones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistroPromociones  $registroPromociones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
                $code='';
                $message ='';
                $items ='';
               
                $registro=RegistroPromociones::with(['kits2'])->where('id',$request->id)->first();
            
                    foreach ($registro->kits2 as $item) {
                       
                        $item->delete();

                    }
                    $registro->delete();
                    $code = '200';
                $message = 'OK';    
                
                      
         

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );
            
        return response()->json($result);       
    }
    //m


    public function Filtro(Request $request)
    {
        
        $code='';
        $message ='';
        $items ='';

             
                $code = '200';
                 $items = RegistroPromociones::with(['tipoPromocion'])->withCount(['kits'])->get();
               
                $message = 'OK';


        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );
        //
        return response()->json($result);
    }
    public function BuscarPromocion(Request $request)
    {
        $code='';
        $message ='';
        $items ='';
        $code = '200';        
        if(trim($request->term) == ''){
            $items =RegistroPromociones::where([["estado_del","1"],["publicado",null],['idTipoPromocion',$request->idTipoPromocion]])->limit(10)->get(['id', 'descripcion as text']);
        }else{
            $items = RegistroPromociones::where([["estado_del","1"],["publicado",null],['idTipoPromocion',$request->idTipoPromocion],["descripcion","like",'%'.$request->term.'%']])->limit(10)->get(['id', 'descripcion as text']);
            //$items = RegistroPromociones::with('tipoPromocion1')->whereHas('tipoPromocion1', function ($query) use ($palabra) {
              //  $query->where("descripcion","like",'%'.$palabra.'%');
            //})->get();
        }
        $message = 'OK';
        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );
            
        return response()->json($result);
    }
    public function publicidad(Request $request){
        $message = '';
        $item = '';
        $code = '';
        $registro=RegistroPromociones::with(['kits2'])->where('id',$request->id)->first();
        foreach ($registro->kits2 as $items) {
            if(($items->cantidad * $registro->cantidad)>$items->ProductoKit2->stock){
                $item = $item.strval($items->ProductoKit2->NAME." solo dispone de la cantidad de ".(string)$items->ProductoKit2->stock)."\n";
            }
        }
        if($message != ''){
            $message = 'ERROR';
            $code = '400';
            $item = "Los siguientes productos no estan disponibles en stock : \n".$item;
        }else{
            $message = 'OK';
            $code = '200';
            foreach ($registro->kits2 as $items) {
                $items->ProductoKit2->stock = (int)$items->ProductoKit2->stock - ((int)$items->cantidad * (int)$registro->cantidad);
                $items->ProductoKit2->update();
            }
            $registro->publicado = "1";
            $registro->update();
        }
        $result =   array(
            'items'     => $item,
            'code'      => $code,
            'message'   => $message
        );
        return response()->json($result);
    }
    //esta funcion nos permite motrar todos los registro que tenga publicado 1
    public function filtroRegistro(Request $request)
    {
        
        $code='';
        $message ='';
        $items ='';

             
                $code = '200';
                 $items =RegistroPromociones::where("id",$request->id)->first();
                $message = 'OK';


        $result =   array(
                        'items'     => $items,
                        'code'      => $code,    
                        'message'   => $message
                    );
        return response()->json($result);
    }
    
    public function contarRegistros()
    {
        $code='';
        $message ='';
        $items ='';

        $code = '200';
        $items =RegistroPromociones::where("estado_del",'1')->count();
        $message = 'OK';

        $result =   array(
            'items'     => $items,
            'code'      => $code,    
            'message'   => $message
        );
return response()->json($result);

    }
    
    
}
