<?php

namespace App\Http\Controllers;

use App\posiciontrasnportista;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PosiciontrasnportistaController extends Controller
{
  public function PosicionTrasnportista(Request $request)
  {
    $posicionTransportista = posiciontrasnportista::with('Usuariotransportista')->where('idUsuario',$request->idUsuario)->get()->first();
    return response($posicionTransportista,200);
  }
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
      $_posiciontrasnportista = new posiciontrasnportista();
      $_posiciontrasnportista1 = posiciontrasnportista::where('idUsuario',$request->idUsuario)->get();
      if (COUNT($_posiciontrasnportista1)>0) {
        $_posiciontrasnportista1 = $_posiciontrasnportista1->first();
        $_posiciontrasnportista1->longitud = $request->longitud;
        $_posiciontrasnportista1->latitud = $request->latitud;
        $_posiciontrasnportista1->update();
        $_posiciontrasnportista = $_posiciontrasnportista1;
      }else {
        $_posiciontrasnportista->longitud = $request->longitud;
        $_posiciontrasnportista->latitud = $request->latitud;
        $_posiciontrasnportista->idUsuario = $request->idUsuario;
        $_posiciontrasnportista->save();
        $_posiciontrasnportista = $_posiciontrasnportista->first();
      }
        return response($_posiciontrasnportista);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\posiciontrasnportista  $posiciontrasnportista
     * @return \Illuminate\Http\Response
     */
    public function show(posiciontrasnportista $posiciontrasnportista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\posiciontrasnportista  $posiciontrasnportista
     * @return \Illuminate\Http\Response
     */
    public function edit(posiciontrasnportista $posiciontrasnportista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\posiciontrasnportista  $posiciontrasnportista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, posiciontrasnportista $posiciontrasnportista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\posiciontrasnportista  $posiciontrasnportista
     * @return \Illuminate\Http\Response
     */
    public function destroy(posiciontrasnportista $posiciontrasnportista)
    {
        //
    }
}
