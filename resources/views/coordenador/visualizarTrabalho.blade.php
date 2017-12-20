@extends ('layouts.layout')

@section('content')
<h3 class="titulo_boby">Visualizar Trabalho</h3>
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
	<div class="col-md-3 col-md-offset-9">
		<select id="selectAno" class="form-control">
			@for($i = 0; $i < count($anos); $i++)
				<option value="{{ $anos[$i]->ano }}" {{ $anos[$i]->ano == $ano ? 'selected' : '' }}>{{ $anos[$i]->ano }}</option>
			@endfor
		</select>	
	</div>

	
	<table class="table table-hover table-striped tabela">
		<thead>
			<tr>
				<th>
					TRABALHOS
				</th>
				
				<th>
					
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			
			@foreach($projetos as $projeto)
		
					<tr>
						<td>
							<label for="" class="negrito">Trabalho: </label>
							{{$projeto->titulo}}
							<br>
							<label for="" class="negrito">Aluno: </label>
							@foreach($projeto->aluno as $aluno)
								{{ $aluno->nome_aluno }}. 
							@endforeach
							 <br>
					
								<label for="" class="negrito">Banca: </label>
								@foreach($projeto->banca as $banca)
									{{ $banca->professor->nome_professor }}. 
								@endforeach
					
							<br>
						</td>
						
						<td>
						<br>
							<a href="{{url('/coordenador/trabalho/editar', $projeto->id_projeto)}}" class="btn-editar btn btn-default"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" ></i></a>	
						</td>
						<td>
						<br>
							<a href="{{url('/coordenador/trabalho/excluir', $projeto->id_projeto)}}" class="btn-apagar btn btn-default"><i class="fa 		fa-trash-o fa-2x" aria-hidden="true"></i></a>
						</td>	
					</tr>
			
			@endforeach
		</tbody>
	</table>


<script>
	$('#selectAno').change(function(){
		let ano = $("#selectAno option:selected").val();
		window.location = '/coordenador/horario/visualizar/' + ano;
	});
</script>

@endsection 