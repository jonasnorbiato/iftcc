@extends('layouts.layout')

@section('content')

<h3 class="titulo_boby">Visualizar Professor</h3>
<br>
	<table class="table table-striped table-hover tabela">			
		<thead>
			<tr>
				<th>
					Professores
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
				<th class="coluna_titulo">
					
				</th>
			</tr>
		@endforeach

		</tbody>
	</table>

@endsection