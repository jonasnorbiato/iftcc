<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Http\Requests;
use Validator;
use App\Aluno;
use App\Coordenador;
use App\Professor;
use DB;
use App\Curso_Professor;
use App\Curso_DataApresentacao;

class CursoController extends Controller
{
    public function  cadastrar()
    {
    	return view('administrador.cadastrarCurso');
    }

    public function inserir()
    {
    	$request=\Request::except(['_token']);

		$validator = Validator::make($request, [
		'nome_curso' => 'required|min:2|max:120|unique:cursos',

 		]);

 		if($validator->fails()){

 			return redirect('/administrador/curso/cadastrar')->withInput($request)->withErrors($validator);
 		}	

     	Curso::create($request);
        \Session::flash('sucesso','Curso cadastrado com sucesso');
    	return redirect('/administrador/curso/cadastrar');
    }

    public function visualizar()
    {
    	$cursos = DB::table('cursos')
                ->orderBy('nome_curso', 'asc')
                ->get();
    	return view('administrador.visualizarCurso',['cursos'=>$cursos]);
    }


    public function excluir($id_curso)
    {   DB::beginTransaction();
        try 
        {
            $alunos=Aluno::select('id_usuario_fk')->where('id_curso_fk','=',$id_curso)->get();
            foreach ($alunos as $key => $aluno) {
                    
                DB::table('usuarios')->where('id_usuario','=', $aluno->id_usuario_fk)->delete();
            }

            $coordenadores=Coordenador::select('id_usuario_fk')->where('id_curso_fk','=',$id_curso)->get();
            foreach ($coordenadores as $key => $coordenador) {
                    
                DB::table('usuarios')->where('id_usuario','=', $coordenador->id_usuario_fk)->delete();
            }


            $professores=Professor::join('cursos_professores', 'cursos_professores.id_professor_fk', '=', 'professores.id_professor')
            ->where('id_curso_fk', '=', $id_curso)->get();

            foreach ($professores as $key => $professor)
            {
                $verifica_curso=Curso_Professor::where('id_professor_fk', '=', $professor->id_professor)->get();
                
                if (count($verifica_curso)==1) 
                {
                        $professor->delete();                
                }
                elseif (count($verifica_curso)>1)
                {                
                    DB::table('cursos_professores')->where('id_professor_fk', '=', $professor->id_professor)->where('id_curso_fk', '=', $id_curso)->delete();
                    DB::commit();                       
                }
                
            }

            $horarios=Curso_DataApresentacao::where('id_curso_fk', '=', $id_curso)->get();

            foreach ($horarios as $key => $horario) {
                DB::table('dataapresentacoes')->where('id_data_apresentacao','=', $horario->id_data_apresentacao_fk)->delete();
            }
        
            Curso::find($id_curso)->delete();
            DB::commit();
        } catch (Exception $e) 
        {
            DB::rollback();
            \Session::flash('er','Não foi possivel apagar o curso');
         }

        \Session::flash('sucesso','Curso excluído.');
        return redirect('/administrador/curso/visualizar');
    }

    public function editar($id_curso)
    {
        $curso= Curso::find($id_curso);

        return view('administrador.editarCurso', ['curso' => $curso]);
    }

    public function salvar($id_curso)
    {
        $request=\Request::except(['_token']);
        $mesmo_nome=Curso::find($id_curso);

        if ($mesmo_nome->nome_curso == $request['nome_curso'])
        {
            \Session::flash('er','Nome do curso continua o mesmo.');
            return redirect(url('/administrador/curso/editar', $id_curso));
        }

        $validator = Validator::make($request, [
        'nome_curso' => 'required|min:2|max:120|unique:cursos',

        ]);

        if($validator->fails()){

            return redirect(url('/administrador/curso/editar',$id_curso))->withInput($request)->withErrors($validator);
        }   

        Curso::find($id_curso)->update($request);

        \Session::flash('sucesso','Curso atualizado com sucesso.');
        return redirect('/administrador/curso/visualizar');
    }
}
