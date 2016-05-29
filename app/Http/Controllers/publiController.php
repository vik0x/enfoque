<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class publiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        echo json_encode(\App\publicidad::get());
        // return view('admin.publicidades',$data);

    }
    public function index2(){
        $data=['publicidades'=>\App\publicidad::leftJoin('tipo_galeria as tg','tg.id_tipo_galeria','=','publicidad.seccion')->select('id_publicidad','cliente',\DB::raw('DATE(fecha_inicio) as fecha_inicio'),'tg.nombre as seccion','posicion','url','link','publicidad.activo')->get(),'categorias' => \App\tipo_galeria::select('id_tipo_galeria as id','nombre')->get()];
        // dd($data);
        return view('admin.publicidades',$data);
        // return view('admin.publicidades',$data);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // dd($request->file());
        // dd($request->input());
        if($request->hasFile('url')){
            $archivo = $request->file('url');
            $ext = $archivo->getClientOriginalExtension();
            if(mb_strtolower($ext) == "jpg" || mb_strtolower($ext) == "png" || mb_strtolower($ext) == "jpeg"){
                $nombre = "";
                $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                for($i=0;$i<16;$i++){
                    $nombre.=substr($str,rand(0,strlen($str)),1);
                }
                $nombrem = $nombre . "_movil";
                $nombre .= "." . $ext;

                $folder = str_replace(" ", "_",'/assets/publicidad/' . date('M').'/');
                if(!file_exists(getcwd() . $folder))
                    mkdir(getcwd().$folder,0777,true);

                if($archivo->move(getcwd().$folder,$nombre)){
                    if($request->hasFile('url_movil')){
                        $archivom = $request->file('url_movil');
                        $extm = $archivom->getClientOriginalExtension();
                        if(mb_strtolower($extm) == "jpg" || mb_strtolower($extm) == "png" || mb_strtolower($extm) == "jpeg"){
                            $nombrem .= "." . $extm;
                            if(!$archivom->move(getcwd().$folder,$nombrem)){
                                echo "La versión movil no se suvió";
                            }
                        }
                    }
                    $cliente = $request->nombre;
                    $posicion = $request->posicion;
                    $seccion = $request->categoria;
                    $url = $folder.$nombre;
                    $link = $request->link;
                    if(trim($cliente) != "" && trim($url) != "" && trim($link) != "" ){
                        if(\DB::statement('CALL add_publicidad("' . $cliente . '",' . $posicion . ',' . $seccion . ',"' . $url . '","' . $link . '");')){
                            echo "Guardada";
                        }
                        else{
                            echo "Por elmomento no fue posible guardar la imagen, intentelo de nuevo.";
                        }
                    }
                    else{
                        echo "Falta información";
                    }
                }
                else{
                    echo "No pudo ser almacenada laimagen";
                }
                
            }
            else{
                echo "Extensión de archivo incorrecta";
            }
        }
        // insert into publicidad (cliente, fecha_inicio, posicion, seccion, url, link, activo) values (ncliente, now(), nposicion,  nseccion, nurl, nlink, 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $publicidad = \App\publicidad::find($id);
        echo json_encode($publicidad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $cliente = $request->nombre;
        $posicion = $request->posicion;
        $seccion = $request->categoria;
        $link = $request->link;

        $publicidad = \App\publicidad::find($id);
        $publicidad->cliente = (trim($cliente) != "") ? $cliente : $publicidad->$cliente;
        $publicidad->posicion = (trim($posicion) != "") ? $posicion : $publicidad->$posicion;
        $publicidad->seccion = (trim($seccion) != "") ? $seccion : $publicidad->$seccion;
        $publicidad->link = (trim($link) != "") ? $link : $publicidad->$link;

        
        if($request->hasFile('url')){
            $archivo = $request->file('url');
            $ext = $archivo->getClientOriginalExtension();
            if(mb_strtolower($ext) == "jpg" || mb_strtolower($ext) == "png" || mb_strtolower($ext) == "jpeg"){
                $nombre = "";
                $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                for($i=0;$i<16;$i++){
                    $nombre.=substr($str,rand(0,strlen($str)),1);
                }
                $nombre .= "." . $ext;

                $folder = explode("/", $publicidad->url);
                array_pop($folder);
                $folder = implode("/", $folder) . "/";
                if(!file_exists(getcwd() . $folder))
                    mkdir(getcwd().$folder,0777,true);

                if($archivo->move(getcwd().$folder,$nombre)){
                    if(file_exists(getcwd() . $publicidad->url))
                        unlink(getcwd() . $publicidad->url);
                    $publicidad->url = $folder.$nombre;
                }
                else{
                    echo "No pudo ser almacenada laimagen";
                }
                
            }
            else{
                echo "Extensión de archivo incorrecta";
            }
        }
        if($publicidad->save())
            echo "Información modificada correctamente";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if((int)$id > 0 ){
            $publicidad = \App\publicidad::find($id);
            $publicidad->delete();
        }
    }
}
