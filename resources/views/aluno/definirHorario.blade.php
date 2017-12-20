@extends ('layouts.layout')

@section('content')
<h3 class="titulo_boby">Marca Defesa do TCC</h3>
<br>

	@if(Auth::check())
		@if((Auth::user()->aluno->projeto->id_data_apresentacao_fk) == null)
			<div class="col-xs-12">

				@if(Session::has('er'))
		    		<div class="alert alert-danger alert-dismissible">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    			<i class="fa fa-check" aria-hidden="true"></i>
			    			{!! session('er') !!}

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
						
			<form action="{{url('/aluno/horario/salvar')}}" method="post">
			{{ csrf_field() }}
				

				<div class="col-xs-12">
					<table class="table table-hover tabela">
						<thead>
							<tr>
								<th>
									
								</th>
								<th>
									Dia
								</th>
								<th>
									Hora
								</th>
							</tr>
						</thead>
						<tbody>
						
							 @foreach($datas as $data)
								<tr>
									<td>
										<input type="radio" name="data" value="{{$data->id_data_apresentacao}}">			
									</td>
									<td>
										{{date('d/m/Y', strtotime($data->data_hora))}}
									</td>
									<td>
										{{date('H:i', strtotime($data->data_hora))}}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
					<div class="col-xs-12">
						<br><br>
						<button class="btn btn-success pull-right btn-md" type="submit"><i class="fa fa-check" aria-hidden="true"></i> Salvar</button>
						<a href="{{ URL::previous() }}" type="button" class="btn btn-primary btn-md">Voltar</a>
				</div>
			</form>
		@endif	
	@endif



@endsection