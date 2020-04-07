<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LecturaTemperaturaHumedad;

use Illuminate\Support\Facades\Auth;

class LecturaTHController extends Controller
{
    public function getDatos(Request $request)
    {
        $turnos = LecturaTemperaturaHumedad::orderBy('lectura_fecha','desc')->limit(10)->get();; 
        return response()->json(['datos'=>$turnos]);
    }
}
