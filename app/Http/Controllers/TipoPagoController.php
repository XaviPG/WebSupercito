<?php

namespace App\Http\Controllers;

use App\tipoPago;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TipoPagoController extends Controller
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
     * @param  \App\tipoPago  $tipoPago
     * @return \Illuminate\Http\Response
     */
    public function show(tipoPago $tipoPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipoPago  $tipoPago
     * @return \Illuminate\Http\Response
     */
    public function edit(tipoPago $tipoPago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipoPago  $tipoPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tipoPago $tipoPago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipoPago  $tipoPago
     * @return \Illuminate\Http\Response
     */
    public function destroy(tipoPago $tipoPago)
    {
        //
    }
    public function Filtro(Request $request)
    {
        
        

        $code='';
        $message ='';
        $items ='';

       
                $code = '200';
                $items = tipoPago::all();
                $message = 'OK';

    

        $result =   array(
                        'items'     => $items,
                        'code'      => $code,
                        'message'   => $message
                    );

        return response()->json($result);
    }
}
