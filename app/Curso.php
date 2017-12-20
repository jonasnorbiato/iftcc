<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
 	protected $table='cursos';
 	protected $primaryKey='id_curso';
 	protected $fillable=['nome_curso'];
	public $timestamps = false;

	public function aluno()
	{
		return $this->hasMany('App\Aluno', 'id_curso_fk' , 'id_curso');
	}

	public function curso_dataapresentacao()
	{
		return $this->hasMany('App\Curso_DataApresentacao', 'id_cursos_fk', 'id_curso');
	}	

	public function curso_professor()
	{
		return $this->hasMany('App\Curso_Professor', 'id_curso_fk', 'id_curso');
	}

	public function coordenador()	
	{
		return $this->hasOne('App\Coordenador', 'id_curso_fk', 'id_curso');
	}


	public function projeto()
	{
		return $this->hasMany('App\Projeto', 'id_curso_fk', 'id_curso');
	}

}
