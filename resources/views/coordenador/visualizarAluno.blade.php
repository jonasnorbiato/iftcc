@extends ('layouts.layout')

@section('content')
<h3 class="titulo_boby">Visualizar Aluno</h3>

	<div class="col-xs-12">
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
			    			{!! 	session('er') !!}
		    		</div>
		@endif

	</div>
	<table class="table table-hover table-striped tabela">
		<thead>
			<tr>
				<th>
					Nome
				</th>
				<th>
					Email
				</th>
				<th>Usuário</th>
				<th></th>
				<th></th>		
				
			</tr>
		</thead>
		<tbody>
			@foreach($alunos as $aluno)
				<tr>
					<td>{{$aluno->nome_aluno}}</td>
					<td>{{$aluno->email_aluno}}</td>
					<td>
						{{$aluno->usuario->login}}
					</td>
					<td>
						<a href="{{url('/coordenador/aluno/editar', $aluno->id_aluno)}}" class="btn-editar btn btn-default"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i></a>
					</td>
					<td>	
						<a href="{{url('/coordenador/aluno/excluir', $aluno->id_aluno)}}" class="btn-apagar btn btn-default"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>



@endsection 