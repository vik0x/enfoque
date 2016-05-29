<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class publicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // dd(\Request::url());
        $url = explode("/", \Request::url());
        $url = end($url);
        $publicidad = \App\publicidad::where('activo','=',1)->where('seccion','=',0)->orderBy('posicion')->get();
        $publiSlider = \App\publicidad::where('activo','=',1)->limit(6)->where('seccion','=',-1)->orderBy('posicion')->get();
        $total = 12 - $publicidad->count();
        $galeria = \App\galeria::select(\DB::raw('DISTINCT galeria.id_galeria as id'),\DB::raw('DATE(galeria.fecha_subida) as fecha'),'galeria.portada','galeria.nombre','galeria.descripcion','galeria.activo','galeria.step','v.cantidad as cantidad_video','i.cantidad as cantidad_imagen','galeria.id_tipo_galeria as id_tipo')
            ->leftJoin(\DB::raw('(SELECT id_galeria,COUNT(id_elemento) as cantidad FROM elemento WHERE tipo_elemento = 2 GROUP BY id_galeria) as v'),'v.id_galeria','=','galeria.id_galeria')
            ->leftJoin(\DB::raw('(SELECT id_galeria,COUNT(id_elemento) as cantidad FROM elemento WHERE tipo_elemento = 1 GROUP BY id_galeria) as i'),'i.id_galeria','=','galeria.id_galeria')
            ->join('tipo_galeria as tg','tg.id_tipo_galeria','=','galeria.id_tipo_galeria')
            ->where('tg.activo','=',1)
            ->orderBy('galeria.activo','desc')
            ->orderBy('galeria.fecha_subida','desc')
            // ->limit($total)
            ->paginate(12);

        $datos = array();
        foreach($galeria as $val)
            $datos[] = $val->id_tipo;
        $data=array(
            'categorias' => \DB::table('tipo_galeria')->select('id_tipo_galeria as id','nombre')->where('activo','=',1)->whereIn('tipo_galeria.id_tipo_galeria',$datos)->get(),
            'galeria'=>$galeria,
            'publiSlider'=>$publiSlider,
        );
        // dd($data);
        switch($url){
            case 'index.html':
                $data['publicidad']=$publicidad;
                return view('inicio',$data);
                break;
            case 'galerias.html':
                return view('public.galerias',$data);
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function galerias(){
        $galerias = \App\galeria::select('id_tipo_galeria as id')->get();
        $datos = array();
        foreach($galerias as $val)
            $datos[] = $val->id;
        
        $data = array(
            'galerias'=>\App\galeria::paginate(12),
            'categorias'=>\DB::table('tipo_galeria')->select('id_tipo_galeria as id','nombre')->where('activo','=',1)->whereIn('tipo_galeria.id_tipo_galeria',$datos)->get(),
        );
        // dd($data);
        return view('public.galerias',$data);
    }
    public function video(){
        $video = \App\elemento::where('tipo_elemento','=',2)->where('activo','=',-1)->paginate(12);
        $data = array(
            'videos' => $video,
        );
        return view('public.videos',$data);
    }
    public function recursos($id){
        $imagenes = \App\elemento::where('tipo_elemento','=',1)->where('id_galeria','=',$id)->get();
        $videos = \App\elemento::where('tipo_elemento','=',2)->where('id_galeria','=',$id)->get();
        $galerias = \App\galeria::select('id_tipo_galeria as id')->get();
        $datos = array();
        foreach($galerias as $val)
            $datos[] = $val->id;
        $data = array(
            'categorias' => \DB::table('tipo_galeria')->select('id_tipo_galeria as id','nombre')->where('activo','=',1)->whereIn('tipo_galeria.id_tipo_galeria',$datos)->get(),
            'videos' => $videos,
            'imagenes' => $imagenes,
        );
        // dd($data);
        return view('public/galerias',$data);

    }
    public function show($id){
        $galeria = \App\galeria::select(\DB::raw('DISTINCT galeria.id_galeria as id'),\DB::raw('DATE(galeria.fecha_subida) as fecha'),'galeria.portada','galeria.nombre','galeria.descripcion','galeria.activo','galeria.step','v.cantidad as cantidad_video','i.cantidad as cantidad_imagen')
            ->leftJoin(\DB::raw('(SELECT id_galeria,COUNT(id_elemento) as cantidad FROM elemento WHERE tipo_elemento = 2 GROUP BY id_galeria) as v'),'v.id_galeria','=','galeria.id_galeria')
            ->leftJoin(\DB::raw('(SELECT id_galeria,COUNT(id_elemento) as cantidad FROM elemento WHERE tipo_elemento = 1 GROUP BY id_galeria) as i'),'i.id_galeria','=','galeria.id_galeria')
            ->orderBy('galeria.activo','desc')
            ->orderBy('galeria.fecha_subida','desc')
            ->where('galeria.id_tipo_galeria','=',$id)
            ->paginate(12);
            // ->toSql();
            // dd($galeria);
            $galerias = \App\galeria::select('id_tipo_galeria as id')->get();
            $datos = array();
            foreach($galerias as $val)
                $datos[] = $val->id;
        $categorias = \DB::table('tipo_galeria')->select('id_tipo_galeria as id','nombre')->where('activo','=',1)->whereIn('tipo_galeria.id_tipo_galeria',$datos)->get();
        $publiSlider = \App\publicidad::where('activo','=',1)->limit(6)->where('seccion','=',$id)->orderBy('posicion')->get();
        if($galeria->count()>0){
            $data=array(
                'galeria'=>$galeria,
                'categorias'=>$categorias,
                'publiSlider'=>$publiSlider,
            );
        }
        else{
            $data = array(
                'categorias'=>$categorias,
                'publiSlider'=>$publiSlider,
            );
        }
        return view('inicio',$data);
        //
    }

    public function conocenos(){
        $galerias = \App\galeria::select('id_tipo_galeria as id')->get();
        $datos = array();
        foreach($galerias as $val)
            $datos[] = $val->id;
        return view('public/conocenos',['categorias' => \DB::table('tipo_galeria')->select('id_tipo_galeria as id','nombre')->where('activo','=',1)->whereIn('tipo_galeria.id_tipo_galeria',$datos)->get()]);
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
    public function destroy($id)
    {
        //
    }
}
