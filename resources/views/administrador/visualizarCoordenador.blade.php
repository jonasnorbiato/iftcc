@extends('layouts.layout')

@section('content')
<h3 class="titulo_boby">Visualizar Coordenador</h3>
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
<table class="table table-striped tabela">			
	<thead>
		<tr>
			<th>
				Nome
			</th>
			<th>
				Curso
			</th>
			<th>
				Usuário	
			</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($coordenadores as $coordenador)
		<tr>
			<td>
				{{$coordenador->professor->nome_professor}} {{$coordenador->professor->sobrenome_professor}}
			</td>
			<td>
				{{$coordenador->curso->nome_curso}}
			</td>
			<td>
				{{$coordenador->usuario->login}}
			</td>
			<td>
				
				<a href="{{URL::to('/administrador/' .$coordenador->id_professor_fk. '/coordenador/'.$coordenador->id_curso_fk.'/editar')}}" class="btn-editar btn btn-default"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i></a>	

			</td>
			<td>
				<a href="{{URL('/administrador/' .$coordenador->id_professor_fk. '/coordenador/'.$coordenador->id_curso_fk.'/excluir')}}" class="btn-apagar btn btn-default"><i class="fa fa-trash-o 	fa-2x"  aria-hidden="true"></i></a>
			</td>
		</tr>
		@endforeach	
	</tbody>

</table>
@endsection