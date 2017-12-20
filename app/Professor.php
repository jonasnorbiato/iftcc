<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
	protected $table='professores';
 	protected $primaryKey='id_professor';
 	protected $fillable=['nome_professor','sobrenome_professor','email_professor'];
	public $timestamps = false;


	// public function usuario(){
	// 	return $this->belongsTo('App\Usuario');
	// }

	public function coordenador()
	{
		return $this->hasOne('App\Coordenador', 'id_professor_fk' , 'id_professor');
	}

	public function banca()
	{
		return $this->hasMany('App\Banca', 'id_professor_fk', 'id_professor');
	}

	public function curso_professor()
	{
		return $this->hasMany('App\Curso_Professor', 'id_professor_fk', 'id_professor');
	}



	// public function administrador(){
	// 	return $this->hasMany('App\Administrador');
	// }

	// public function curso(){
	// 	return $this->belongsToMany('App\Curso','cursos_professores','id_cursos_fk', 'id_professor_fk');
	// }	



}
