<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class curso_professor extends Model
{
	protected $table='cursos_professores';
	protected $primaryKey =['id_curso_fk','id_professor_fk'] ;
    public $incrementing = false;
	protected $fillable=['id_curso_fk','id_professor_fk'];
    public $timestamps = false;


    public function curso()
    {
    	return $this->hasOne('App\Curso', 'id_curso', 'id_curso_fk');
    }


    public function professor()
    {
    	return $this->hasOne('App\Professor', 'id_professor', 'id_professor_fk');
    }

}
