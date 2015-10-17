<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class tipoGaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
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
        $nombre = $request->nombre;
        if(trim($nombre) != "" ){
            if(\DB::statement('CALL add_tipo_galeria("' . $nombre . '")')){
                // correcto
            }
            else{
                // incorrecto
            }
        }
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
    public function update(Request $request, $id){
        $nombre = $request->nombre;
        if( trim($nombre) != "" ){
            if(\DB::statement('CALL up_tipo_galeria(' . $id . ', "' . $nombre . '")')){
                // correcto
            }
            else{
                // incorrecto
            }
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(\DB::statement('CALL del_tipo_galeria(' . $id . ')')){
            // correcto
        }
        else{
            // incorrecto
        }
        //
    }
}
