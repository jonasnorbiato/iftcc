@extends('layouts.layout')


@section('content')

<h3 class="titulo_boby">Cadastrar Trabalho</h3>

<br><br>

<form action="{{url('/coordenador/trabalho/inserir', $curso)}}" method="POST">
	
	{{ csrf_field() }}

	<div class="col-xs-12">
		<label for="">Título do trabalho:</label><br>
		<input type="text" name="titulo" class="form-control">
	</div>
	<div class="col-xs-6">
	<br>
		<label for="">1º Alunos</label><br>
		<select name="primeiro_aluno" id="" class="form-control">
			<option selected="" disabled="" value="">Selecione</option>
			@foreach($alunos as $aluno)
				<option value="{{$aluno->id_aluno}}">{{$aluno->nome_aluno}}</option>
			@endforeach
		</select>
	</div>	
	<div class="col-xs-6">
	<br>
		<label for="">2º Alunos</label><br>
		<select name="segundo_aluno" id="" class="form-control">
			<option selected="" disabled="" value="">Selecione</option>
			@foreach($alunos as $aluno)
				<option value="{{$aluno->id_aluno}}">{{$aluno->nome_aluno}}{{$aluno->sobrenome_aluno}}</option>
			@endforeach
		</select>
	</div>	

	<div class="col-xs-12">
	<br><br><br>
		<button class="btn btn-success pull-right btn-md" type="submit"><i class="fa fa-check" aria-hidden="true"></i> Salvar</button>
		<a href="{{ URL::previous() }}" type="button" class="btn btn-primary btn-md"> Voltar</a>
	</div>
</form>

<div class="col-xs-12">
	<br><br>
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
			
        @endif
		      
</div>


@endsection