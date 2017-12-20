<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Professor;

use App\Http\Requests;
use App\Curso_Professor;
use App\Coordenador;
use App\Curso;
use Validator;
use Auth;
use DB;
use User;

class ProfessorController extends Controller
{
	//COORDENADOR
	public function cadastrar()
	{
		$curso= Auth::user()->coordenador->id_curso_fk;
		$professores = DB::select("SELECT 
			    *
			FROM
			    cursos_professores cp
			        INNER JOIN
			    professores p ON p.id_professor = cp.id_professor_fk
			WHERE
			    id_professor_fk NOT IN (SELECT 
			            id_professor_fk
			        FROM
			            cursos_professores
			        WHERE
			            id_curso_fk = :curso);
			", ['curso' => $curso]);
	

		return view('coordenador.cadastrarProfessor', ['curso'=>$curso], ['professores' => $professores]);
	}

	public function inserir($id_curso)
	{	
		


		$op=\Request::get('data');	
		
		if (empty($op)) {
			\Session::flash('er', 'Escolha uma opção de professor.');
			return redirect('/coordenador/professor/cadastrar');
		}
		else{


			// cadastrar professor
			if ($op =='semana') 
			{
				$request=\Request::except('_token','data','professor');
				
				$validator= Validator::make($request,[
				'nome_professor' => 'required|max:35',
				'sobrenome_professor' => 'required|max:60',
				'email_professor' => 'required|max:50'
				]);


		 		if($validator->fails()){

		 			return redirect('/coordenador/professor/cadastrar')->withErrors($validator);

		 		}


			        DB::beginTransaction();
			        try
			        {

		 				$prof=Professor::create($request);
		 				Curso_Professor::create(['id_curso_fk'=>$id_curso, 'id_professor_fk' => $prof->id_professor]);
		 				DB::commit();
		 			}
		 			catch(\Exception $e)
			        {
            			DB::rollback();
        			}
		 	
			}

			// professor já cadastrado
			elseif ($op=='dia') 
			{
				
				$request=\Request::except('_token','data','nome_professor','sobrenome_professor','email_professor');
				
				$validator=Validator::make($request,[
	                  'professor' => 'required'
	               ]);
	            
	            if($validator->fails())
	            {

	               return redirect('/coordenador/professor/cadastrar')->withErrors($validator);
	            }

            	$professor=\Request::get('professor');

            	DB::beginTransaction();
		        try
		        {

	 			Curso_Professor::create(['id_curso_fk'=>$id_curso , 'id_professor_fk' => $professor]);
	 				DB::commit();
	 			}

	 			catch(\Exception $e)
		        {
        			DB::rollback();
    			}
				
				
			}



	 		\Session::flash('sucesso','Professor cadastrado com sucesso.');
			return redirect('/coordenador/professor/cadastrar');
		}
	}



    public function visualizar()
    {	
    	$user = Auth::user();

    	if ($user->isCoordenador()) {
    		
			$curso= $user->coordenador->id_curso_fk;
			$professores=DB::table('professores')
						->join('cursos_professores', 'cursos_professores.id_professor_fk', '=', 'professores.id_professor')
						->where('id_curso_fk', '=', $curso)->orderBy('nome_professor')->get();
			
			return view('coordenador.visualizarProfessor', ['professores' => $professores]);

    	}elseif ($user->isAluno()) {
	    	$curso= $user->aluno->id_curso_fk;
			$professores=DB::table('professores')
						->join('cursos_professores', 'cursos_professores.id_professor_fk', '=', 'professores.id_professor')
						->where('id_curso_fk', '=', $curso)->orderBy('nome_professor')->get();
			
			return view('aluno.visualizarProfessor', ['professores' => $professores]);
    		
    	}

    }

    public function editar($id_professor)
    {
    	$professor=Professor::find($id_professor);
    	$verifica_curso=Curso_Professor::where('id_professor_fk', '=', $id_professor)->count();
    	if ($verifica_curso == 1) {
    		return view('coordenador.editarProfessor', ['professor'=>$professor]);
    	}
    	elseif ($verifica_curso>1) {
    		\Session::flash('er', 'Não é possível atualizar o professor '.$professor->nome_professor. ', pois ele pertence também a outro curso.');
    		return redirect('/coordenador/professor/visualizar');
    	}
    	
    }

    public function salvar($id_professor)
    {
    	$request=\Request::except('_token');   	
		$validator= Validator::make($request,[
			'nome_professor' => 'required|max:35',
			'sobrenome_professor' => 'required|max:60',
			'email_professor' => 'required|max:50'
		]);

		if($validator->fails())
        {
           return redirect(url('/coordenador/professor/editar',$id_professor))->withErrors($validator);
        }

        $professor=Professor::find($id_professor);

        DB::beginTransaction();
        try
        {
        	$professor->update($request);
        	DB::commit();
        }
        catch(\Exception $e)
        {
			DB::rollback();
			\Session::flash('er', 'Não foi possível atualizar o professor.');
    		return redirect(url('/coordenador/professor/editar',$id_professor));			
		}
    	\Session::flash('sucesso', 'Professor '.$professor->nome_professor. ' atualizado.');
    	return redirect('/coordenador/professor/visualizar');
    }

    public function excluir($id_professor)
    {
    	$curso= Auth::user()->coordenador->id_curso_fk;
    	$professor=Professor::find($id_professor);
    	$verifica_coordenador=Coordenador::where('id_professor_fk', '=', $id_professor)->where('id_curso_fk', '=', $curso)->count();
    	if (!(empty($verifica_coordenador))) {
    		\Session::flash('er', 'Coordenador não pode ser.');
	    		return redirect('/coordenador/professor/visualizar');	
    	}

    	$verifica_curso=Curso_Professor::where('id_professor_fk', '=', $id_professor)->count();
    	if ($verifica_curso==1) 
    	{
    		DB::beginTransaction();
    		try 
    		{			
	    		$professor->delete();
				DB::commit();
    		} 
    		catch (Exception $e) 
    		{
				DB::rollback();
				\Session::flash('er', 'Não foi possível excluir o professor.');
	    		return redirect('/coordenador/professor/visualizar');				
    		}
    	}
    	elseif ($verifica_curso>1)
    	{
    		$relacionamento_apagar=Curso_Professor::where('id_professor_fk', '=', $id_professor)->where('id_curso_fk', '=', $curso)->get();
    		DB::beginTransaction();
    		try 
    		{		
	    		DB::table('cursos_professores')->where('id_professor_fk', '=', $id_professor)->where('id_curso_fk', '=', $curso)->delete();
				DB::commit();
    		} 
    		catch (Exception $e) 
    		{

				DB::rollback();
				\Session::flash('er', 'Não foi possível excluir o professor.');
	    		return redirect('/coordenador/professor/visualizar');				
    		}		
    	}

    	
    	\Session::flash('sucesso', 'Professor excluído.');
    	return redirect('/coordenador/professor/visualizar');
    }

}

