<!DOCTYPE html>
<html>
<head>
	<title>IFTCC</title>

	<link rel="icon" href="{{asset('img/icone_if.png')}}">
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">  
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/releway.css')}}">  
	<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/layout.css')}}">  
	<link rel="stylesheet" href="{{asset('css/coord.css')}}">  
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{asset('js/js_projeto.js')}}"></script>
	<script  src="{{asset('js/bootstrap.min.js')}}"></script>
	<script  src="{{asset('js/bootstrap-select.min.js')}}"></script>

</head>
<body class="body">
	<header>
	<div class="container">
		<div class="row">
	
			<div class="col-xs-6 col-sm-2 col-md-3 col-lg-2 titulo">
					<a href="{{url('/')}}" >IFTCC</a>
			</div>
			<div class="col-xs-6 col-sm-5 col-md-5 col-lg-8">
				@yield('titulo')
           
			</div>
			<div class="col-xs-12 col-sm-5 col-md-4 col-lg-2">
				
					<ul class="nav nav-pills nav-justified botao_barra">
					
						<li role="presentation">
							<a href="{{url('/logout')}}"> 
								<i class="fa fa-power-off" aria-hidden="true"></i>			
						   Sair</a>
						</li>
					</ul>
				
			</div>
		</div>
	</div>
</header>
<br>
<div class="container">
	<div class="row">
		
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 menu">
			
				<nav class="navbar navbar-default">						
					<ul class="nav nav-pills nav-stacked">
						<!-- professor -->
						@if(Auth::check())
							@if(Auth::user()->isCoordenador())
								<li>
							          <a href="#" data-toggle="collapse" data-target="#toggle1" data-parent="#sidenav01" class="collapsed">
							          <span></span> <i class="fa fa-graduation-cap" aria-hidden="true"></i> Aluno  <span class="caret"></span>
							          </a>
							          <div class="collapse" id="toggle1" style="height: 0px;">
							            <ul class="nav nav-list submenu">
							             	<li><a href="/coordenador/aluno/cadastrar">Cadastrar um Aluno</a></li>
							             	
							             	<li><a href="/coordenador/grupo/aluno/cadastrar">Cadastrar grupo p/ TCC</a></li>

							              	<li><a href="/coordenador/aluno/visualizar">Visualizar</a></li>
							            </ul>
							          </div>
							    </li>
								<li>
							          <a href="#" data-toggle="collapse" data-target="#toggle2" data-parent="#sidenav01" class="collapsed">
							          <span></span><i class="fa fa-users" aria-hidden="true"></i>   Professor   <span class="caret"></span>
							          </a>
							          <div class="collapse" id="toggle2" style="height: 0px;">
							            <ul class="nav nav-list submenu">
							             
							              <li><a href="{{url('/coordenador/professor/cadastrar')}}">Cadastrar</a></li>

							              <li><a href="{{url('/coordenador/professor/visualizar')}}">Visualizar</a></li>
							          
							            </ul>
							          </div>
							    </li>
							    <li>
							          <a href="#" data-toggle="collapse" data-target="#toggle3" data-parent="#sidenav01" class="collapsed">
							          <span></span><i class="fa fa-calendar" aria-hidden="true"></i> Data de Apresentação do TCC  <span class="caret"></span>
							          </a>
							          <div class="collapse" id="toggle3" style="height: 0px;">
							            <ul class="nav nav-list submenu">
							              <li><a href="{{url('/coordenador/horario/cadastrar')}}">Cadastrar data</a></li>

							              <li><a href="/coordenador/horario/visualizar">Visualizar</a></li>				          
							            </ul>
							          </div>
							    </li>

							    <li>
							          <a href="#" data-toggle="collapse" data-target="#toggle6" data-parent="#sidenav01" class="collapsed">
							          <span></span><i class="fa fa-file-text" aria-hidden="true"></i> Trabalhos  <span class="caret"></span>
							          </a>
							          <div class="collapse" id="toggle6" style="height: 0px;">
							            <ul class="nav nav-list submenu">
							              <li><a href="{{url('/coordenador/trabalho/cadastrar')}}">Cadastrar</a></li>

							              <li><a href="/coordenador/trabalho/visualizar">Visualizar</a></li>				          
							            </ul>
							          </div>
							    </li>

							    <li><a href="{{url('/coordenador/banca/selecionar')}}"><i class="fa fa-check-square-o" aria-hidden="true"></i>Selecionar Banca   </a></li>

							    <li><a href="{{url('/coordenador/editar/perfil')}}">Editar Perfil</a></li>
							@endif
						@endif

					    @if(Auth::check())
							@if(Auth::user()->isAluno())
								<!-- usuarios -->
								<li role="presentation"><a href="{{url('/aluno/professor/visualizar')}}"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Professor</a></li>

								<li role="presentation"><a href="{{url('/aluno/enviar/tcc')}}"><i class="fa fa-upload" aria-hidden="true"></i>	Enviar TCC</a></li>
								
							    <li role="presentation"><a href="{{url('/aluno/horario/escolher')}}">	<i class="fa fa-calendar" aria-hidden="true"></i> Marcar Defesa do TCC</a></li>
							    <li><a href="{{url('aluno/editar/perfil')}}">Editar Perfil</a></li>
							@endif
						@endif				
						
						@if(Auth::check())
							@if(Auth::user()->isAdmin())
							<!--opções administrador-->
							<li>
						          <a href="#" data-toggle="collapse" data-target="#toggle4" data-parent="#sidenav01" class="collapsed">
						          <span></span>Curso<span class="caret"></span>
						          </a>
						          <div class="collapse" id="toggle4" style="height: 0px;">
						            <ul class="nav nav-list submenu">
						              <li><a href="{{url('/administrador/curso/cadastrar')}}">Cadastrar</a></li>
						              <li><a href="{{url('/administrador/curso/visualizar')}}">Visualizar</a></li>
						          
						            </ul>
						          </div>
						    </li>

						    <li>
						          <a href="#" data-toggle="collapse" data-target="#toggle5" data-parent="#sidenav01" class="collapsed">
						          <span></span>Coordenador<span class="caret"></span>
						          </a>
						          <div class="collapse" id="toggle5" style="height: 0px;">
						            <ul class="nav nav-list submenu">
						              <li><a href="{{url('/administrador/coordenador/cadastrar')}}">Cadastrar</a></li>
						              <li><a href="{{url('/administrador/coordenador/visualizar')}}">Visualizar</a></li>
						          
						            </ul>
						          </div>
						
						    </li>
						    <li><a href="{{url('administrador/editar/perfil')}}">Editar Perfil</a></li>
						@endif
					@endif
					</ul>
				</nav>
			
		</div>



		<!-- conteudo de cada view -->
		<div  class="col-xs-12 col-sm-12 col-md-9 col-lg-9 index_corpo">
			<h5 class="data_atual">
				<?php
					$data = date ("d/m/Y");
					echo"$data";
				?>
			</h5>
			<br>
			
			@yield('content')
			

		</div>
				
		<div class="col-lg-1"> </div>
		
	</div>	
	
</div>
</body>
</html>