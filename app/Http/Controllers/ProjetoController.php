<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Projeto;
use Validator;
use DB;
use App\Professor;
use Auth;
use App\Aluno;
use App\Banca;
use Storage;
use File;
use Mail;
use Log;
use Response;


class ProjetoController extends Controller
{
  
  public function cadastrar()
  {

    $curso= Auth::user()->coordenador->id_curso_fk;
    $alunos=Aluno::where('id_curso_fk', '=', $curso)->whereNull('id_projeto_fk')->get();
  	return view('coordenador.cadastrarTrabalho', ['alunos'=> $alunos], ['curso'=>$curso]);

  }


  public function inserir($id_curso)
  {
  	
    $request=\Request::except(['_token']);
    
  	$validator= Validator::make($request,[
  		'titulo' => 'required|max:200|unique:projetos,titulo',
      'primeiro_aluno' =>'required',
      'segundo_aluno' => 'different:primeiro_aluno'

  	]);

  	if($validator->fails())
    {
  		return redirect('/coordenador/trabalho/cadastrar')->withInput($request)->withErrors($validator);
  	};

    $curso= Auth::user()->coordenador->id_curso_fk;
    $titulo=\Request::get('titulo');
    $id_aluno1=\Request::get('primeiro_aluno');
    $id_aluno2=\Request::get('segundo_aluno');
    $ano = date('Y');
    
    if (empty($id_aluno2)) {
    
       DB::beginTransaction();
       try
       {
          $projeto=Projeto::create(['titulo' => $titulo, 'status' => 0, 'id_curso_fk'=>$curso, 'ano' => $ano]);
          
          Aluno::find($id_aluno1)->update(['id_projeto_fk' => $projeto->id_projeto]);
          DB::commit();
       }
       catch(\Exception $e)
       {
          DB::rollback();
       }

    }else{
       DB::beginTransaction();
       try
       {

        $projeto=Projeto::create(['titulo' => $titulo, 'id_curso_fk'=>$curso, 'ano'=>   $ano]);
        
        Aluno::find($id_aluno1)->update(['id_projeto_fk' => $projeto->id_projeto]);

        Aluno::find($id_aluno2)->update(['id_projeto_fk' => $projeto->id_projeto]);
          DB::commit();
       }
       catch(\Exception $e)
       {
          DB::rollback();
          return var_dump('não deu');
       }
    }

  	\Session::flash('sucesso','Trabalho cadastrado com sucesso.');
  	return	redirect ('coordenador/trabalho/cadastrar');

  }


  public function visualizar($ano ='')
  {
    if($ano == '')
      $ano = date('Y');
    
    $curso= Auth::user()->coordenador->id_curso_fk;
    $anos=DB::select("SELECT ano FROM projetos where id_curso_fk = :curso GROUP BY ano ORDER BY ano desc", ['curso' =>$curso]);

      $projetos = Projeto::where('id_curso_fk', '=', $curso)->whereRaw("projetos.ano = $ano")->orderBy('titulo')->get();
    
  	return view('coordenador.visualizarTrabalho',['projetos' => $projetos, 'anos' => $anos, 'ano' => $ano]);
  }


  public function excluir($id_projeto)
  {
    $alunos=Aluno::where('id_projeto_fk','=', $id_projeto)->get();
    
     foreach ($alunos as $key => $aluno) {
        if (is_null($aluno->id_usuario_fk))
        {
          $id=$aluno->id_aluno;
          
          DB::beginTransaction();
          try 
          {
            DB::table('alunos')->where('id_aluno','=', $id)->delete();
            DB::commit();
          } catch (Exception $e) 
          {
            DB::rollback();
            \Session::flash('er','Não foi possível apagar o trabalho');
            return redirect('/coordenador/trabalho/visualizar');
          }

        }
     }

     DB::beginTransaction();
     try {
        Projeto::find($id_projeto)->delete();
       DB::commit();
     } catch (Exception $e) {
       DB::rollback();
            \Session::flash('er','Não foi possível apagar o trabalho');
            return redirect('/coordenador/trabalho/visualizar'); 
     }

  \Session::flash('sucesso','Trabalho excluído');
   return redirect('/coordenador/trabalho/visualizar');
  }
 

  public  function selecionarProjeto()
  {
    $id_curso_fk= Auth::user()->coordenador->id_curso_fk;
    $projetos=Projeto::leftJoin('bancas','id_projeto_fk', '=', 'id_projeto')
            ->where( 'id_curso_fk', '=', $id_curso_fk)->whereNull('bancas.id_projeto_fk')->get();
    $professores=Professor::join('cursos_professores', 'id_professor_fk', '=', 'id_professor')->where('id_curso_fk', '=', $id_curso_fk)->get();
    return view('coordenador.selecionarBanca',['projetos'=>$projetos], ['professores' => $professores]);

  }

  public function salvarProjeto()
  {

    $request=\Request::except(['_token']);

    $validator =Validator::make($request,[
      'trabalho'=>'required',
      'professores'=>'required|min:3',
      ], [
          'professores.min' => 'Selecione 3 professres para compor a banca.' 
      ]);

    if($validator->fails()){
      return redirect('/coordenador/banca/selecionar')->withInput($request)->withErrors($validator);
    }

    $professores=\Request::get('professores');
    $trabalho=\Request::get('trabalho');
    DB::beginTransaction();
    try
    {
  
      for ($i=0; $i <count($professores) ; $i++)
      { 
        Banca::create(['id_projeto_fk' => $trabalho, 'id_professor_fk'=>$professores[$i]]);
      }
      DB::commit();
    }
    catch(\Exception $e)
    {
      DB::rollback();
    }

    
    \Session::flash('sucesso','Banca Selecionada com sucesso!');
    return redirect('/coordenador/banca/selecionar');
  }

  public function cadastrarEnviarTCC()
  {
    $id_projeto= Auth::user()->aluno->id_projeto_fk;
    if (is_null($id_projeto)) 
    {
      \Session::flash('aviso','
            Não é possível enviar o TCC no momento, pois não existe Trabalho vinculado ao usuário. Aguarde a coordenação efetuar o cadastro do seu trabalho.');
      return view('aluno.Aviso'); 
    }
    $bancas=DB::table('bancas')
    ->join('professores', 'id_professor', '=', 'id_professor_fk')
    ->where('id_projeto_fk', '=', $id_projeto)->get();
    if (empty($bancas)) {
      \Session::flash('aviso','Não é possível enviar o TCC no momento, pois não existe banca associada ao seu Trabalho.');
      return view('aluno.Aviso');
    }else{
       return view('aluno.cadastrarEnviarTCC');
    }

  }

  public function salvarEnviarTCC(Request $request)
  {

    $dados = $request->except(['_token']);

    $validator = Validator::make( $dados,[
      'arquivo' =>'required|mimetypes:application/pdf'
    ]);
    

    if($validator->fails())
    {
      return redirect('/aluno/enviar/tcc')->withInput($dados)->withErrors($validator);
    }

    $file = $request->file('arquivo');
    $nomeArquivo=storage_path() . '/TCC/'.$file->getClientOriginalName();
    $file->move(storage_path() . '/TCC', $file->getClientOriginalName());

    $id_projeto= Auth::user()->aluno->projeto->id_projeto;

    $curso=Auth::user()->aluno->curso->nome_curso;
    $titulo=Auth::user()->aluno->projeto->titulo;

    $bancas = Projeto::find($id_projeto)->banca;
    $emails = [];
    
    foreach ($bancas as $b) {
      $emails[] = $b->professor->email_professor;
    }
      
  
    try
    {
      Mail::raw('Segue em anexo   o trabalho: '.$titulo.' para a banca.

          Ifes - Campus de Alegre, coordenação:  '.$curso
        , function ($message) use ($nomeArquivo, $emails, $titulo, $curso) 
      { 
        
        $message->from('ifes.alegre.tcc@gmail.com');
        $message->to($emails);
        $message->subject('Arquivo TCC com o título: '.$titulo);
        $message->attach($nomeArquivo);

      });
      
    }
    catch(\Exception $e)
    {
      Log::info('EMAIL', ['e' => $e]);

      unlink($nomeArquivo);
      \Session::flash('er','Não foi possível enviar o seu0 TCC. Tente novamente.');
      return redirect('/aluno/enviar/tcc');
    }

    unlink($nomeArquivo);
    Projeto::where('id_projeto', '=', $id_projeto)->update(['status' => 1]);    
    \Session::flash('sucesso','O anexo foi enviado com sucesso.');
        
    return redirect('/');

  }


  public function editar($id_projeto)
  {

    $projeto=Projeto::find($id_projeto);
    if (empty($projeto->banca->id_professor_fk))
    {
      
    }

    return var_dump($projeto);
    return view('coordenador.editar');
  }

}
