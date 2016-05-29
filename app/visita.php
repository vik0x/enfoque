<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class visita extends Model
{
	protected $primaryKey = 'id_visita';
	protected $table = 'visita';//Nombre de la tabla
	protected $fillable = ['ip', 'contador'];//Campos que pueden ser modificados (en caso de que necesite hacer un movimiento con laravel)
    //
}
