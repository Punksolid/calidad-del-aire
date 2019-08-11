<?php

namespace App\Http\Controllers;

use App\Estacion;
use Illuminate\Http\Request;

class EstacionesController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estacion = Estacion::Import($request->all());

        return response()->json([
            'data' => $estacion
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estacion  $estacion
     * @return \Illuminate\Http\Response
     */
    public function show(Estacion $estacion)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estacion  $estacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estacion $estacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estacion  $estacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estacion $estacion)
    {
        //
    }
}
