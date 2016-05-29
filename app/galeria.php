<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class galeria extends Model{
	protected $primaryKey = 'id_galeria';
	protected $table = 'galeria';//Nombre de la tabla
	protected $fillable = ['id_tipo_galeria', 'portada', 'nombre', 'descripcion','activo','fecha_subida','step'];//Campos que pueden ser modificados (en caso de que necesite hacer un movimiento con laravel)
	public $timestamps = false; //si no existen los campos created_at y updated_at se pone false para queno haya errores 
}