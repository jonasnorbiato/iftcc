@extends('layouts.layout')

@section('content')

	<h3 class="titulo_boby">Alterar Senha</h3>
	<div class="row">
	
		<form action="{{url('/alterar/senha/salvar',$user->id_usuario)}}" method="post">
			{{ csrf_field() }}
				<div class="col-xs-12 col-sm-7">
				<br>
				<label for="">Senha Atual:</label>
				<br>
				<input type="password" class="form-control" name="senha_atual" value="">
				<br>
			</div>									
			
			<div class="col-xs-12 col-sm-7">
				
				<label for="">Nova Senha:</label>
				<br>
				<input type="password" class="form-control" name="nova_senha" value="">								
			</div>

			<div class="col-xs-12 col-sm-7">
				<br>
				<label for="">Confirmar senha:</label>
				<input type="password" name="confirmar_senha" class="form-control" value="">
			</div>
		

			<div class="col-xs-12 col-sm-12">
				<br><br>	
				<button type="submit" class="btn btn-success pull-right">Salvar</button>	
				<a href="{{ URL::previous() }}" type="button" class="btn btn-primary"> Voltar</a>
			
			</div>
			
		</form>
		
		<div class="col-xs-12 col-sm-12">
			<br>
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
		    			{!! 	session('er') !!}
	    		</div>
			@endif
		</div>
	</div>		

@endsection

