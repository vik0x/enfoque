<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\tipo_galeria;

class tipoGaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data=array(
            'categorias'=>\App\tipo_galeria::select('id_tipo_galeria as id','nombre')->orderBy('activo','desc')->orderBy('nombre')->where('id_tipo_galeria','>',0)->paginate(15),
        );
        return view('admin.categorias',$data);
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
        $data = array();
        $categoria = new tipo_galeria;
        if(trim($nombre) != "" ){
            $categoria->nombre = $nombre;
            $categoria->activo = 1;
            if($categoria->save()){
                $data['id'] = $categoria->id_tipo_galeria;
                $data['mensaje'] = "La categoría se agregó correctamente";
                $data['error'] = FALSE;
            }
            else{
                $data['mensaje'] = "La categoría no pudo ser agregada";
                $data['error'] = TRUE;
            }
        }
        echo json_encode($data);    
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
