<?php

namespace App\Http\Middleware;

use Closure;

class TestParam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    // Este middleware lo hemos hecho expresamente para que se compruebe si el param nos llega por la url. Si nos llega dejaremos pasar a la acción 
    // del controlador pero si no nos llega redireccionaremos
    public function handle($request, Closure $next)
    {
        // Con el método route('nombre_del_parametro') chequeamos el parámetro que nos llega por la url
        $param = $request->route('param');
        
        if(is_null($param)){
            return redirect()->route('pruebas.index');
        }
        return $next($request);
    }
}
