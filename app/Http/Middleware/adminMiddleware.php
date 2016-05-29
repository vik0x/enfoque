<?php
namespace App\Http\Middleware;
use Closure;
class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        // return $next($request);
        // dd(session()->all());
        if(session()->has('nick')){
            $usuario = \App\usuario::where('nick','=',session('nick'))->where('ide','=',session('ide'))->get();
            if($usuario->count() == 1 ){
                $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
                $ide ="";
                for($i=0; $i<32; $i++){
                    $ide.=substr($str, rand(0,strlen($str)-1),1);
                }
                $usuario=$usuario[0];
                $usuario->ide = $ide;
                if($usuario->save()){
                    $data=array(
                        'ide' => $usuario->ide
                    );
                    session($data);
                    return $next($request);
                }
                else{
                    return redirect('login.html');
                }
            }
        else{
            return redirect('login.html');
        }
        }
    else{
        return redirect('login.html');
    }
    }
}
                