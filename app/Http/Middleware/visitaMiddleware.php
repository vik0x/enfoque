<?php

namespace App\Http\Middleware;

use Closure;
use App\visita;
class visitaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd(($request->url()));
        if(!$request->ajax()){
            if(session()->has('visita')){
                $visita = \App\visita::find(session('visita'));
                if($visita->ip == \Request::ip() && count($visita) > 0){
                    $visita->contador = $visita->contador + 1;
                }
                else{
                    $visita = new visita;
                    $visita->ip = \Request::ip();
                    $visita->contador = 1;
                }
                $visita->save();
            }
            else{
                $visita = new visita;
                $visita->ip = \Request::ip();
                $visita->contador = 1;
                $visita->save();
                $data = array(
                    'visita' => $visita->id_visita,
                );
                session($data);
            }
            
        }
        return $next($request);
    }
}
