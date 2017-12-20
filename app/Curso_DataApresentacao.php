<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class curso_dataapresentacao extends Model
{	protected $table= 'cursos_dataapresentacoes';
	protected $primaryKey = ['id_curso_fk', 'id_data_apresentacao_fk'];
	public $incrementing = false;
	protected $fillable = ['id_curso_fk', 'id_data_apresentacao_fk'];
	public $timestamps = false; 

	public function curso()
	{
		return $this->hasOne('App\Curso', 'id_curso', 'id_curso_fk');
	}


	public function dataapresentacao()
	{
		return $this->hasOne('App\DataApresnetacao', 'id_data_apresentacao_', 'id_data_apresentacao_fk');
	}
	



}