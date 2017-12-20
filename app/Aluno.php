<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
 	protected $table='alunos';
 	protected $primaryKey='id_aluno';
 	protected $fillable=['nome_aluno',				 		
				 		'email_aluno',
				 		'id_usuario_fk', 
				 		'id_curso_fk', 
				 		'id_projeto_fk'];
	public $timestamps = false;


	public function usuario()
	{
		return $this->hasOne('App\User', 'id_usuario', 'id_usuario_fk');
	}


	public function curso()
	{
		return $this->hasOne('App\Curso', 'id_curso', 'id_curso_fk');
	}


	public function projeto()
	{
		return $this->hasOne('App\Projeto', 'id_projeto', 'id_projeto_fk');
	}
}
