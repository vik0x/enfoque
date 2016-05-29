<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use galeria;
class galeriaController extends Controller{

    public function index(){
        $galeria = \App\galeria::select(\DB::raw('DISTINCT galeria.id_galeria as id'),'galeria.portada','galeria.nombre','galeria.descripcion','galeria.activo','galeria.step','v.cantidad as cantidad_video','i.cantidad as cantidad_imagen')
            ->leftJoin(\DB::raw('(SELECT id_galeria,COUNT(id_elemento) as cantidad FROM elemento WHERE tipo_elemento = 2 GROUP BY id_galeria) as v'),'v.id_galeria','=','galeria.id_galeria')
            ->leftJoin(\DB::raw('(SELECT id_galeria,COUNT(id_elemento) as cantidad FROM elemento WHERE tipo_elemento = 1 GROUP BY id_galeria) as i'),'i.id_galeria','=','galeria.id_galeria')
            ->orderBy('galeria.activo','desc')
            ->orderBy('galeria.fecha_subida','desc')
            ->paginate(16);
            // ->toSql();dd($galeria);
        // dd($galeria);
        $data = array(
            'publicidad' => \App\tipo_galeria::paginate(10),
            'categorias' => \DB::table('tipo_galeria')->select('id_tipo_galeria as id','nombre')->where('activo','=',1)->where('id_tipo_galeria','>',0)->get(),
            'galeria' => $galeria,
        );
        // $cantidad_videos = \DB::table('elemento as vid')->select(\DB::raw('COUNT(id_elemento) as cantidad)
        return view('admin.galerias',$data);
        //
    }

    public function create(){
        //
    }

    public function storePrincipal(Request $request){
        $nombre = $request->titulo;
        $descripcion = $request->descripcion;
        $tipo = $request->tipo;
        if( trim($nombre) == "" || trim($descripcion) == "" || trim($tipo) == "" || (int)$tipo <= 0 ){
            $data['mensaje'] = "Falta información en el formulario";
            $data['error'] = TRUE;
        }
        else{
            if($id = \DB::select('CALL add_galeria(' . $tipo . ',"' . $nombre . '","' . $descripcion . '");')){
                $id = $id[0]->id_galeria;
                $data['mensaje'] = "Galería agregada correctamente";
                $data['error'] = FALSE;
                $data['id_galeria'] = $id;
            }
            else{
                $data['mensaje'] = "Error al agregar la galería";
                $data['error'] = TRUE;
            }
        }
        echo json_encode($data);
    }
    public function storePortada(Request $request){
        // dd($request->hasFile('portada'));
        $id = $request->id_galeria;
        if((int)$id > 0 && $request->hasFile('portada')){
            $archivo = $request->file('portada');
            $ext = strtolower($archivo->getClientOriginalExtension());
            if($ext == "jpg" || $ext == 'jpeg' || $ext == "png"){
                $carpeta = \App\galeria::select(\DB::raw('CONCAT(nombre,id_galeria) as nombre'))->find($id);
                $carpeta = $carpeta->nombre;
                $carpeta = str_replace(" ", "_",'/assets/images/' . $carpeta . '/');
                if(!file_exists(getcwd() . $carpeta))
                    mkdir(getcwd() . $carpeta,0777,true);
                $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
                do{
                    $nombre = "";
                    for( $i=0; $i<=15; $i++)
                        $nombre .= substr($str,rand(0,strlen($str)-1),1);
                    $nombre2 = $nombre . "_2." . $ext;
                    $nombre .= "." . $ext;
                }while(file_exists(getcwd().$carpeta.$nombre));
                if($archivo->move(getcwd() . $carpeta , $nombre)){
                    if(\DB::statement('CALL add_portada(' . $id . ',"' . $carpeta . $nombre . '");')){
                        echo json_encode(['portada' => $carpeta . $nombre]);
                    }
                    switch (mb_strtolower($ext)) {
                        case 'jpg' :
                            $imagen = imagecreatefromjpeg(getcwd() . $carpeta . $nombre);
                            $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                            $width = $imagesize[0];
                            $heigth = $imagesize[1];
                            $factor = $width/1024;
                            $width = $width/$factor;
                            $heigth = (int)($heigth/$factor);
                            $imagesave = imagescale($imagen,$width,$heigth);
                            imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                            imagedestroy($imagesave);
                            imagedestroy($imagen);
                        break;
                        case 'jpeg':
                            $imagen = imagecreatefromjpeg(getcwd() . $carpeta . $nombre);
                            $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                            $width = $imagesize[0];
                            $heigth = $imagesize[1];
                            $factor = $width/1024;
                            $width = $width/$factor;
                            $heigth = (int)($heigth/$factor);
                            $imagesave = imagescale($imagen,$width,$heigth);
                            imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                            imagedestroy($imagesave);
                            imagedestroy($imagen);
                        break;
                        case 'png':
                            $imagen = imagecreatefrompng(getcwd() . $carpeta . $nombre);
                            $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                            $width = $imagesize[0];
                            $heigth = $imagesize[1];
                            $factor = $width/1024;
                            $width = $width/$factor;
                            $heigth = (int)($heigth/$factor);
                            $imagesave = imagescale($imagen,$width,$heigth);
                            imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                            imagedestroy($imagesave);
                            imagedestroy($imagen);
                        break;
                    }
                }
            }
        }
    }
    public function storeVideos(Request $request){
        $id = $request->id_galeria;
        $videos = $request->videos;

        dd($request->input());

        $galeria = \App\galeria::find($id);
        $galeria->step = 3;
        $galeria->save();

        if((int)$id > 0 && is_array($videos)){
            $data=array();
            foreach($videos as $val){
                $data[] = array(
                    'id_galeria'=>$id,
                    'titulo'=>$val['titulo'],
                    'tipo_elemento'=>2,
                    'url'=>$val['url'],
                );
            }
            \DB::table('elemento')->insert($data);
        }
    }
    public function store(Request $request){
        // dd($request->file());
        $id = $request->id_galeria;
        $archivos = ($request->hasFile('imagenes') ? $request->file('imagenes') : FALSE);
        if((int)$id>0 && is_array($archivos)){
            foreach($archivos as $val){
                $archivo = $val;
                $ext = strtolower($archivo->getClientOriginalExtension());
                if($ext == "jpg" || $ext == 'jpeg' || $ext == "png"){
                    $carpeta = \App\galeria::select(\DB::raw('CONCAT(nombre,id_galeria) as nombre'))->find($id);
                    $carpeta = $carpeta->nombre;
                    $carpeta = str_replace(" ", "_",'/assets/images/' . $carpeta . '/');
                    if(!file_exists(getcwd() . $carpeta))
                        mkdir(getcwd() . $carpeta,0777,true);
                    $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
                    do{
                        $nombre = "";
                        for( $i=0; $i<=15; $i++)
                            $nombre .= substr($str,rand(0,strlen($str)-1),1);
                        $nombre2 = $nombre . "_2." . $ext;
                        $nombre .= "." . $ext;
                    }while(file_exists(getcwd().$carpeta.$nombre));
                    if($archivo->move(getcwd() . $carpeta , $nombre)){
                        $data[] = array(
                            'id_galeria'=>$id,
                            'tipo_elemento'=>1,
                            'url'=>$carpeta.$nombre,
                        );
                        switch (mb_strtolower($ext)) {
                            case 'jpg' :
                                $imagen = imagecreatefromjpeg(getcwd() . $carpeta . $nombre);
                                $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                                $width = $imagesize[0];
                                $heigth = $imagesize[1];
                                $factor = $width/1024;
                                $width = $width/$factor;
                                $heigth = (int)($heigth/$factor);
                                $imagesave = imagescale($imagen,$width,$heigth);
                                imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                                imagedestroy($imagesave);
                                imagedestroy($imagen);
                            break;
                            case 'jpeg':
                                $imagen = imagecreatefromjpeg(getcwd() . $carpeta . $nombre);
                                $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                                $width = $imagesize[0];
                                $heigth = $imagesize[1];
                                $factor = $width/1024;
                                $width = $width/$factor;
                                $heigth = (int)($heigth/$factor);
                                $imagesave = imagescale($imagen,$width,$heigth);
                                imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                                imagedestroy($imagesave);
                                imagedestroy($imagen);
                            break;
                            case 'png':
                                $imagen = imagecreatefrompng(getcwd() . $carpeta . $nombre);
                                $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                                $width = $imagesize[0];
                                $heigth = $imagesize[1];
                                $factor = $width/1024;
                                $width = $width/$factor;
                                $heigth = (int)($heigth/$factor);
                                $imagesave = imagescale($imagen,$width,$heigth);
                                imagepng($imagenimagesavegetcwd() . $carpeta . $nombre2,95);
                                imagedestroy($imagesave);
                                imagedestroy($imagen);
                            break;
                        }
                    }
                }
            }
            if(\DB::table('elemento')->insert($data)){
                $galeria = \App\galeria::find($id);
                $galeria->step = 4;
                $galeria->save();
            }
        }
    }

    public function show($id){
        //
    }

    public function edit(Request $request){
        $id = $request->id;
        $galeria = \App\galeria::find($id);
        $imagenes = \App\elemento::where('tipo_elemento','=',1)->where('id_galeria','=',$id)->get();
        $videos = \App\elemento::where('tipo_elemento','=',2)->where('id_galeria','=',$id)->get();
        $data = array(
            'galerias' => $galeria,
            'imagenes' => $imagenes,
            'videos' => $videos,
        );
        echo json_encode($data);
    }
    public function editCosa(Request $request){
        dd($request->input());
    }

    public function updatePrincipal(Request $request){
        $id = $request->id;
        $nombre = $request->titulo;
        $descripcion = $request->descripcion;
        $tipo = $request->tipo;
        if( trim($nombre) == "" || trim($descripcion) == "" || trim($tipo) == "" || (int)$tipo <= 0 || (int)$id <= 0 || trim($id) == ""){
            $data['mensaje'] = "Falta información en el formulario";
            $data['error'] = TRUE;
        }
        else{
            $galeria =\App\galeria::find($id);
            $galeria->id_tipo_galeria = $tipo;
            $galeria->nombre = $nombre;
            $galeria->descripcion = $descripcion;
            $galeria->step = ($galeria->step<=1) ? 1 : $galeria->step;
            if($galeria->save()){
                $data['mensaje'] = "Galería modificada correctamente";
                $data['error'] = FALSE;
                $data['id_galeria'] = $id;
            }
            else{
                $data['mensaje'] = "Error al modificar la galería";
                $data['error'] = TRUE;
            }
        }
        echo json_encode($data);
    }
    public function updatePortada(Request $request){
        $id = $request->id_galeria;
        if((int)$id > 0 && $request->hasFile('portada')){
            $archivo = $request->file('portada');
            $ext = strtolower($archivo->getClientOriginalExtension());
            if($ext == "jpg" || $ext == 'jpeg' || $ext == "png"){
                $carpeta = \App\galeria::select(\DB::raw('CONCAT(nombre,id_galeria) as nombre'))->find($id);
                $carpeta = $carpeta->nombre;
                $carpeta = str_replace(" ", "_",'/assets/images/' . $carpeta . '/');
                if(!file_exists(getcwd() . $carpeta))
                    mkdir(getcwd() . $carpeta,0777,true);
                $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
                do{
                    $nombre = "";
                    for( $i=0; $i<=15; $i++)
                        $nombre .= substr($str,rand(0,strlen($str)-1),1);
                    $nombre2 = $nombre . "_2." . $ext;
                    $nombre .= "." . $ext;
                }while(file_exists(getcwd().$carpeta.$nombre));
                if($archivo->move(getcwd() . $carpeta , $nombre)){
                    switch (mb_strtolower($ext)) {
                        case 'jpg' :
                            $imagen = imagecreatefromjpeg(getcwd() . $carpeta . $nombre);
                            $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                            $width = $imagesize[0];
                            $heigth = $imagesize[1];
                            $factor = $width/1024;
                            $width = $width/$factor;
                            $heigth = (int)($heigth/$factor);
                            $imagesave = imagescale($imagen,$width,$heigth);
                            imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                            imagedestroy($imagesave);
                            imagedestroy($imagen);
                        break;
                        case 'jpeg':
                            $imagen = imagecreatefromjpeg(getcwd() . $carpeta . $nombre);
                            $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                            $width = $imagesize[0];
                            $heigth = $imagesize[1];
                            $factor = $width/1024;
                            $width = $width/$factor;
                            $heigth = (int)($heigth/$factor);
                            $imagesave = imagescale($imagen,$width,$heigth);
                            imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                            imagedestroy($imagesave);
                            imagedestroy($imagen);
                        break;
                        case 'png':
                            $imagen = imagecreatefrompng(getcwd() . $carpeta . $nombre);
                            $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                            $width = $imagesize[0];
                            $heigth = $imagesize[1];
                            $factor = $width/1024;
                            $width = $width/$factor;
                            $heigth = (int)($heigth/$factor);
                            $imagesave = imagescale($imagen,$width,$heigth);
                            imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                            imagedestroy($imagesave);
                            imagedestroy($imagen);
                        break;
                    }
                    $galeria = \App\galeria::find($id);
                    if( !file_exists(getcwd() . $galeria->portada) )
                        unlink(getcwd() . $galeria->portada);
                    $galeria->portada = $carpeta . $nombre;
                    $galeria->step = ($galeria->step <= 2) ? 2 : $galeria->step;
                    if($galeria->save()){
                        echo json_encode(['portada' => $carpeta . $nombre]);
                    }
                    
                }
            }
        }
    }
    public function updateVideos(Request $request){
        // dd($request->input());
        $id = $request->id_galeria;
        $videos = $request->videos;
        $eliminar = $request->videosEliminados;

        $galeria = \App\galeria::find($id);
        $galeria->step = ($galeria->step <= 3) ? 3 : $galeria->step;
        $galeria->save();

        if((int)$id > 0 && is_array($eliminar)){
            $b=0;
            foreach($eliminar as $val){
                if($b==0){
                    $borrar = \App\elemento::where('id_elemento','=',$val);
                    $b++;
                }
                else
                    $borrar = $borrar->orWhere('id_elemento','=',$val);
            }
            $borrar->delete();
        }

        if((int)$id > 0 && is_array($videos)){
            $data=array();
            foreach($videos as $val){
                $data[] = array(
                    'id_galeria'=>$id,
                    'titulo'=>$val['titulo'],
                    'tipo_elemento'=>2,
                    'url'=>$val['url'],
                );
            }
            \DB::table('elemento')->insert($data);
        }
    }
    public function update(Request $request){
        // dd($request->file());
        $id = $request->id_galeria;
        $archivos = ($request->hasFile('imagenes') ? $request->file('imagenes') : FALSE);
        if((int)$id>0 && is_array($archivos)){
            foreach($archivos as $val){
                $archivo = $val;
                $ext = strtolower($archivo->getClientOriginalExtension());
                if($ext == "jpg" || $ext == 'jpeg' || $ext == "png"){
                    $carpeta = \App\galeria::select(\DB::raw('CONCAT(nombre,id_galeria) as nombre'))->find($id);
                    $carpeta = $carpeta->nombre;
                    $carpeta = str_replace(" ", "_",'/assets/images/' . $carpeta . '/');
                    if(!file_exists(getcwd() . $carpeta))
                        mkdir(getcwd() . $carpeta,0777,true);
                    $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
                    do{
                        $nombre = "";
                        for( $i=0; $i<=15; $i++)
                            $nombre .= substr($str,rand(0,strlen($str)-1),1);
                        $nombre2 = $nombre . "_2." . $ext;
                        $nombre .= "." . $ext;
                    }while(file_exists(getcwd().$carpeta.$nombre));
                    if($archivo->move(getcwd() . $carpeta , $nombre)){
                        $data[] = array(
                            'id_galeria'=>$id,
                            'tipo_elemento'=>1,
                            'url'=>$carpeta.$nombre,
                        );
                        switch (mb_strtolower($ext)) {
                            case 'jpg' :
                                $imagen = imagecreatefromjpeg(getcwd() . $carpeta . $nombre);
                                $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                                $width = $imagesize[0];
                                $heigth = $imagesize[1];
                                $factor = $width/1024;
                                $width = $width/$factor;
                                $heigth = (int)($heigth/$factor);
                                $imagesave = imagescale($imagen,$width,$heigth);
                                imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                                imagedestroy($imagesave);
                                imagedestroy($imagen);
                            break;
                            case 'jpeg':
                                $imagen = imagecreatefromjpeg(getcwd() . $carpeta . $nombre);
                                $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                                $width = $imagesize[0];
                                $heigth = $imagesize[1];
                                $factor = $width/1024;
                                $width = $width/$factor;
                                $heigth = (int)($heigth/$factor);
                                $imagesave = imagescale($imagen,$width,$heigth);
                                imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                                imagedestroy($imagesave);
                                imagedestroy($imagen);
                            break;
                            case 'png':
                                $imagen = imagecreatefrompng(getcwd() . $carpeta . $nombre);
                                $imagesize = getimagesize(getcwd(). $carpeta . $nombre);
                                $width = $imagesize[0];
                                $heigth = $imagesize[1];
                                $factor = $width/1024;
                                $width = $width/$factor;
                                $heigth = (int)($heigth/$factor);
                                $imagesave = imagescale($imagen,$width,$heigth);
                                imagejpeg($imagesave,getcwd() . $carpeta . $nombre2,95);
                                imagedestroy($imagesave);
                                imagedestroy($imagen);
                            break;
                        }
                    }
                }
            }
            if(\DB::table('elemento')->insert($data)){
                $galeria = \App\galeria::find($id);
                $galeria->step = 4;
                $galeria->save();
            }
        }
    }

    public function destroy(Request $request){
        $id = $request->id;
        $imagenes = \App\elemento::where('tipo_elemento','=',1)->where('id_galeria','=',$id)->get();
        $portada = \App\galeria::find($id);
        $portada = $portada->portada;
        if(\DB::statement('CALL del_galeria(' . $id . ')')){
            foreach($imagenes as $val){
                if(file_exists(getcwd() . $val->url)){
                    echo getcwd() . $val->url;
                    unlink(getcwd() . $val->url);
                }
            }
        }
        if(file_exists(getcwd() . $portada))
            unlink(getcwd() . $portada);
        $portada = explode("/",($portada));
        array_pop($portada);
        $portada= implode("/", $portada);
        rmdir(getcwd().$portada);
    }
    public function destroyImg(Request $request){
        if($request->has('imagenesEliminadas')){
            foreach($request->imagenesEliminadas as $val){
                $id = $val;
                if((int)$id > 0 || trim($id) != "" ){
                    $imagen = \App\elemento::find($id);
                    if(file_exists($imagen->url)){
                        unlink($imagen->url);
                    }
                    $imagen->delete();
                }
            }
        }
            
    }
}
