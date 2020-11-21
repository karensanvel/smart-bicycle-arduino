<?php

namespace App\Http\Controllers;
use DateTime;
use Carbon\Carbon;
use App\Coordenada;
use App\Ruta;
use Illuminate\Http\Request;

class CoordenadaController extends Controller
{
    //Obtener las ultimas coordenadas para conocer el punto actual del ciclista
    public function ultimasCoordenadas()
    {
        //deberia de ser por usuario o numero de chaleco para saber a quien le pertece el viaje
        $coordenadas = Coordenada::orderBy('created_at','desc')->limit(1)->get();
        return response()->json($coordenadas);
    }
    
    //Obtener todas las coordenadas y el tiempo de viaje de la ultima ruta que se esté viajando (punto actual del ciclista)
    public function lastRoute()
    {
        //obtener la ultima ruta
        $ruta = Ruta::orderBy('created_at','desc')->limit(1)->get();

        //obtener el tiempo entre el punto de inicio y ultimo punto de la ruta
        $ultima = Coordenada::where('ruta_id', $ruta[0]->id)->orderBy('created_at','desc')->limit(1)->get();
        $primera = Coordenada::where('ruta_id', $ruta[0]->id)->orderBy('created_at','asc')->limit(1)->get();
        $horaP = $primera[0]->created_at; $horaF = $ultima[0]->created_at; $intervalo = $horaF->diff($horaP);
        
        //coordenadas de la ultima ruta
        $coordenadas = Ruta::where('id', $ruta[0]->id)->with('coordenadas')->get();
        return response()->json(['ruta'=>$coordenadas, 'tiempo'=> $intervalo->format('%H:%I:%S')]);
    }

    //traer las rutas viajadas por el usuario con sus coordenadas
    public function getAllRoutes()
    {
        $rutas = Ruta::with('coordenadas')->get();
        return response()->json($rutas);
    }

      //traer todas las coordenadas por el id del viaje
      public function getAllCoordenadasPorViaje($id)
      {
          $coordenadas = Ruta::where('id', $id)->with('coordenadas')->get();
          return response()->json($coordenadas);
      }
  
    //Obtener todas las coordenadas, punto de inicio y fin, tiempo y fecha de una ruta especifica.
    // (para grafica de lineas o tabla de rutas)
    public function getParametersByRoute($rutaId)
    {
        $coordenadas = Ruta::where('id', $rutaId)->with('coordenadas')->get();
        $ultima = Coordenada::where('ruta_id', $rutaId)->orderBy('created_at','desc')->limit(1)->get();
        $primera = Coordenada::where('ruta_id', $rutaId)->orderBy('created_at','asc')->limit(1)->get();
        $horaP = $primera[0]->created_at;
        $horaF = $ultima[0]->created_at;
        $intervalo = $horaF->diff($horaP);
        return response()->json(['ruta'=>$coordenadas,'parametros' => ['primeraCoordenada'=> $primera, 'ultimaCoordenada' => $ultima,
        'fechaViaje'=> $primera[0]->created_at->toDateString(),
        'start'=> $primera[0]->created_at->toTimeString(), 'end'=> $ultima[0]->created_at->toTimeString(), 
        'tiempo'=> $intervalo->format('%H:%I:%S')
        ]]);
    }
}
