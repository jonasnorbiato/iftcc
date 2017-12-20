<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordenador extends Model
{
    protected $table = 'coordenadores';
	protected $primaryKey = ['id_usuario_fk', 'id_professor_fk'];
    public $incrementing = false;
	protected $fillable = [
      'id_usuario_fk',
      'id_professor_fk',
      'id_curso_fk'
    ];
	public $timestamps = false;


	public function professor()
	{
		return $this->hasOne('App\Professor', 'id_professor', 'id_professor_fk');
	}


	public function usuario()
	{
		return $this->hasOne('App\User', 'id_usuario', 'id_usuario_fk');
	}

	public function curso()
	{
		return $this->hasOne('App\Curso', 'id_curso', 'id_curso_fk');
	}


}
