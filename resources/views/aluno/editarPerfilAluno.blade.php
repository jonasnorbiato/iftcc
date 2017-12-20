
@extends('layouts.layout')

@section('content')

	<h3 class="titulo_boby">Editar Perfil</h3>
	<div class="row">
	
		<form action="{{url('/aluno/editar/perfil/salvar', $user->id_aluno)}}" method="post">
			{{ csrf_field() }}
				
			<div class="col-sm-12">
				<br>
				<label for="">Nome:</label>
				<br>
				<input type="text" class="form-control" value= "{{$user->nome_aluno}}" disabled>
				
			</div>									

			<div class="col-sm-12">
				<br>
				<label for="">Email:</label>
				<input type="email" name="email" class="form-control" value= "{{$user->email_aluno}}">
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
		      
				
			@if(Session::has('er'))
	    		<div class="alert alert-danger alert-dismissible">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<i class="fa fa-times" aria-hidden="true"></i>
		    			{!! 	session('er') !!}
	    		</div>
			@endif
		</div>
	</div>			


@endsection

