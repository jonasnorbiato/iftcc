@extends('layouts.layout')

@section('content')

	<h3 class="titulo_boby">Atualizar Perfil</h3>
	<div class="row">

		<form action="{{url('/coordenador/editar/perfil/salvar', $user->professor->id_professor)}}" method="post">
			{{ csrf_field() }}
			
			<div class="col-sm-6">
				<br>
				<label for="">Nome:</label>
				<br>
				<input type="text" class="form-control" name="nome_professor" value="{{$user->professor->nome_professor}}" maxlength="35">
			</div>									

			<div class="col-sm-6">
				<br>
				<label for="">Sobrenome:</label>
				<br>
				<input type="text" class="form-control" name="sobrenome_professor" maxlength="60" value="{{$user->professor->sobrenome_professor}}">								
			</div>

			<div class="col-sm-12">
				<br>
				<label for="">Email:</label>
				<input type="email" name="email_professor" class="form-control" value="{{$user->professor->email_professor}}" maxlength="50">
			</div>
			<div class="col-sm-12">
				<br>
				<button type="submit" class="btn btn-success pull-right">Atualizar</button>	
				<a href="{{ URL::previous() }}" type="button" class="btn btn-primary voltar">
					 <i class="fa fa-reply" aria-hidden="true"></i>
				</a>
				<br> <br>
				</form>
				<br>
				<a href="{{url('/alterar/senha')}}">Alterar senha</a>
			</div>
			<div class="col-sm-12">
				<br>
				@if(Session::has('sucesso'))
		    		<div class="alert alert-success alert-dismissible">
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
			</div>
	</div>			

@endsection

