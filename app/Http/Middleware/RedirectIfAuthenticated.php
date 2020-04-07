<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    { 
        $guard='web';
        if (Auth::guard($guard)->check()) { //usuario autecticado actualmente
            return redirect()->route('user.index');
        }
        return $next($request);
        //si es un invitado, negar las peticiones de ajax, si no es ajax, redireccionar al login
       /* if (Auth::guard($guard)->guest()) {
            if($request->ajax()||$request->wantsJson()){
                return response('Unauthorized', 401);
            }else{
                return redirect()->guest('login');
            }
        }
        return $next($request);*/
    }
}
