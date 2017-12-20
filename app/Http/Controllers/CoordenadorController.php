<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Curso;
use Validator;
use Auth;
use App\Professor;
use App\Curso_Professor;
use App\User;
use App\Coordenador;

class CoordenadorController extends Controller
{

   public function cadastrar()
   {
   	$cursos = DB::table('cursos')
          ->leftJoin('coordenadores', 'cursos.id_curso', '=', 'coordenadores.id_curso_fk')        
           ->whereNull('coordenadores.id_professor_fk')->get();;

    $professores = DB::table('professores')
            ->leftJoin('coordenadores', 'id_professor', '=','id_professor_fk')
            ->whereNull('id_professor_fk')->get();
   	return view('administrador.cadastrarCoordenador',['cursos'=>$cursos], ['professores'=>$professores]);
   }


   public function inserir()
   {
      $request=\Request::except('_token');

      $op=\Request::get('data');
      if (empty($op)) {
         \Session::flash('er','Insira algum tipo de professor.');
         return redirect('/administrador/coordenador/cadastrar');
      }
      else
      {

         $validator=Validator::make($request,[
                  'login' => 'required|min:4|max:30|unique:usuarios,login',
                  'curso'=>   'required'
               ]);
            
            if($validator->fails())
            {

               return redirect('/administrador/coordenador/cadastrar')->withErrors($validator);
            }

            $login=\Request::get('login');
            $curso=\Request::get('curso');

         // professor já cadastrado 
        if($op=='dia')
        {
            $validator=Validator::make($request,[
                  'professor' => 'required'
               ]);
            
            if($validator->fails())
            {

               return redirect('/administrador/coordenador/cadastrar')->withErrors($validator);
            }

           
            $user = User::create(['login' =>$login , 'password' => bcrypt($login)]);

            $professor=\Request::get('professor');

            $result =DB::table('professores')
                     ->join('cursos_professores','id_professor', '=', 'id_professor_fk')
                     ->where('id_professor_fk', '$professor')
                      ->where('id_curso_fk', '$curso')
                     ->count();

            if ($result==0) {

                  Curso_Professor::create(['id_curso_fk'=>$curso, 'id_professor_fk' => $professor]);
               
            }
            
                
             Coordenador::create(['id_usuario_fk' => $user->id_usuario, 'id_professor_fk'=> $professor, 'id_curso_fk' =>$curso ]);



            
         }

        //cadastrar professor
        if($op=='semana')
        {
             $validator=Validator::make($request,[
                  'nome' => 'required|max:35',
                  'sobrenome' => 'required|max:60'
               ]);
            
            if($validator->fails())
            {

               return redirect('/administrador/coordenador/cadastrar')->withErrors($validator);
            }

             $nome=\Request::get('nome');
             $sobrenome=\Request::get('sobrenome');
             $email=\Request::get('email');
            
            $professor = Professor::create(['nome_professor'=> $nome, 'sobrenome_professor'=> $sobrenome, 'email_professor'=>$email]);

            $user = User::create(['login' =>$login , 'password' => bcrypt($login)]);

            Curso_Professor::create(['id_curso_fk'=>$curso, 'id_professor_fk' => $professor->id_professor]);

               Coordenador::create(['id_usuario_fk' => $user->id_usuario, 'id_professor_fk'=> $professor->id_professor,'id_curso_fk'=>$curso]);

        }

         
      	\Session::flash('sucesso','Coordenador cadastrardo com sucesso');

      	return redirect('/administrador/coordenador/cadastrar');
      }
   }


   public function visualizar()
   {
      $coordenadores=Coordenador::join('professores','id_professor_fk', '=','id_professor')->orderBy('nome_professor')->get();
   	return view('administrador.visualizarCoordenador',['coordenadores'=>$coordenadores]);
   }


   public function editar($id_professor_fk, $id_curso_fk)
   {

      $user=Coordenador::where('id_professor_fk', '=', $id_professor_fk)->where('id_curso_fk','=', $id_curso_fk)->first();

      return view('administrador.editarCoordenador', ['user' => $user]);
   }

   public function salvar($id_professor_fk, $id_curso_fk)
   {
    $request= \Request::except('_token');
    $professor=Coordenador::where('id_professor_fk','=', $id_professor_fk)->where('id_curso_fk','=', $id_curso_fk)->first(); 

    if ($professor->usuario->login != $request['usuario'])
    {
       $validator= Validator::make($request,[
        'nome_professor' => 'required|max:35',
        'sobrenome_professor' => 'required|max:60',
        'email_professor' => 'required|min:7|max:50',
        'usuario' =>'required|min:5|max:30|unique:usuarios,login'
      ]);
      if($validator->fails())
      {
         return redirect(URL('/administrador/'.$id_professor_fk.'/coordenador/editar'))
            ->withErrors($validator);
      }  

      DB::beginTransaction();
      try 
      {
        $professor->usuario->update(['login'=>$request['usuario'] , 'password'=>bcrypt($request['usuario'])]);  
        $professor->professor->update(['nome_professor'=>$request['nome_professor'], 'sobrenome_professor'=> $request['sobrenome_professor'] , 'email_professor' => $request['email_professor']]);
        DB::commit();
      } 
      catch (Exception $e) 
      {
          DB::rollback();
          \Session::flash('er','Não foi possível atualizar o coordenador.');
          return redirect('/adminsitrador/coordenador/visualizar');
      }
    
    }

    else
    {
      $validator= Validator::make($request,[
        'nome_professor' => 'required|max:35',
        'sobrenome_professor' => 'required|max:60',
        'email_professor' => 'required|min:7|max:50',
      ]);
      if($validator->fails())
      {
         return redirect(URL('/administrador/'.$id_professor_fk.'/coordenador/editar'))
            ->withErrors($validator);
      }        
      DB::beginTransaction();
      try 
      {
        $professor->professor->update(['nome_professor'=>$request['nome_professor'], 'sobrenome_professor'=> $request['sobrenome_professor'] , 'email_professor' => $request['email_professor']]);
        DB::commit();
      } 
      catch (Exception $e) 
      {
          DB::rollback();
          \Session::flash('er','Não foi possível atualizar o coordenador.');
          return redirect('/adminsitrador/coordenador/visualizar');
      }

    }
   

    \Session::flash('sucesso','Coordenador atualizado.');
    return redirect('/administrador/coordenador/visualizar');
   }

  public function excluir($id_professor_fk, $id_curso_fk)
   {
    
    $coordenador=Coordenador::where('id_professor_fk','=', $id_professor_fk)->where('id_curso_fk','=', $id_curso_fk)->first();
    
    DB::beginTransaction();
    try 
    {
      DB::table('usuarios')->where('id_usuario','=', $coordenador->id_usuario_fk)->delete();
      // DB::table('coordenadores')->where('id_professor_fk','=', $id_professor_fk)->where('id_curso_fk','=', $id_curso_fk)->delete();

      DB::commit();
    } catch (Exception $e) 
    {
      DB::rollback();
       \Session::flash('er','Não foi possível excluir o coordenador.');
        return redirect('/adminsitrador/coordenador/visualizar');
    }
    
    \Session::flash('sucesso', 'Coordenador excluído.');
    return redirect('/administrador/coordenador/visualizar');
   }


   public function editarPerfil()
   {
      $user = Auth::user()->coordenador;
      
      return view('coordenador.editarPerfilCoordenador', ['user'=>$user]);
   }

   public function editarPerfilSalvar($id_professor)
   {
      $request= \Request::except('_token');

      $validator= Validator::make($request,[
      'nome_professor' => 'required|max:35',
      'sobrenome_professor' => 'required|max:60',
      'email_professor' => 'required|min:7|max:50'
      ]);


      if($validator->fails()){

         return redirect('/coordenador/editar/perfil')
                        ->withErrors($validator);
      }

      Professor::find($id_professor)->update($request);

      \Session::flash('sucesso','Coordenador alterado com sucesso.');
      return redirect('/coordenador/editar/perfil');
   }

   
}
