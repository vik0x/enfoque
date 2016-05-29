<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model{
	protected $primaryKey = 'id_usuario';
	protected $table = 'usuario';//Nombre de la tabla
	protected $fillable = ['nombre','nick','correo','psw','foto','activo','ide'];//Campos que pueden ser modificados (en caso de que necesite hacer un movimiento con laravel)
	public $timestamps = false; 
}

