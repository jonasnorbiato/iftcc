<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
	protected $table = 'administradores';
   	protected $primaryKey = 'id_usuario_fk';
   	protected $fillable = ['id_usuario_fk' , 'email_administrador'];
   	public $timestamps = false;

   	public function usuario()
   	{
   		return $this->hasOne('App\User', 'id_usuario', 'id_usuario_fk');
   	}
}
