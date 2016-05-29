<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        session()->flush();
        return view('admin.login');
        return "Raul, cuál es la vista de loggin?<br>Cuando quieras cerrar sesión, no olvides direccionar a 'login.html'.<br>Necesito que me mandes las variables: usuario y psw para iniciar sesión.<br>Fin del comunicado, recuerde encantar las ratas con la música del código =)";
        //
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
    public function store(Request $request){
        $usuario = $request->usuario;
        $psw = $request->psw;
        if(trim($usuario) != "" && $psw != ""){
            $psw = md5($psw);
            $usuario = \App\usuario::where('nick','=',$usuario)->where('psw','=',$psw)->get();
            if($usuario->count() == 1){
                $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
                $ide ="";
                for($i=0; $i<32; $i++){
                    $ide.=substr($str, rand(0,strlen($str)-1),1);
                }
                $usuario = $usuario[0];
                $usuario->ide = $ide;
                if($usuario->save()){
                    $data=array(
                        'nombre' => $usuario->nombre,
                        'nick' => $usuario->nick,
                        'ide' => $usuario->ide
                    );
                    session($data);
                    return redirect('/admin');
                }
                else{
                    return redirect('/login.html');
                }
            }
        else{
            return redirect('/login.html');
        }
        }
    else{
        return redirect('/login.html');
    }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(){
        session()->flush();
        return redirect('/login.html');
        //
    }
}
