@extends('layouts.layout')

@section('content')
	<h3 class="titulo_boby">Atualizar Aluno</h3>
	<div class="row">
		<form action="{{url('/coordenador/aluno/salvar', $aluno->id_aluno)}}" method="post">
			{{ csrf_field() }}
			<div class="col-sm-12">
				<br>
				<label for="">Usuário:</label>
				<br>
				<input type="text" class="form-control" name="login" value="{{$user->login}}">
			</div>									
			<div class="col-sm-12">
				<br>
				<label for="">Nome:</label>
				<br>
				<input type="text" class="form-control" name="nome_aluno" value= "{{$aluno->nome_aluno}}">				
			</div>			
			<div class="col-sm-12">
				<br>
				<label for="">Email:</label>
				<input type="email" name="email_aluno" class="form-control" value= "{{$aluno->email_aluno}}">
			</div>
			<div class="col-sm-12">
				<br>
				<button type="submit" class="btn btn-success pull-right">Atualizar</button>	
				<a href="{{ URL::previous() }}" type="button" class="btn btn-primary"> Voltar</a>
			</div>
		</form>
		<div class="col-sm-12">
			<br>
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