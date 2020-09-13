<?php

namespace App\Http\Controllers;

use App\kit;
use App\Producto;
use App\RegistroPromociones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class KitController extends Controller
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
 

    public function contar(Request $request){
        
        // $conteo=  kit::where('idRegistro',$request->idRegistro)->count();
        $conteo=DB::table('kits')
                    ->select('idRegistro', DB::raw('count(*) as total'))
                    ->groupBy('idRegistro')
                    ->where('estado_del',"1")
                    ->count();
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
    public function store(Request $request)
    {
        $code='';
        $message ='';
        $items ='';
        $code = '200';
        $DatoRegistroPromociones = RegistroPromociones::where('id',$request->idRegistro)->first();
        $DatoProducto = Producto::where('id',$request->idProducto)->first();
        $registro=kit::where([['idProducto',$DatoProducto->id],['idRegistro',$DatoRegistroPromociones->id]])->get();
        if(COUNT($registro) > 0){
            $message ='Ya existe este producto en la promocion';
            $code='403';
            $items = 'null';
        }else if(($DatoRegistroPromociones->cantidad * $request->cantidad) > $DatoProducto->stock){
            $message ='No solo hay '.$DatoProducto->stock.' unidades disponible';
            $code='403';
            $items = 'null';
        }else{
            $items = new kit();
            $items->idRegistro =$DatoRegistroPromociones->id;
            $items->idProducto =$DatoProducto->id;
            $items->cantidad = $request->cantidad;       
            $items->estado_del = '1';
            $items->save();
            $message = 'OK';
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
     * @param  \App\kit  $kit
     * @return \Illuminate\Http\Response
     */
    // public function show(kit $kit)
    // {
    //     //
    // }

    
    public function update(Request $request)
    {
       
        $code='';
        $message ='';
        $items ='';
        $code = '200';
        $items = kit::where("id",$request->id)->first();
        $DatoRegistroPromociones = RegistroPromociones::where('id',$items->idRegistro)->first();
        $DatoProducto = Producto::where('id',$items->idProducto)->first();
        if(($DatoRegistroPromociones->cantidad * $request->cantidad) > $DatoProducto->stock){
            $message ='No solo hay '.$DatoProducto->stock.' unidades disponible';
            $code='403';
            $items = 'null';     
        }else{
            $items->cantidad = $request->cantidad;   
            $items->update(); 
            $message = 'OK';      
        }
        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );
            
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kit  $kit
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
                $code='';
                $message ='';
                $items ='';
               
                $registro=kit::with(['ProductoKit'])->where("id",$request->id)->first();
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
    public function Filtro(Request $request)
    {
      
        $code='';
        $message ='';
        $items ='';
                $code = '200';
                 //$items =kit::with(['ProductoKit'])->get();
                 $items =kit::with(['ProductoKit2'])->where('idRegistro',$request->idRegistro)->get();
                $message = 'OK';


        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );
        
        return response()->json($result);
    }
    
    

    
}
