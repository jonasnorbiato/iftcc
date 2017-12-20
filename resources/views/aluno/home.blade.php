@extends('layouts.layout')

@section('content')

		@if(Session::has('sucesso'))

			<div class="alert alert-success alert-dismissible">
				 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    			<i class="fa fa-check" aria-hidden="true"></i>
		    			{!! session('sucesso') !!}
			</div>
		@endif
		<br>
		<label for="" class="negrito">Curso:</label>
		</label> {{Auth::user()->aluno->curso->nome_curso}}</label>
		<br>
		<label for="" class="negrito">Nome: </label>
		<label>{{Auth::user()->aluno->nome_aluno}}</label>		
		<br>
		<label for="" class="negrito">Usuário: </label>
		<label for=""> {{Auth::user()->login}}</label>
		<br>
		@if(Auth::user()->aluno->id_projeto_fk == null)
				<label for="" class="negrito">Trabalho: </label>
				 <label for=""> não definido pela coordenação no momento.</label>

		@else		
				<label for="" class="negrito">Trabalho:</label>
				<label for=""> {{Auth::user()->aluno->projeto->titulo}}</label>
				<br>

			@if(Auth::user()->aluno->projeto->id_data_apresentacao_fk != null)
				<label for="" class="negrito">Data de apresentação:</label>				
				<label for=""> {{date('d/m/Y', strtotime(Auth::user()->aluno->projeto->dataapresentacao->data_hora))}}</label>
				<br>
				<label for="" class="negrito">Hora da Apresentação: </label>
				<label for=""> {{date('H:i', strtotime(Auth::user()->aluno->projeto->dataapresentacao->data_hora))}}</label>
				<br>
			@else
				<label for="" class="negrito">Data de apresentação:</label>
				<label for=""> não existe data vinculada a este trabalho.</label>
				<br>	
			@endif

			@if($bancas != null)
				<label for="" class="negrito">Banca: </label>
				@foreach($bancas as $banca)
					<label for="">{{$banca->nome_professor}} {{$banca->sobrenome_professor}}.</label>
				@endforeach
				<br>
			@else
				<label for="" class="negrito">Banca: </label>
				<label for="">não cadastrada pela coordenação no momento.</label>
			@endif
			@endif		


@endsection