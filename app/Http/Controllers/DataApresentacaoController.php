<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\DataApresentacao;
use Validator;
use DB;
use DateTime;
use App\Curso;
use App\Curso_DataApresentacao;
use Auth;
use App\Projeto;
use App\Aluno;

class DataApresentacaoController extends Controller
{
    // coordenador
	public function cadastrar()
	{

		return view('coordenador.cadastrarHorario');
	}

	public function inserirDia()
	{	
		$request=\Request::except('_token');
		$horario_dia=\Request::get('hora');		
		$horario_semana=\Request::get('horario');
		$caracter=\Request::get('primeiro_dia');
		$semana1=new DateTime(\Request::get('primeiro_dia'));
		$semana2= new DateTime (\Request::get('ultimo_dia'));
		$data=\Request::get('data');
		$curso= Auth::user()->coordenador->id_curso_fk;
		
		$teste = date ("Y-m-d");
 		

		if ($data=='dia') {
			$validador = Validator::make($request, [
			
 			'hora' => 'required',
 			'dia' => 'required|min:10'
	 		]);

	 		if($validador->fails()){

	 			return redirect('/coordenador/horario/cadastrar')->withErrors($validador);
	 		}
				
			
			$dia=\Request::get('dia');
			DB::beginTransaction();
			try{
				for ($i=0; $i < count($horario_dia); $i++)
				 { 	
					$dt=DataApresentacao::create(['data_hora'=> "$dia $horario_dia[$i]"]);				
					Curso_DataApresentacao::create(['id_curso_fk'=> $curso, 'id_data_apresentacao_fk'=> $dt->id_data_apresentacao]);
				}
				DB::commit();
			}
			catch(\Exception $e)
			{
			  DB::rollback();
			}

		}elseif ($data=='semana')
		{
			$validador = Validator::make($request, [
 			'horario' => 'required',
 			'primeiro_dia' => 'required|min:10',
 			'ultimo_dia' => 'required|min:10|after:primeiro_dia'
	 		]);

	 		if($validador->fails()){

	 			return redirect('/coordenador/horario/cadastrar')->withErrors($validador);
	 		}
				
			$diferenca = new DateTime(date("Y-m-d"));
			$diferenca=$semana2->diff($semana1);
			DB::beginTransaction();
			try{

				for ($j=0; $j <= $diferenca->d; $j++) { 
					for ($i=0; $i < count($horario_semana) ; $i++) { 
						$dt=DataApresentacao::create(['data_hora'=>"$caracter $horario_semana[$i]"]);

						Curso_DataApresentacao::create(['id_curso_fk'=> $curso, 'id_data_apresentacao_fk'=>$dt->id_data_apresentacao]);
					}
					$caracter= date('Y-m-d', strtotime($caracter. " + 1 days"));
				}
				DB::commit();
			}
			catch(\Exception $e)
			{
				DB::rollback();
			}

		}
		
		\Session::flash('sucesso','Horario cadastrado com sucesso');

		 return redirect('/coordenador/horario/cadastrar');
	}
	



	public function visualizar($ano = '')
	{	

		if($ano == null)
			$ano = date('Y');
		$id_curso= Auth::user()->coordenador->id_curso_fk;

		$anos = DB::select("SELECT year(data_hora) 'ano' FROM dataapresentacoes inner join cursos_dataapresentacoes on id_data_apresentacao_fk = id_data_apresentacao where cursos_dataapresentacoes.id_curso_fk = :id_curso GROUP BY ano ORDER BY ano desc", ['id_curso' => $id_curso]);
		$horarios=DataApresentacao::join('cursos_dataapresentacoes', 'cursos_dataapresentacoes.id_data_apresentacao_fk', '=', 'id_data_apresentacao')->leftjoin('projetos', 'projetos.id_data_apresentacao_fk', '=', 'id_data_apresentacao')
					->where('cursos_dataapresentacoes.id_curso_fk', '=', $id_curso)->orderBy('data_hora', 'desc')->get();
		// $horarios=DataApresentacao::
		// 			join('cursos_dataapresentacoes', 'cursos_dataapresentacoes.id_data_apresentacao_fk', '=', 'id_data_apresentacao')->leftjoin('projetos', 'projetos.id_data_apresentacao_fk', '=', 'id_data_apresentacao')
		// 			->where('cursos_dataapresentacoes.id_curso_fk', '=', $id_curso)
		// 				->whereRaw("year(data_hora) = $ano")
		// 				->orderBy('data_hora', 'desc')->get();

		$alunos= Aluno::join('projetos', 'projetos.id_projeto', '=', 'alunos.id_projeto_fk')->select('nome_aluno', 'id_data_apresentacao_fk')->whereNotNull('id_data_apresentacao_fk')->get();
		// return var_dump($horarios);
		return view('coordenador.visualizarHorario',['horarios'=>$horarios, 'alunos' => $alunos, 'anos' => $anos, 'ano' => $ano]);
	}

	public function excluir($id_data_apresentacao)
	{

		$horario=DataApresentacao::find($id_data_apresentacao);
		
		$horario->delete();
		\Session::flash('sucesso','Horário excluido com sucesso.');	 	
		return redirect('/coordenador/horario/visualizar');
	}


	// ALUNO
	public function definirHorario()
	{	
		if ((Auth::user()->aluno->id_projeto_fk) == null) {
				\Session::flash('aviso','Não é possível marcar defesa de TCC, pois não existe Trabalho vinculado ao usuário. Aguarde a coordenação efetuar o cadastro do seu trabalho.');
				return view('aluno.avisoDefinirHorario');
		}
		else{
			$verificarData=Auth::user()->aluno->projeto->id_data_apresentacao_fk;
			if (empty($verificarData)) {
				
			$id_curso= Auth::user()->aluno->id_curso_fk;
			$datas=DataApresentacao::leftjoin('cursos_dataapresentacoes', 'cursos_dataapresentacoes.id_data_apresentacao_fk', '=', 'id_data_apresentacao')->leftjoin('projetos', 'projetos.id_data_apresentacao_fk', '=', 'id_data_apresentacao')->where('cursos_dataapresentacoes.id_curso_fk', '=', $id_curso)->whereNull('projetos.id_data_apresentacao_fk')->orderBy('data_hora')->get();	
				return view('aluno.definirHorario',['datas'=>$datas]);
			}
			elseif (!(empty($verificarData))) 
			{
				$data= DataApresentacao::where('id_data_apresentacao','=', $verificarData)->get();
				// $teste=$data->id_data_apresentacao;
				
				\Session::flash('aviso','Sua defesa de TCC já foi escolhida.
					Será no dia: '.date('d/m/Y - H:i', strtotime($data[0]->data_hora)).'h');
				return view('aluno.avisoDefinirHorario');
			}
		}

	}

	public function salvarHorario()
	{	
		$request=\Request::except('_token');
		$validador=Validator::make($request, [
			'data' => 'required	'
			], ['data.required' => 'Escolha uma data para apresentação do TCC']);
		if($validador->fails()){

	 			return redirect('/aluno/horario/escolher')->withErrors($validador);
	 		}

		$id_curso= Auth::user()->aluno->id_curso_fk;

	 	$verificarData= DB::table('dataapresentacoes')
	 		->select('id_data_apresentacao')->leftjoin('cursos_dataapresentacoes', 'cursos_dataapresentacoes.id_data_apresentacao_fk', '=', 'id_data_apresentacao')->where('cursos_dataapresentacoes.id_curso_fk', '=', $id_curso)->where('id_data_apresentacao', '=', $request)->get();
	 	
	 	if (empty($verificarData)) 
	 	{
	 		\Session::flash('er','Data não existe.');
	 		return redirect('/aluno/horario/escolher');

	 	}else
	 	{
	 		$verificarAluno=DB::table('projetos')->select('id_projeto')->where('id_data_apresentacao_fk', '=',$request)->get();
	 		
	 		if (empty($verificarAluno)) 
	 		{
				$id_data_apresentacao=\Request::get('data');
				$ano=$anos = DB::select("SELECT year(data_hora) 'ano' FROM dataapresentacoes where id_data_apresentacao = $id_data_apresentacao");
	 			$id_projeto=Auth::user()->aluno->projeto->update(['id_data_apresentacao_fk' => $id_data_apresentacao , 'ano' => $ano[0]->ano]);

				\Session::flash('sucesso','horario escolhido com sucesso');
				return redirect('/');
				 			
	 		}else{
				\Session::flash('er','Data já possui TCC.');	 	
				return redirect('/aluno/horario/escolher');		
	 		}

	 	}
	}


}