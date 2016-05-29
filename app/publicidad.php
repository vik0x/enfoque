<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class publicidad extends Model{
	protected $primaryKey = 'id_publicidad';
	protected $table = 'publicidad';//Nombre de la tabla
	protected $fillable = ['id_publicidad','cliente','fecha_inicio','posicion','seccion','url','link','activo'];//Campos que pueden ser modificados (en caso de que necesite hacer un movimiento con laravel)
	public $timestamps = false; //si no existen los campos created_at y updated_at se pone false para queno haya errores 
    //
}
