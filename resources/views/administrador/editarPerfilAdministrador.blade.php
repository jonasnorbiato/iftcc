@extends('layouts.layout')

@section('content')

	<h3 class="titulo_boby">Atualizar Perfil</h3>
	<div class="row">
		<form action="{{url('/administrador/editar/perfil/salvar', $user->id_usuario_fk)}}" method="post">
			{{ csrf_field() }}
	
			<div class="col-sm-12">
				<br>
				<label for="">Email:</label>
				<input type="email" name="email" class="form-control" value="{{$user->email_administrador}}">
			</div>
			
			<div class="col-sm-12">
				<br>
				<button type="submit" class="btn btn-success pull-right">Atualizar</button>	
				<a href="{{ URL::previous() }}" type="button" class="btn btn-primary"> Voltar</a>
			
			</div>
		</form>

		<div class="col-sm-12">
			<br>	
			<a href="{{url('/alterar/senha')}}">Alterar senha</a>
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

