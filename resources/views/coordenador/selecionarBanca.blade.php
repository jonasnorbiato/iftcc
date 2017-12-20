@extends('layouts.layout')

@section('content')
<h3 class="titulo_boby">Selecionar Banca</h3>
<br>
<form action="{{url('/coordenador/banca/selecionar/salvar')}}" method="POST">
	{{ csrf_field() }}
	<div class="col-xs-12 col-md-8">
		<label for="">Trabalho</label><br>
		<select name="trabalho" id="" class="form-control">
			<option value="" disabled="" selected="">Selecione</option>
			@foreach($projetos as $projeto)
				<option value="{{$projeto->id_projeto}}">{{$projeto->titulo}}</option>
			@endforeach
		</select>

	</div>

	<div class="col-xs-12 col-md-4">
		<br>
		<select name="professores[]" id="" class="selectpicker form-control" multiple data-max-options="3" data-live-search="true">
			@foreach($professores as $professor)
				<option value="{{$professor->id_professor}}">{{$professor->nome_professor}}  {{$professor->sobrenome_professor}}</option>
			@endforeach
		</select>

	</div>
		


	<div class="col-xs-12 col-md-12">
		<br><br>
		<button class="btn btn-success pull-right btn-md" type="submit"><i class="fa fa-check" aria-hidden="true"></i>  SELECIONAR</button>
		
	</div>
</form>

<div class="col-xs-12 col-md-12">
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

@endsection