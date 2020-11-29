<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LecturaTemperaturaHumedad;
use DB;
use Illuminate\Support\Facades\Auth;

class LecturaTHController extends Controller
{
    //vista para historiales
    public function history()
    {
        return view('history');
    }

    //datos en el dashboard principal
    public function getDatos(Request $request) //registro de los ultimos 10 datos
    {
        $turnos = LecturaTemperaturaHumedad::orderBy('lectura_fecha','desc')->limit(10)->get();
        return response()->json(['datos'=>$turnos]);
    }
    //Obtener el ultimo dato (para dasshboard en tiempo real)
    public function getLastData(Request $request)
    {
        $datos = LecturaTemperaturaHumedad::orderBy('lectura_fecha','asc')->limit(1)->get();
        return response()->json(['datos'=>$datos]);
    }

    //registros historicos de temperatura y humedad
    public function temperatureMoistureHistory()
    {
        $datos = LecturaTemperaturaHumedad::select(DB::raw('AVG(lectura_temperatura) AS temperatura'),
            DB::raw('AVG(lectura_humedad) AS humedad'), DB::raw('date(lectura_fecha) AS fecha'))
            ->groupBy('fecha')->orderBy('fecha', 'desc')->get();
            
        return response()->json(['datos'=>$datos]);
    }
    
    //registros históricos de la alarma activada
    public function alarmHistory()
    {
        $datos = LecturaTemperaturaHumedad::select(
            DB::raw('date(lectura_fecha) AS fecha'),  DB::raw('date_format(lectura_fecha, "%H:%i") AS hora'))->where('alarm', '1')
            ->groupBy('fecha', 'hora')->get();     
        return response()->json(['datos'=>$datos]);
    }
}
