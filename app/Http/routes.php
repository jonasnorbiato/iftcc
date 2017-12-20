<?php
use App\User;
use App\Administrador;
use App\Aluno;
use App\Coordenador;
use App\Professor;
use App\Curso;

Route::get('/inserir_administrador', function(){
		$user = User::create(['login' => 'Administrador', 'password' => bcrypt('admin123')]);

		Administrador::create(['id_usuario_fk' => $user->id_usuario , 'email_administrador' => 'admin.if@gmail.com']);
		return redirect('/');	
});


//  Login do sistema
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login/entrar', 'Auth\AuthController@postLogin');
Route::post('/enviar/recuperar/senha', 'Auth\AuthController@recuperarSenha');


//USUARIO AUTENTICADO COM ACESSO AO SISTEMA
Route::group(['middleware' => 'auth'], function(){

	Route::get('/','HomeController@inicio');
	
	Route::get('/alterar/senha', 'UserController@alterarSenha');
	Route::post ('/alterar/senha/salvar/{id_usuario}', 'UserController@alterarSenhaSalvar');
	Route::get('/logout', 'Auth\AuthController@logout');



	// ROTAS DO ALUNO
	Route::group(['middleware' => 'aluno'], function(){
	
		Route::group(['prefix'=>'aluno'], function(){
		
		Route::get('/horario/escolher',"DataApresentacaoController@definirHorario");
		Route:: get('/editar/perfil', 'AlunoController@editarPerfil');

		Route::post('/horario/salvar',"DataApresentacaoController@salvarHorario");

		Route::get('/professor/visualizar' ,'ProfessorController@visualizar');
		
		Route::get('/enviar/tcc', 'ProjetoController@cadastrarEnviarTCC');
		
		Route::post('/enviar/tcc/inserir', 'ProjetoController@salvarEnviarTCC');

		Route::get('/editar/perfil' , 'AlunoController@editarPerfil');
		
		Route::post('/editar/perfil/salvar/{id_aluno}' , 'AlunoController@editarPerfilSalvarAluno');

		

		});	
	
	});



	// ROTAS DO COORDENADOR
	Route::group(['middleware' => 'coordenador'], function(){

		Route::group(['prefix'=>'coordenador'], function(){

			Route::get('/aluno/cadastrar', 'AlunoController@cadastrar');

			Route::post('/aluno/inserir/{id_curso}', 'AlunoController@inserir');

			Route::get('/aluno/visualizar', 'AlunoController@visualizar');

			Route::get('/grupo/aluno/cadastrar', 'AlunoController@cadastrarGrupo');

			Route::post('/grupo/aluno/inserir', 'AlunoController@inserirGrupo');

			Route:: get('/aluno/editar/{id_aluno}', 'AlunoController@editar');

			Route:: post('/aluno/salvar/{id_aluno}', 'AlunoController@salvar');

			Route::get('/aluno/excluir/{id_aluno}' , 'AlunoController@excluir');

			Route::get('/professor/cadastrar', 'ProfessorController@cadastrar');

			Route::post('/professor/inserir/{id_curso}', 'ProfessorController@inserir');

			Route::get('/professor/visualizar', 'ProfessorController@visualizar');

			Route::get('professor/editar/{id_professor}', 'ProfessorController@editar');

			Route::post('professor/salvar/{id_professor}','ProfessorController@salvar');
			
			Route::get('/professor/excluir/{id_professor}', 'ProfessorController@excluir');

			Route::get('/horario/cadastrar','DataApresentacaoController@cadastrar');

			Route::get('/horario/excluir/{id_data_apresentacao}', 'DataApresentacaoController@excluir');

			Route::get('/horario/visualizar/{ano?}','DataApresentacaoController@visualizar');

			Route::post('/horario/inserir','DataApresentacaoController@inserirDia');

			Route::get('/trabalho/cadastrar', 'ProjetoController@cadastrar');

			Route::post('/trabalho/inserir/{id_curso}', 'ProjetoController@inserir');

			Route::get('/trabalho/visualizar/{ano?}', 'ProjetoController@visualizar');

			Route::get('trabalho/excluir/{id_projeto}',"ProjetoController@excluir");

			Route::get('trabalho/editar/{id_projeto}', 'ProjetoController@editar');

			Route::post('trabalho/salvar/{id_projeto}', 'ProjetoController@salvar');

			Route::get('/banca/selecionar', "ProjetoController@selecionarProjeto");

			Route::post('/banca/selecionar/salvar', "ProjetoController@salvarProjeto");

			Route:: get('/editar/perfil', 'CoordenadorController@editarPerfil');

			Route:: post('/editar/perfil/salvar/{id_professor}', 'CoordenadorController@editarPerfilSalvar');

		});



	});




	// Rota administrador 
	Route::group(['middleware' => 'administrador'], function(){
		Route::group(['prefix'=>'administrador'],function(){

			Route::get('/curso/cadastrar','CursoController@cadastrar');

			Route::post('/curso/inserir','CursoController@inserir');

			Route::get('/curso/visualizar','CursoController@visualizar');

			Route::get('/curso/excluir/{id_curso}','CursoController@excluir');

			Route::get('/curso/editar/{id_curso}','CursoController@editar');

			Route::post('/curso/salvar/{id_curso}', 'CursoController@salvar');

			Route::get('/coordenador/cadastrar','CoordenadorController@cadastrar');

			Route::post('/coordenador/inserir','CoordenadorController@inserir');

			Route::get('/coordenador/visualizar','CoordenadorController@visualizar');

			Route::get('/{id_professor_fk}/coordenador/{id_curso_fk}/editar', 'CoordenadorController@editar');

			Route::post('/coordenador/salvar/{id_professor_fk}/{id_curso_fk}','CoordenadorController@salvar');

			Route::get('/{id_professor_fk}/coordenador/{id_curso_fk}/excluir', 'CoordenadorController@excluir');

			Route:: get('/editar/perfil', 'AdministradorController@editarPerfil');

			Route::post('/editar/perfil/salvar/{id_usuario_fk}' , 'AdministradorController@editarPerfilSalvar');
		
		});

	});
	
});
