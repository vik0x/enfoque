<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_galeria extends Model{
	protected $primaryKey = 'id_tipo_galeria';
	protected $table = 'tipo_galeria';//Nombre de la tabla
	protected $fillable = ['nombre', 'activo'];//Campos que pueden ser modificados (en caso de que necesite hacer un movimiento con laravel)
	public $timestamps = false; //si no existen los campos created_at y updated_at se pone false para queno haya errores 
    //
}
