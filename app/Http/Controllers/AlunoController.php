<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use DB;
use App\Aluno;
use App\User;
use Auth;
use App\Curso;
use Storage;


class AlunoController extends Controller
{

    // COORDENADOR
    public function cadastrar()
    {   $curso=Auth::user()->coordenador->id_curso_fk;

        return view('coordenador.cadastrarAluno', ['curso' =>$curso]);
    }

    public function inserir($id_curso)
    {
        $request=\Request::except('_token');
        $validador = Validator::make($request, [
            'nome_aluno' => 'required|max:100',            
            'email_aluno' => 'max:50',
            'login' => 'required|max:30|unique:usuarios,login'
        ]);

        if($validador->fails())
            return redirect('/coordenador/aluno/cadastrar')->withErrors($validador);
        
        $aluno=\Request::except('_token', 'login');
        $login=\Request::get('login');
        $nome_aluno=\Request::get('nome_aluno');
        $email_aluno=\Request::get('email_aluno');

        DB::beginTransaction();
        try
        {
            $user=User::create(['login'=>$login, 'password'=>bcrypt($login)]);
                Aluno::create(['nome_aluno' => $nome_aluno, 'email_aluno'=>$email_aluno, 'id_usuario_fk' => $user->id_usuario, 'id_curso_fk'=>$id_curso]);
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
            \Session::flash('erro','Não foi possível inserir aluno.');
            return redirect ('/coordenador/aluno/cadastrar');      
        }
        \Session::flash('sucesso','Aluno cadastrado com sucesso.');
        return redirect ('/coordenador/aluno/cadastrar');
    }


    public function cadastrarGrupo()
    {   
         
        return view('coordenador.cadastrarGrupoAluno');
    }


    public function inserirGrupo(Request $request)
    {
        $dados = $request->except(['_token']);

        $validator = Validator::make( $dados,[
          'arquivo' =>'required'
        ]);

        if($validator->fails())
        {
          return redirect('/coordenador/grupo/aluno/cadastrar')->withInput($dados)->withErrors($validator);
        }

        $curso=Auth::user()->coordenador->id_curso_fk;
       
         $arquivo = $request->file('arquivo');
        
        $file = $request->file('arquivo');
        $nomeArquivo = storage_path() . '/grupoAluno/'.$file->getClientOriginalName();
        $file->move(storage_path() . '/grupoAluno', $file->getClientOriginalName());

        $meuArray = [];
        $file = fopen($nomeArquivo, 'r');
        while (($line = fgetcsv($file)) !== false)
        {
            if ($line[0] != '')
            {
              $meuArray[] = $line[0];
            }
              
        }
        fclose($file); 
        foreach ($meuArray as $l)
        {
            $d = explode(";", $l);
            $user=User::create(['login'=>$d[1], 'password'=>bcrypt($d[1])]);
            Aluno::create(['nome_aluno' => $d[0], 'id_usuario_fk' => $user->id_usuario, 'id_curso_fk'=>$curso]);
        }

        unlink($nomeArquivo);

        \Session::flash('sucesso','Alunos cadastrados com sucesso.');
        return redirect ('/coordenador/grupo/aluno/cadastrar');
    }



    public function visualizar()
    {
        $curso= Auth::user()->coordenador->id_curso_fk;
        $alunos=Aluno::where('id_curso_fk', '=', $curso)->whereNotNull('id_usuario_fk')->orderBy('nome_aluno')->get();
        // return var_dump($alunos);
        return view('coordenador.visualizarAluno', ['alunos'=>$alunos]);

    }

    public function editar($id_aluno)
    {
        $aluno= Aluno::find($id_aluno);
        $user= User:: find($aluno->id_usuario_fk);
        return view('coordenador.editarAluno', ['aluno'=>$aluno , 'user'=>$user] );
   
    }

    public function salvar($id_aluno)
    {   
        $request=\Request::except('_token');
       
        $aluno=Aluno::find($id_aluno);
        $user=User::find($aluno->id_usuario_fk);

        if ($user->login == $request['login']) 
        {
             $validator = Validator::make( $request,
            [
                'nome_aluno' =>'required|max:90',
                'email_aluno' => 'max:50'

            ]);

        if($validator->fails())
        {
          return redirect(url('/coordenador/aluno/editar' , $id_aluno))->withInput($request)->withErrors($validator);
        }

            DB::beginTransaction();
            try
            {
                $aluno->update(['nome_aluno'=>$request['nome_aluno'] , 'email_aluno'=>$request['email_aluno']]);

                DB::commit();
            }
            catch(\Exception $e)
            {
                DB::rollback();
                \Session::flash('er','Não foi possível atualizar aluno.');
                return redirect('/coordenador/aluno/visualizar');
            }        
        }
        else
        {
            $validator = Validator::make( $request,
            [
                'nome_aluno' =>'required|max:90',
                'login' => 'required|max:30|unique:usuarios,login',
                'email_aluno' => 'max:50'

            ]);

            if($validator->fails())
            {
              return redirect(url('/coordenador/aluno/editar' , $id_aluno))->withInput($request)->withErrors($validator);
            }

            DB::beginTransaction();
            try
            {

                $aluno->update(['nome_aluno'=>$request['nome_aluno'] , 'email_aluno'=>$request['email_aluno']]);
                $user->update(['login'=>$request['login'] , 'password'=>bcrypt($request['login'])]);
                DB::commit();
            }
            catch(\Exception $e)
            {
                DB::rollback();
                \Session::flash('er','Não foi possível atualizar aluno.');
                return redirect('/coordenador/aluno/visualizar');
            }        
        }
        \Session::flash('sucesso',' Aluno atualizado.');
        return redirect('/coordenador/aluno/visualizar');
    }

    public function excluir($id_aluno)
    {

        $aluno=Aluno::find($id_aluno);
        if (empty($aluno->id_projeto_fk)) 
        {   
            DB::beginTransaction();
            try
            {
                $user=User::find($aluno->id_usuario_fk)->delete();
                $aluno->delete();
                DB::commit();
            }

            catch(\Exception $e)
            {
                DB::rollback();
                \Session::flash('er', 'não foi possível excluir o aluno');
                return redirect('/coordenador/aluno/visualizar');
            }
        }
        else
        {
            DB::beginTransaction();
            try
            {
                $user=User::find($aluno->id_usuario_fk)->delete();
                DB::commit();
            }
            
            catch(\Exception $e)
            {
                DB::rollback();
                \Session::flash('er', 'não foi possível excluir o aluno');
                return redirect('/coordenador/aluno/visualizar');
            }   
            
        }

        \Session::flash('sucesso','Aluno excluído com sucesso.');
        return redirect ('/coordenador/aluno/visualizar');
    }
    

    //ALUNO
	public function editarPerfil()
    {
	    $user= Auth::user()->aluno;

	    return view('aluno.editarPerfilAluno', ['user'=>$user]);

    }	

    public function editarPerfilSalvarAluno($id_aluno)
    {
    	$request= \Request::except('_token');
		  $validator= Validator::make($request,[
            'email' => 'required|min:7'
		  ]);

	    if($validator->fails())
	    {
        	return redirect('/aluno/editar/perfil') ->withErrors($validator);
      	}

      
    	DB::beginTransaction();
    	try
    	{
    		DB::table('aluno')
    			->where('id_usuario', $id_aluno)
    			->update(['email_aluno' => $request]);
    		DB::commit();
    	}
    	catch(\Exception $e)
        {
            DB::rollback();
        }


       \Session::flash('sucesso','Email alterado com sucesso.');
        return redirect ('/aluno/editar/perfil');


    }



    
}
