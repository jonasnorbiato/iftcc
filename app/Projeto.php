<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $table='projetos';
 	protected $primaryKey='id_projeto';
    protected $fillable=['status','titulo','ano','id_data_apresentacao_fk', 'id_curso_fk'];
   	public $timestamps =false;

  	public function aluno()
	{
		return $this->hasMany('App\Aluno', 'id_projeto_fk', 'id_projeto');
	}

	public function banca(){
		return $this->hasMany('App\Banca','id_projeto_fk', 'id_projeto');
	}

	public function dataapresentacao()
	{
		return $this->hasOne('App\DataApresentacao', 'id_data_apresentacao', 'id_data_apresentacao_fk');
	}

	public function curso()
	{
		return $this->hasOne('App\Curso', 'id_curso', 'id_curso_fk');
	}

   	
}


