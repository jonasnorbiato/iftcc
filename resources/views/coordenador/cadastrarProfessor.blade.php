@extends('layouts.layout')

@section('content')

<h3 class="titulo_boby">Cadastrar Professor</h3>
<br>
<form action="{{url('/coordenador/professor/inserir', $curso)}}" method="POST">
		{{ csrf_field() }}
	<div class="col-md-12">
			
			<label for="opcao2">
			<input type="radio" id="opcao2" name="data" class="form-check-input data" value="dia"> Professor já Cadastrado em Outro Curso	
			</label>
			<br>				
			<label for="opcao1">
			<input type="radio"  id="opcao1" name="data" class="form-check-input data" value="semana">  Cadastrar Professor
			</label>
	</div>
	
	<div id="bloco1" style="display: none;" >
		<br>
		<label for="">Professor:</label>	
		<select name="professor" class="form-control">
			<option selected disabled="">Selecione</option>
			@foreach($professores as $professor)
				<option  value="{{$professor->id_professor}}">{{$professor->nome_professor}} {{$professor->sobrenome_professor}}</option>
			@endforeach
		</select>
	</div>	

	<div id="bloco2" style="display: none;" >	

		<div class="col-md-6">
			<br>
			<label for="">*Nome:</label><br>
			<input type="text" name="nome_professor" value="" class="form-control">
		</div>

		<div class="col-md-6">
			<br>
			<label for="">*Sobrenome:</label><br>
			<input type="text" name="sobrenome_professor" class="form-control">
		</div>

		<div class="col-md-12">
			<br>
			<label for="">*Email:</label><br>
			<input type="email" name="email_professor" class="form-control">
		</div>
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


@endsection