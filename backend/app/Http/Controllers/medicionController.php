<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\medicion_contaminacion;
use App\medicion_meteorologico;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

use DB;

class medicionController extends Controller
{



    /**
     * metodo que devuelve las mediciones de temperatura y humedad
     * el metodo recibiara 3 parametros en el request, el primero una fecha yyyy-mm-dd
     * el segundo un numero(limite) (1=dia, 2=semana, 3=mes) para ver de cuantos dias se quiere la informacion
     * el tercero es la estacion(estacion) (1 = padre las casas, 2 = las encinas)
     */
    public function getMediciones(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fecha' => 'required',
            'limite' => 'required|integer|between:1,3',
            'estacion' => 'required|integer|between:1,2'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'parametros enviados erroneos'
            ]);
        }

        $fecha = $request->fecha;

        $dia = date("d", strtotime($fecha));
        $semana = date("W", strtotime($fecha));
        $mes = date("m", strtotime($fecha));
        $año = date("Y", strtotime($fecha));

        $from = date("Y-m-d", strtotime("{$año}-W{$semana}-1")); //Returns the date of monday in week
        $to = date("Y-m-d", strtotime("{$año}-W{$semana}-7"));   //Returns the date of sunday in week

        $limite = $request->limite;

        if (($limite == 1)) {
            if ($request->estacion == 1) {
                $temperatura = medicion_meteorologico::where('estacion_parametro_id', 368)->whereYear('fecha', $año)
                    ->whereMonth('fecha', $mes)->whereDay('fecha', $dia)->select('fecha', 'valor AS temperatura')
                    ->orderBy('fecha', 'DESC')->get();
                $humedad = medicion_meteorologico::where('estacion_parametro_id', 367)->whereYear('fecha', $año)
                    ->whereMonth('fecha', $mes)->whereDay('fecha', $dia)->select('fecha', 'valor as humedad')
                    ->orderBy('fecha', 'DESC')->get();
                $resultado = array_merge($temperatura->toArray(), $humedad->toArray());
            } else {
                if ($request->estacion == 2) {
                    $temperatura = medicion_meteorologico::where('estacion_parametro_id', 388)->whereYear('fecha', $año)
                        ->whereMonth('fecha', $mes)->whereDay('fecha', $dia)->select('fecha', 'valor AS temperatura')
                        ->orderBy('fecha', 'DESC')->get();
                    $humedad = medicion_meteorologico::where('estacion_parametro_id', 387)->whereYear('fecha', $año)
                        ->whereMonth('fecha', $mes)->whereDay('fecha', $dia)->select('fecha', 'valor AS humedad')
                        ->orderBy('fecha', 'DESC')->get();
                    $resultado = array_merge($temperatura->toArray(), $humedad->toArray());
                } else {
                    return response()->json([
                        'error' => 'no se encontro la estacion solicitada'
                    ]);
                }
            }
        } else if ($limite == 2) {
            if ($request->estacion == 1) {
                $temperatura = medicion_meteorologico::where('estacion_parametro_id', 368)->whereBetween('fecha', [$from, $to])
                ->whereTime('fecha','=', '15:00:00')->select('fecha', 'valor AS temperatura')->orderBy('fecha', 'DESC')->get();
                $humedad = medicion_meteorologico::where('estacion_parametro_id', 367)->whereBetween('fecha',[$from,$to])
                ->whereTime('fecha','=', '15:00:00')->select('fecha', 'valor as humedad')->orderBy('fecha', 'DESC')->get();
                $resultado = array_merge($temperatura->toArray(), $humedad->toArray());
            } else {
                if ($request->estacion == 2) {
                    $temperatura = medicion_meteorologico::where('estacion_parametro_id', 388)->whereYear('fecha', $año)->select('fecha', 'valor AS temperatura')
                        ->orderBy('fecha', 'DESC')->get();
                    $humedad = medicion_meteorologico::where('estacion_parametro_id', 387)->whereYear('fecha', $año)->select('fecha', 'valor AS humedad')
                        ->orderBy('fecha', 'DESC')->get();
                    $resultado = array_merge($temperatura->toArray(), $humedad->toArray());
                } else {
                    return response()->json([
                        'error' => 'no se encontro la estacion solicitada'
                    ]);
                }
            }
        } else if ($limite == 3) {
            if ($request->estacion == 1) {
                $temperatura = medicion_meteorologico::where('estacion_parametro_id', 368)->whereYear('fecha', $año)
                    ->whereMonth('fecha', $mes)->whereTime('fecha','=', '15:00:00')->orderBy('fecha', 'DESC')
                    ->select('fecha', 'valor as temperatura')->get();
                $humedad = medicion_meteorologico::where('estacion_parametro_id', 367)->whereYear('fecha', $año)
                    ->whereMonth('fecha', $mes)->whereTime('fecha','=', '15:00:00')->select('fecha', 'valor as humedad')
                    ->orderBy('fecha', 'DESC')->get();
                $resultado = array_merge($temperatura->toArray(), $humedad->toArray());
            } else {
                if ($request->estacion == 2) {
                    $temperatura = medicion_meteorologico::where('estacion_parametro_id', 388)->whereYear('fecha', $año)
                        ->whereMonth('fecha', $mes)->select('fecha', 'valor AS temperatura')
                        ->orderBy('fecha', 'DESC')->get();
                    $humedad = medicion_meteorologico::first()->where('estacion_parametro_id', 387)->whereYear('fecha', $año)
                        ->whereMonth('fecha', $mes)->select('fecha', 'valor AS humedad')
                        ->orderBy('fecha', 'DESC')->get();
                    $resultado = array_merge($temperatura->toArray(), $humedad->toArray());
                } else {
                    return response()->json([
                        'error' => 'no se encontro la estacion solicitada'
                    ]);
                }
            }
        }

        return $resultado;
    }

    /** 
     * funcion que devuelve las ultimas mediciones de mp2,5 disponible
     * es necesario pasar como parametro la estacion de la cual se quiere acceder el mp2,5
     * (1 = Padre las casas II, 2 = Las encinas)
     * estacion_parametro_id Material Particulado PM 2,5 = 358 padre las casas, 376 Las encinas
     * retorna la fecha de la ultima medicion y el valor
     */

    public function getMp2(Request $request)
    {

        

        $validator = Validator::make($request->all(), [
            'estacion' => 'required|integer|between:1,2'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'parametros enviados erroneos'
            ]);
        }

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
     * funcion que devuelve la ultima informacion disponible de humedad y temperatura ambiente
     * es necesario pasar como parametro la estacion de la cual se quiere a la temperatura y humedad
     * (1 = Padre las casas II, 2 = Las encinas)
     *"367"	"Padre Las Casas II"	"Humedad Relativa del Aire"
     *"368"	"Padre Las Casas II"	"Temperatura Ambiente"
     *"387"	"Las Encinas"	"Humedad Relativa del Aire"
     *"388"	"Las Encinas"	"Temperatura Ambiente"
     */

    public function getLastData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'estacion' => 'required|integer|between:1,2'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'parametros enviados erroneos'
            ]);
        }
        if ($request->estacion == 1) {
            $temperatura = medicion_meteorologico::first()->where('estacion_parametro_id', 368)->whereNotNull('valor')->select('fecha', 'valor AS temperatura')
                ->orderBy('fecha', 'DESC')->take(1)->get();
            $humedad = medicion_meteorologico::first()->where('estacion_parametro_id', 367)->whereNotNull('valor')->select('fecha', 'valor as humedad')
                ->orderBy('fecha', 'DESC')->take(1)->get();
            $resultado = array_merge($temperatura->toArray(), $humedad->toArray());
        } else {
            if ($request->estacion == 2) {
                $temperatura = medicion_meteorologico::first()->where('estacion_parametro_id', 388)->whereNotNull('valor')->select('fecha', 'valor AS temperatura')
                    ->orderBy('fecha', 'DESC')->take(1)->get();
                $humedad = medicion_meteorologico::first()->where('estacion_parametro_id', 387)->whereNotNull('valor')->select('fecha', 'valor AS humedad')
                    ->orderBy('fecha', 'DESC')->take(1)->get();
                $resultado = array_merge($temperatura->toArray(), $humedad->toArray());
            } else {
                return response()->json([
                    'error' => 'no se encontro la estacion solicitada'
                ]);
            }
        }

        return $resultado;
    }

    /** 
     * funcion que devuelve los ultimos registros de gases disponibles
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

        $validator = Validator::make($request->all(), [
            'estacion' => 'required|integer|between:1,2'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'parametros enviados erroneos'
            ]);
        }
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
            $resultado = $array;
        } else {
            $NO2 = medicion_contaminacion::where('estacion_parametro_id', 379)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS NO2 "))
                ->orderBy('fecha')->take(1)->get();
            $NOX = medicion_contaminacion::where('estacion_parametro_id', 380)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS NOX "))
                ->orderBy('fecha')->take(1)->get();
            $NO = medicion_contaminacion::where('estacion_parametro_id', 381)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS NO "))
                ->orderBy('fecha')->take(1)->get();
            $CO = medicion_contaminacion::where('estacion_parametro_id', 382)->select('fecha')
                ->selectRaw(DB::raw("COALESCE(registro_validado, registro_preliminar, registro_sin_validar)  AS CO "))
                ->orderBy('fecha')->take(1)->get();

            $array = array_merge($NO2->toArray(), $NOX->toArray());
            $array = array_merge($array, $NO->toArray());
            $array = array_merge($array, $CO->toArray());
            $resultado = $array;
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
