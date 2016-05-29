<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class elemento extends Model{
	protected $primaryKey = 'id_elemento';
	protected $table = 'elemento';//Nombre de la tabla
	protected $fillable = ['tipo_elemento', 'url', 'activo','id_galeria','titulo'];//Campos que pueden ser modificados (en caso de que necesite hacer un movimiento con laravel)
	public $timestamps = false; //si no existen los campos created_at y updated_at se pone false para queno haya errores 
}