<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = ['login','password'];
    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function coordenador()
    {
        return $this->hasOne('App\Coordenador', 'id_usuario_fk' , 'id_usuario');
    }

     public function administrador()
     {
        return $this->hasOne('App\Administrador', 'id_usuario_fk', 'id_usuario');
     }

     public function aluno()
     {
        return $this->hasOne('App\Aluno', 'id_usuario_fk', 'id_usuario');  
     }

     /**
     * Verifica se o usuário é administrador
     * @return boolean
     */
    public function isAdmin()
    {
        return count($this->administrador) == 1 ? true : false;
    }

    /**
     * Verifica se o usuário é aluno
     * @return boolean
     */
    public function isAluno()
    {
        return count($this->aluno) == 1 ? true : false;
    }

    /**
     * Verifica se o usuário é administrador
     * @return boolean
     */
    public function isCoordenador()
    {
        return count($this->coordenador) == 1 ? true : false;
    }



    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
        // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }


    

}
