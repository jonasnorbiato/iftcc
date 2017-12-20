@extends('layouts.layout')

@section('content')

<h3 class="titulo_boby">Cadastrar Grupo de Aluno</h3>
<br><br>	

<div class="col-md-12">	
	<form action="{{url('/coordenador/grupo/aluno/inserir')}}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		
			<div class="form-group">
				<input type="file" name="arquivo" accept=".csv" >
			</div>

			<br>
			<label for="">Arquivo com a extensão <b>.csv</b> </label>
			
						<div class="link">
							<a href="" data-toggle="modal" class="" data-target="#myModal">exemplo do arquivo.</a>
						</div>					


						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog  modal-lg" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Exemplo do arquivo</h4>
						      </div>
						      <div class="modal-body" >
						      <center>
						        <img src="{{asset('img/EXEMPLO.PNG')}}" alt="">		
						      </center>		
						      </div>
							 					
						    
						    </div>
						  </div>
						</div>

			<br><br>
			<button type="submit" class="btn btn-success pull-right">Enviar</button>
			<a class="btn btn-primary" href="{{ URL::previous() }}">Voltar</a>


			<br><br>
		</div>

	</form>

	<div class="col-md-12">

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

	    @if(Session::has('sucesso'))
    		<div class="alert alert-success alert-dismissible">
				 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    			<i class="fa fa-check" aria-hidden="true"></i>
	    			{!! session('sucesso') !!}

	    	</div>
		@endif
	
	</div>


@endsection
