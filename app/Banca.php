<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banca extends Model
{
    protected $table = 'bancas';
	protected $primaryKey = ['id_professor_fk', 'id_projeto_fk'];
    public $incrementing = false;
	protected $fillable = [
      'id_projeto_fk',
      'id_professor_fk'
    ];
	public $timestamps = false;


	public function professor()
    {
    	return $this->hasOne('App\Professor', 'id_professor', 'id_professor_fk');
    }

    public function projeto()
    {
    	return $this->hasOne('App\Projeto', 'id_projeto', 'id_projeto_fk');
    }
}
