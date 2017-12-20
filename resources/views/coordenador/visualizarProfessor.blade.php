@extends('layouts.layout')

@section('content')

<h3 class="titulo_boby">Visualizar Professor</h3>
<br>
	@if(Session::has('er'))
		<div class="alert alert-danger alert-dismissible">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			<i class="fa fa-times" aria-hidden="true"></i>
    			{!! session('er') !!}

    	</div>
	@endif

	@if(Session::has('sucesso'))
		<div class="alert alert-success alert-dismissible">
		 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			<i class="fa fa-check" aria-hidden="true"></i>
    			{!! session('sucesso') !!}

    	</div>
	@endif
	<table class="table table-striped table-hover tabela">			
		<thead>
			<tr>
				<th>
					Professores
				</th>
				<th>
					Email
				</th>
				
				<th>
					
				</th>
			</tr>
		</thead>
		<tbody>
				@foreach($professores as $professor)
			<tr>
				<td>
					{{$professor->nome_professor}}	{{$professor->sobrenome_professor}}
				</td>
				<td class="coluna_titulo">
					{{$professor->email_professor}}
				</td>
				
				<td>
					<a href="{{url('/coordenador/professor/excluir', $professor->id_professor)}}" class="btn-apagar btn btn-default"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>
					<a href="{{url('/coordenador/professor/editar', $professor->id_professor)}}" class="btn-editar btn btn-default"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i></a>	
				</td>
			</tr>
		@endforeach

		</tbody>
	</table>

@endsection