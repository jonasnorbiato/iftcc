<!DOCTYPE html>
<html>
<head>
	<title>IFTCC - Entrar</title>
	<meta charset="utf-8">
	
	<link rel="icon" href="{{asset('img/icone_if.png')}}">
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">  
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/releway.css')}}">  
	<link rel="stylesheet" href="{{asset('css/login.css')}}">  
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script  src="{{asset('js/bootstrap.min.js')}}"></script>
			
</head>
<body>
		<div class="container">	
			<div class="row">										
				<div  class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 corpo_login">
									
					<img src="img/ifes.png" alt="" class="logo_ifes">
					<br><br><br>
					<h1>IFTCC - Campus de Alegre</h1>
					<br><br>
					<br>
					@if(Session::has('sucesso'))
			    		<div class="alert alert-succcess alert-dismissible">
						 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    			<i class="fa fa-check" aria-hidden="true"></i>
				    			{!! session('sucesso') !!}

				    	</div>
					@endif

					@if (count($errors))
		    			<div class="alert alert-danger alert-dismissible">
		   					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		   
		  
			    			@foreach($errors->all() as $erro)
									<i class="fa fa-times" aria-hidden="true"></i>
									{{ $erro }}
								<br>
			    			@endforeach
						</div>
		       		 @endif
				      
						
					@if(Session::has('er'))
			    		<div class="alert alert-danger alert-dismissible">
							 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<i class="fa fa-times" aria-hidden="true"></i>
				    			{!! 	session('er') !!}
			    		</div>
					@endif
							
						
					 <div class="form-group">
					 <label for="usuario" class="info">Entre com a matrícula ou número de SIAPE</label>
						<form method="POST" action="{{url('/login/entrar')}}">
						{{csrf_field()}}
							<input type="text" name="usuário" class="form-control" placeholder="Usuário" maxlength="30">
							<br>
							<input type="password" name= "senha" class="form-control" placeholder="Senha" maxlength="60">
							<br><br>
							<input type="submit" class="btn-lg btn-block btn btn-primary btn-lg" value="Entrar" >
						</form>	
						<br><br>	


						<div class="link">
							<a href="" data-toggle="modal" data-target="#myModal">Esqueceu a senha?</a>
						</div>
												
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Esqueceu a senha?</h4>
						      </div>
						      <div class="modal-body" >
						        <p>Sua nova senha será enviada para o seu email. 		procure a coordenação do curso caso não tenha um 	email 	vinculado a sua conta.
								</p>
								<br><br>		
								<form action="enviar/recuperar/senha" method="POST">
									<label for=""> Usuário</label>
									<input type="text" 	name="login" class="form-control" placeholder="usuário">
									{{csrf_field()}}	
									<br>
									<button type="submit" class="btn btn-primary">RECUPERAR SENHA</button>	
								</form>

						      </div>
							 					
						    
						    </div>
						  </div>
						</div>

						
						
					</div>	
				</div>
	
			</div>
		</div>

</body>
</html>