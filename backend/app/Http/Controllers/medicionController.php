<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\medicion_contaminacion;
use App\medicion_meteorologico;
use Illuminate\Http\Response;

use DB;

class medicionController extends Controller
{

    //TODO metodo que devuelva las mediciones de un mes, de un dia y de una semana 
    //mediciones: temperatura, humedad, pm10, pm25
    // por estacion meteorologica o por ciudad, ahi hay que ver


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $prueba = $request->test;
        $mediciones = medicion_contaminacion::limit(30)->offset(30)->select('fecha')
            ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS valor "))
            ->where('estacion_parametro_id', 358)->get();
        return $mediciones;
    }
    /**
     * el metodo recibiara 2 parametros en el request, el primero una fecha
     * y el segundo un numero (1=dia, 2=semana, 3=mes)
     */
    public function getMediciones(Request $request)
    {
        $fecha = $request->fecha;

        $limite = $request->limite;

        $mediciones = medicion_contaminacion::limit(35)->offset(30)->select('fecha')
            ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS valor "))
            ->where('estacion_parametro_id', 358)->get();

        //$mediciones = medicion_contaminacion::
    }

    /** 
     * es necesario pasar como parametro la estacion de la cual se quiere acceder el mp2,5
     * (1 = Padre las casas II, 2 = Las encinas)
     * estacion_parametro_id Material Particulado PM 2,5 = 358 padre las casas, 376 Las encinas
     * retorna la fecha de la ultima medicion y el valor
     */

    public function getMp2(Request $request)
    {

        if ($request->estacion == 1) {
            $resultado = medicion_contaminacion::where('estacion_parametro_id', 358)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS mp2 "))
                ->orderBy('fecha', 'DESC')->take(1)->get();
        } else {
            if ($request->estacion == 2) {
                $resultado = medicion_contaminacion::where('estacion_parametro_id', 376)->select('fecha')
                    ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS mp2 "))
                    ->orderBy('fecha', 'DESC')->take(1)->get();
            } else {
                return response()->json([
                    'error' => 'no se encontro la estacion solicitada'
                ]);
            }
        }

        return $resultado;
    }

    /** 
     * es necesario pasar como parametro la estacion de la cual se quiere recuperar los gases
     * (1 = Padre las casas II, 2 = Las encinas)
     * codigos de las mediciones:
     *"360"	"Padre Las Casas II"	"Dióxido de Nitrógeno (NO2)"
     *"361"	"Padre Las Casas II"	"Óxidos de Nitrógeno (NOX)"
     *"362"	"Padre Las Casas II"	"Monóxido de Nitrógeno (NO)"
     *"363"	"Padre Las Casas II"	"Monóxido de Carbono (CO)"
     *"379"	"Las Encinas"	"Dióxido de Nitrógeno (NO2)"
     *"380"	"Las Encinas"	"Óxidos de Nitrógeno (NOX)"
     *"381"	"Las Encinas"	"Monóxido de Nitrogeno (NO)"
     *"382"	"Las Encinas"	"Monóxido de Carbono (CO)"
     */
    public function getGases(Request $request)
    {
        if ($request->estacion == 1) {
            $NO2 = medicion_contaminacion::where('estacion_parametro_id', 360)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS NO2 "))
                ->orderBy('fecha', 'DESC')->take(1)->get();
            $NOX = medicion_contaminacion::where('estacion_parametro_id', 361)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS NOX "))
                ->orderBy('fecha', 'DESC')->take(1)->get();
            $NO = medicion_contaminacion::where('estacion_parametro_id', 362)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS NO "))
                ->orderBy('fecha', 'DESC')->take(1)->get();
            $CO = medicion_contaminacion::where('estacion_parametro_id', 363)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS CO "))
                ->orderBy('fecha', 'DESC')->take(1)->get();

            $array = array_merge($NO2->toArray(), $NOX->toArray());
            $array = array_merge($array, $NO->toArray());
            $array = array_merge($array, $CO->toArray());
            $resultado = json_encode($array);
        } else {
            $NO2 = medicion_contaminacion::where('estacion_parametro_id', 379)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS NO2 "))
                ->orderBy('fecha')->take(1)->get();
            $NOX = medicion_contaminacion::where('estacion_parametro_id', 380)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS NO2 "))
                ->orderBy('fecha')->take(1)->get();
            $NO = medicion_contaminacion::where('estacion_parametro_id', 381)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS NO2 "))
                ->orderBy('fecha')->take(1)->get();
            $CO = medicion_contaminacion::where('estacion_parametro_id', 382)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS NO2 "))
                ->orderBy('fecha')->take(1)->get();

            $resultado = $NO2->toBase()->merge($NOX)->merge($NO)->merge($CO);
        }

        return $resultado;
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
