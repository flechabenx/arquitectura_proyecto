<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\medicion_contaminacion;

class medicion_contaminacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //TODO metodo que devuelva las mediciones de un mes, de un dia y de una semana 
    //mediciones: temperatura, humedad, pm10, pm25
    // por estacion meteorologica o por ciudad, ahi hay que ver
    public function index(Request $request)
    {
        $prueba = $request->test;
        $mediciones = medicion_contaminacion::limit(30)->offset(30)->get();;
        return [
            'holo' => $prueba,
            $mediciones
            
        ];
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //obtener la cosa para un dia
    }

}
