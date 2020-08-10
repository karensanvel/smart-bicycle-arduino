<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LecturaTemperaturaHumedad;

use Illuminate\Support\Facades\Auth;

class LecturaTHController extends Controller
{
    public function getDatos(Request $request) //registro de los ultimos 10 datos
    {
        $turnos = LecturaTemperaturaHumedad::orderBy('lectura_fecha','desc')->limit(10)->get();; 
        return response()->json(['datos'=>$turnos]);
    }
    public function getLastData(Request $request)
    {
        $datos = LecturaTemperaturaHumedad::orderBy('lectura_fecha','desc')->limit(1)->get();; 
        return response()->json(['datos'=>$datos]);
    }
}
