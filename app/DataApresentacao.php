<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataApresentacao extends Model
{
	protected $table='dataapresentacoes';
 	protected $primaryKey='id_data_apresentacao';
 	protected $fillable=['data_hora'];
	public $timestamps = false;


	public function projeto()
	{
		return $this->hasMany('App\Projeto', 'id_data_apresentacao_fk', 'id_data_apresentacao');
	}
	

	public function curso_dataapresentacao()
	{
		return $this->hasMany('App\Curso','id_data_apresentacao_fk', 'id_data_apresentacao');
	}	
}


