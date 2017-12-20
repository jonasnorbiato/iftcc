@extends('layouts.layout')

@section('content')
<h3 class="titulo_boby">Cadastrar Aluno</h3>

<br>
	<div class="row">
	<form action="{{url('/coordenador/aluno/inserir',$curso)}}" method="POST">
			{{ csrf_field() }}
		<div class="col-md-12">
			<label for="">*Nome:</label><br>
			<input type="text" class="form-control" name="nome_aluno">		
		</div>
		<div class="col-md-6">
			<br>
			<label for="">Email:</label><br>
			<input type="email" class="form-control" name="email_aluno">		
		</div>
		<div class="col-md-6">
			<br>
			<label for="">*Usuário - Matrícula:</label><br>
			<input type="text" class="form-control" name="login">		
		</div>

		<div class="col-md-12">
			<br><br><br>
			<button type="submit" class="btn btn-success pull-right">Salvar</button>
			<a type="button" class="btn btn-primary" href="{{ URL::previous() }}">Voltar</a>
		</div>

		<div class="col-xs-12 col-sm-12">
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
		
	</form>
</div>

@endsection