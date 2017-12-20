@extends ('layouts.layout')

@section('content')
<h3 class="titulo_boby">Visualizar Horário</h3>
<br>
@if(Session::has('sucesso'))
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<i class="fa fa-check" aria-hidden="true"></i>
		{!! session('sucesso') !!}
	</div>
@endif
<br>
<!-- FILTRO POR ANO -->
<div class="col-md-3 col-md-offset-9">
	<select id="selectAno" class="form-control">
		@for($i = 0; $i < count($anos); $i++)
			<option value="{{ $anos[$i]->ano }}" {{ $anos[$i]->ano == $ano ? 'selected' : '' }}>{{ $anos[$i]->ano }}</option>
		@endfor
	</select>	
</div>
<!-- LISTA DE HORARIOS -->
	<table class="table table-hover table-striped tabela">
		<thead>
			<tr>
				<th>
					DIA
				</th>
				<th>
					HORA
				</th>
				<th>
					<div class="coluna_visualizar_horario">
						TRABALHO
					</div>
					
				</th>
				
				<th>
					
				</th>
				
			</tr>
		</thead>
		<tbody>
			@foreach($horarios as $horario)
				<tr>
					<td>{{date('d/m/Y', strtotime($horario->data_hora))}}</td>
					<td>{{date('H:i', strtotime($horario->data_hora))}}</td>
					<td> 
						<div class="coluna_visualizar_horario">
						@if($horario->id_projeto !=null)
							
			
						
							<label for="" class="negrito">Titulo do Trabalho:  </label>		 {{$horario->titulo}}
							<br>
							<label for="" class="negrito">Aluno: </label>	
							@foreach($alunos as $aluno)
								@if($horario->id_data_apresentacao == $aluno->id_data_apresentacao_fk)
									{{$aluno->nome_aluno}}. 
								@endif
							@endforeach			
						@endif
						

					</td>			
					<td>	
						@if($horario->id_projeto ==null)
							<a href="{{url('/coordenador/horario/excluir', $horario->id_data_apresentacao)}}" class="btn-apagar btn btn-default"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>			

						@else
							<button class="btn-apagar btn btn-default" disabled=""><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></button>
							
						@endif
					</td>					
				</tr>
			
			@endforeach
		</tbody>
	</table>
@endsection 
<script>
	$('#selectAno').change(function(){
		let ano = $("#selectAno option:selected").val();
		window.location = '/coordenador/horario/visualizar/' + ano;
	});
</script>

