<?php

namespace App\Http\Controllers;

use App\PromocionDelProducto;
use App\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromocionDelProductoController extends Controller
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

    public function contar(){
        $conteo= PromocionDelProducto ::all()->count();
        return response()->json($conteo);
    }

    public function store(Request $request)
    {
        $code='';
        $message ='';
        $items ='';
        if($request->idProducto == null){
            $code='403';
            $items = 'null';
            $message = 'El producto a aplicar la promocion esta vacio';
        }else if($request->descuento == null){
            $code='403';
            $items = 'null';
            $message = 'La cantidad a descontar esta vacio';
        }else if($request->stock == null){
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
            $Producto = (Producto::where('id',$request->idProducto)->first());
            if($Producto['id'] == ""){
                $code='403';
                $items = 'null';
                $message = 'El producto no existe ';
            }else{
                if((int)$request->stock <=0){
                    $code='403';
                    $items = 'null';
                    $message = 'No se puede colocar en stock la cantidad solicitada ';
                }else if((int)$request->descuento <=0){
                    $code='403';
                    $items = 'null';
                    $message = 'No puede existir un descuento igual o menor a cer';
                }else if((int)$request->stock > (int)$Producto['stock']){
                    $code='403';
                    $items = 'null';
                    $message = 'A excedido a lo que hay en stock';
                }else{
                    $DataPromocion = PromocionDelProducto::where([["estado_del","1"],["idProducto",$Producto['id']]])->get();
                    if(count($DataPromocion) == 0){
                        $items = new PromocionDelProducto();
                        $items->idProducto = $Producto['id'];
                        $items->descuento = $request->descuento;
                        $items->stock = $request->stock;
                        $items->fecha_inicio = $request->fecha_inicio;
                        $items->fecha_fin = $request->fecha_fin;
                        $items->estado_del = "1";
                        $items->save();
                        $Producto->stock = $Producto->stock - $request->stock;
                        $Producto->update();
                        $code = '200';
                        $message = 'OK';
                    }else{
                        $code='403';
                        $items = 'null';
                        $message = 'Ya existe una promocion activa en este momento';
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


    /**
     * Display the specified resource.
     *
     * @param  \App\PromocionDelProducto  $promocionDelProducto
     * @return \Illuminate\Http\Response
     */
    public function show(PromocionDelProducto $promocionDelProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PromocionDelProducto  $promocionDelProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(PromocionDelProducto $promocionDelProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PromocionDelProducto  $promocionDelProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromocionDelProducto $promocionDelProducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PromocionDelProducto  $promocionDelProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

       $code='';
       $message ='';
       $items ='';



               $code = '200';
               $items = PromocionDelProducto::where("id",$request->id)->first();
               $items->estado_del='0';
               $items->update();
               $message = 'OK';


       $result =   array(
                       'items'     => $items,
                       'code'      => $code,
                       'message'   => $message
                   );

       return response()->json($result);
    }

    public function Filtro(Request $request)
    {


        $code='';
        $message ='';
        $items ='';

                $Producto = (Producto::where('id',$request->idProducto)->first());
                $code = '200';
                $items = PromocionDelProducto::where('idProducto',$Producto['id'])->get();;
                $message = 'OK';


        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );
        //
        return response()->json($result);
    }

    public function ProductosActivas(Request $request)
    {

        $code='';
        $message ='';
        $items ='';


        $code = '200';
        $items = Producto::with(['PromocionesdelProducto'])->where([['estado_del','1'],['stock','>',0]])->orderBy('NAME', 'desc')->limit(10)->get();
        $message = 'OK';



        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );
        //
        return response()->json($result);
    }
    public function ProductosPorid(Request $request)
    {

        $code='';
        $message ='';
        $items ='';


        $code = '200';
        $items = Producto::with(['PromocionesdelProducto'])->where([["estado_del","1"],["id",$request->id]])->orderBy('NAME', 'desc')->limit(20)->first();
        $message = 'OK';



        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );
        //
        return response()->json($result);
    }


}
