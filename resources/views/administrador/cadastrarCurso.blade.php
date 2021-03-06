@extends('layouts.layout')
@section('content')
<h3 class="titulo_boby">Cadastrar Curso</h3>

 <br>
 <div class="row">

	 <form action="{{url('/administrador/curso/inserir')}}" method="post">
	 		{{ csrf_field() }}


	 		<div class="col-xs-12">
	 			<label for="">Nome:</label>
	 		</div>


	 		<div class="col-xs-12">
	 			<input type="text" class="form-control" name="nome_curso" placeholder="nome do Curso">
	 		</div>


	 		<div class="col-xs-12">
	 			<br>	<br>
	 			<button type="submit" class="btn btn-success pull-right">Salvar</button>
	 			<a type="button" class="btn btn-primary" href="{{ URL::previous() }}">Voltar</a>
	 		</div>		
	</form>

	<div class="col-xs-12">
		<br>	
		@if(Session::has('sucesso'))
    		<div class="alert alert-success alert-dismissible">
			 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    			<i class="fa fa-check" aria-hidden="true"></i>
	    			{!! session('sucesso') !!}

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
	    
 </div>
 


@endsection