@extends('layouts.layout')

@section('content')
<h3 class="titulo_boby">Cadastrar Coordenador</h3>

<br>
<form action="{{url('/administrador/coordenador/inserir')}}" method="POST">
		{{ csrf_field() }}
		
	
		<div class="col-md-6">
			
			<label for="opcao2">
			<input type="radio" id="opcao2" name="data" class="form-check-input data" value="dia"> Professor já Cadastrado	
			</label>
			<br>				
			<label for="opcao1">
			<input type="radio"  id="opcao1" name="data" class="form-check-input data" value="semana">  Cadastrar Professor
			</label>
			
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
				
					<br>
					<label for="">*Nome:</label><br>
					<input type="text" name="nome" class="form-control">
				
					<br>
					<label for="">*Sobrenome:</label><br>
					<input type="text" name="sobrenome" class="form-control">
				

					
					<label for="">*Email:</label><br>
					<input type="email" name="email" class="form-control">
			</div>

		</div>
		
		
		<div class="col-md-6">
			<label for="">Curso:</label>	
			<select name="curso" id="" class="form-control">
				<option disabled selected value="">Selecione</option>
				@foreach($cursos as $curso)
					<option value="{{$curso->id_curso}}">{{$curso->nome_curso}}</option>
				@endforeach
			</select>
			<br>
			<label for="">Login - SIAPE:</label><br>
			<input type="text" name="login" class="form-control">
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
	</div>
</form>


@endsection