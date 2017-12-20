@extends('layouts.layout')

@section('content')

<h3 class="titulo_boby">Enviar TCC</h3>
<br><br>
@if(Auth::user()->aluno->id_projeto_fk == null)
	<div class="alert alert-warning" role="alert">
	  	Não existe trabalho vinculado ao usuário, aguarde a coordenação.
	</div>

@elseif(Auth::user()->aluno->projeto->status == 0)		

	<form action="/aluno/enviar/tcc/inserir" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		
			<div class="form-group">
				<input type="file" name="arquivo" accept=".pdf" >
			</div>

		<div class="col-md-12">
			<br>
			<div class="alert alert-warning" role="alert">
	  			<label for="">Atenção! O arquivo só pode ser enviado apenas uma vez, tenha certeza de que o arquivo escolhido é a última versão do sistema.</label>
			</div>	
		<br>
			<button type="submit" class="btn btn-success pull-right">Enviar</button>
			<a class="btn btn-primary" href="{{ URL::previous() }}">Voltar</a>


			<br><br>
		</div>

	</form>

	<div class="col-md-12">
			
		<br><br>
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

	    @if(Session::has('er'))
    		<div class="alert alert-danger alert-dismissible">
				 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    			<i class="fa fa-times" aria-hidden="true"></i>
	    			{!! session('er') !!}

	    	</div>
		@endif
	
	</div>
@else
	<div class="alert alert-warning" role="alert">
	  	Trabalho de Conclusão de Curso já enviado.
	</div>		

@endif

@endsection