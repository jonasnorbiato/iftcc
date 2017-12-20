<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use  DB;

class HomeController extends Controller
{
    public function inicio()
    {	

    	$user = Auth::user();

    	if($user->isAluno())
    	{	
    		if($user->aluno->id_projeto_fk ==null)
            {
				return view('home');    			
    		}
    		$id_projeto=$user->aluno->projeto->id_projeto;
    		$bancas=DB::table('bancas')
        	->join('professores', 'id_professor', '=', 'id_professor_fk')
        	->where('id_projeto_fk', '=', $id_projeto)->get();
        	return view('aluno.home',['bancas' => $bancas]);
    	}

        if($user->isAdmin())
        {
            return view('administrador.home');
        }

        if($user->isCoordenador())
        {
            return view('coordenador.home');
        }
    	
    }

}
