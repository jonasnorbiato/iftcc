@extends('layouts.layout')

@section('content')
<h3 class="titulo_boby">Visualizar Curso</h3>
<br>
@if(Session::has('sucesso'))
	<div class="alert alert-success alert-dismissible">
	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<i class="fa fa-check" aria-hidden="true"></i>
			{!! session('sucesso') !!}

	</div>
@endif
@if(Session::has('er'))
	<div class="alert alert-danger alert-dismissible">
	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<i class="fa fa-times" aria-hidden="true"></i>
			{!! session('er') !!}

	</div>
@endif
	<table class="table table-striped table-hover tabela">			
		<thead>
			<tr>
				<th>
					Curso
				</th>
				
				<th> </th>
				<th></th>
			</tr>
		</thead>
		<tbody>
				@foreach($cursos as $curso)
			<tr>
				<td>
					{{$curso->nome_curso}}
				</td>
				
				<th>
					<a href="{{url('/administrador/curso/editar', $curso->id_curso)}}" class="btn-editar btn btn-default"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i></a>
				</th>

				<td>
					<a href="{{url('administrador/curso/excluir',$curso->id_curso)}}"  class=" btn-apagar btn btn-default"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>	
				</td>

			</tr>
		@endforeach

		</tbody>
	</table>

@endsection