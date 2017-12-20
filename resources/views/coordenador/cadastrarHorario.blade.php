@extends('layouts.layout')

@section('content')

<h3 class="titulo_boby">Cadastrar dias de Apresentações</h3>

<form  action="{{url('/coordenador/horario/inserir')}}" method="POST" id="form_horario" class="form-inilene">
	{{ csrf_field() }}
	<div class="form-group">	
											
			
			<br>
			<label for="opcao2">
				<input type="radio" id="opcao2" name="data" class="form-check-input data" value="dia"> Cadastrar dia	
			</label>
			<br>				
			<label for="opcao1">
				<input type="radio"  id="opcao1" name="data" class="form-check-input data" value="semana">  Cadastrar semana 
			</label>
				
		
			<br><br>
			
			<div id="bloco1" style="display: none;" >
				<label for="">Dia de Apresentação</label>
				<br>
				<div class="input-group registration-date-time col-xs-5">
					<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
            		<input class="form-control" name="dia" type="date">
            	</div>
				<br><br>
				
				
					<div class="row">
		

						<div class="col-xs-6 col-sm-6 colmd-4 col-lg-4">

							
			       			<h4>Matutino</h4>	

							<label for="dia_op1"><input type="checkbox" name="hora[]" id="dia_op1" value=" 07:30:00"> 7:30</label><br>
							<label for="dia_op2"><input type="checkbox" name="hora[]" id="dia_op2" value="08:00:00"> 8:00</label>
							<label for="dia_op3"><input type="checkbox" name="hora[]" id="dia_op3" value=" 8:30:00"> 8:30</label><br>
							<label for="dia_op4"><input type="checkbox" name="hora[]" id="dia_op4" value=" 9:00:00"> 9:00</label>
							<label for="dia_op5"><input type="checkbox" name="hora[]" id="dia_op5" value=" 9:30:00"> 9:30</label><br>
							<label for="dia_op6"><input type="checkbox" name="hora[]" id="dia_op6" value="10:00:00"> 10:00</label>
							<label for="dia_op7"><input type="checkbox" name="hora[]" id="dia_op7" value="10:30:00"> 10:30</label><br>
							<label for="dia_op8"><input type="checkbox" name="hora[]" id="dia_op8" value="11:00:00"> 11:00</label>
							<label for="dia_op9"><input type="checkbox" name="hora[]" id="dia_op9" value="11:30:00"> 11:30</label>
			       </div>		

			       <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			       		<h4>Vespertino</h4>	
			       		<label for="dia_op10"><input type="checkbox" name="hora[]" id="dia_op10" value="12:00:00"> 12:00</label>
						<label for="dia_op11"><input type="checkbox" name="hora[]" id="dia_op11" value="12:30:00"> 12:30</label><br>
						<label for="dia_op12"><input type="checkbox" name="hora[]" id="dia_op12" value="13:00:00"> 13:00</label>
						<label for="dia_op13"><input type="checkbox" name="hora[]" id="dia_op13" value="13:30:00"> 13:30</label><br>
						<label for="dia_op14"><input type="checkbox" name="hora[]" id="dia_op14" value="14:00:00"> 14:00</label>
						<label for="dia_op15"><input type="checkbox" name="hora[]" id="dia_op15" value="14:30:00"> 14:30</label><br>
						<label for="dia_op16"><input type="checkbox" name="hora[]" id="dia_op16" value="15:00:00"> 15:00</label>
						<label for="dia_op17"><input type="checkbox" name="hora[]" id="dia_op17" value="15:30:00"> 15:30</label><br> 
						<label for="dia_op18"><input type="checkbox" name="hora[]" id="dia_op18" value="16:00:00"> 16:00</label>
						<label for="dia_op19"><input type="checkbox" name="hora[]" id="dia_op19" value="16:30:00"> 16:30</label><br>
						<label for="dia_op20"><input type="checkbox" name="hora[]" id="dia_op20" value="17:00:00"> 17:00</label>
						<label for="dia_op21"><input type="checkbox" name="hora[]" id="dia_op21" value="17:30:00"> 17:30</label>
						
			       </div>	

			       <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
				       	<h4>Noturno</h4>								
						<label for="dia_op22"><input type="checkbox" name="hora[]" id="dia_op22" value="18:00:00"> 18:00</label>		
						<label for="dia_op23"><input type="checkbox" name="hora[]" id="dia_op23" value="18:30:00"> 18:30</label><br>
						<label for="dia_op24"><input type="checkbox" name="hora[]" id="dia_op24" value="19:00:00"> 19:00</label>
						<label for="dia_op25"><input type="checkbox" name="hora[]" id="dia_op25" value="19:30:00"> 19:30</label><br>
						<label for="dia_op26"><input type="checkbox" name="hora[]" id="dia_op26" value="20:00:00"> 20:00</label>
						<label for="dia_op27"><input type="checkbox" name="hora[]" id="dia_op27" value="20:30:00"> 20:30</label><br>
						<label for="dia_op28"><input type="checkbox" name="hora[]" id="dia_op28" value="21:00:00"> 21:00</label>
						<label for="dia_op29"><input type="checkbox" name="hora[]" id="dia_op29" value="21:30:00"> 21:30</label>
						
			       </div>
				</div>
				<button class="btn btn-success pull-right btn-md" type="submit"><i class="fa fa-check" aria-hidden="true"></i> ENVIAR</button>
			

				
				<br>
				
			</div>

			<div id="bloco2" style="display: none;">
				<label for="">Semana de Apresentação</label>
				<br>
				
				<div class="col-xs-6">
					<label for="">Primeiro dia:</label>
					<div class="input-group registration-date-time col-xs-6">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
        				<input class="form-control"  name="primeiro_dia" type="date">
        			</div>
			
				</div>
				<div class="col-xs-6">
					<label for="">Último dia:</label>
					<div class="input-group registration-date-time col-xs-6">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
        				<input class="form-control"  name="ultimo_dia" type="date">
        			</div>
			
				</div>
				<br><br>
				
				
					<div class="row">
		

						<div class="col-xs-6 col-sm-6 colmd-4 col-lg-4">

							
			       			<h4>Matutino</h4>	

							<label for="semana_op1"><input type="checkbox" id="semana_op1" name="horario[]" value=" 7:30:00"> 7:30</label><br>
							<label for="semana_op2"><input type="checkbox" id="semana_op2" name="horario[]" value=" 8:00:00"> 8:00	</label>
							<label for="semana_op3"><input type="checkbox" id="semana_op3" name="horario[]" value=" 8:30:00"> 8:30</label><br>
							<label for="semana_op4"><input type="checkbox" id="semana_op4" name="horario[]" value=" 9:00:00"> 9:00</label>
							<label for="semana_op5"><input type="checkbox" id="semana_op5" name="horario[]" value=" 9:30:00"> 9:30</label><br>
							<label for="semana_op6"><input type="checkbox" id="semana_op6" name="horario[]" value="10:00:00"> 10:00</label>
							<label for="semana_op7"><input type="checkbox" id="semana_op7" name="horario[]" value="10:30:00"> 10:30</label><br>
							<label for="semana_op8"><input type="checkbox" id="semana_op8" name="horario[]" value="11:00:00"> 11:00</label>
							<label for="semana_op10"><input type="checkbox" id="semana_op10" name="horario[]" value="11:30:00"> 11:30</label>
			       </div>		

			       <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			       		<h4>Vespertino</h4>	
			       		<label for="semana_op11"><input type="checkbox" id="semana_op11" name="horario[]" value="12:00:00"> 12:00</label>
						<label for="semana_op12"><input type="checkbox" id="semana_op12" name="horario[]" value="12:30:00"> 12:30</label><br>
						<label for="semana_op13"><input type="checkbox" id="semana_op13" name="horario[]" value="13:00:00"> 13:00</label>
						<label for="semana_op14"><input type="checkbox" id="semana_op14" name="horario[]" value="13:30:00"> 13:30</label><br>
						<label for="semana_op15"><input type="checkbox" id="semana_op15" name="horario[]" value="14:00:00"> 14:00</label>
						<label for="semana_op16"><input type="checkbox" id="semana_op16" name="horario[]" value="14:30:00"> 14:30</label><br>
						<label for="semana_op17"><input type="checkbox" id="semana_op17" name="horario[]" value="15:00:00"> 15:00</label>
						<label for="semana_op18"><input type="checkbox" id="semana_op18" name="horario[]" value="15:30:00"> 15:30</label><br>
						<label for="semana_op19"><input type="checkbox" id="semana_op19" name="horario[]" value="16:00:00"> 16:00</label>
						<label for="semana_op20"><input type="checkbox" id="semana_op20" name="horario[]" value="16:30:00"> 16:30</label><br>
						<label for="semana_op21"><input type="checkbox" id="semana_op21" name="horario[]" value="17:00:00"> 17:00</label>
						<label for="semana_op22"><input type="checkbox" id="semana_op22" name="horario[]" value="17:30"> 17:30</label>
						
			       </div>	

			       <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
				       	<h4>Noturno</h4>								
						<label for="semana_op23"><input type="checkbox" id="semana_op23" name="horario[]" value="18:00:00"> 18:00</label>		
						<label for="semana_op24"><input type="checkbox" id="semana_op24" name="horario[]" value="18:30:00"> 18:30</label><br>
						<label for="semana_op25"><input type="checkbox" id="semana_op25" name="horario[]" value="19:00:00"> 19:00</label>
						<label for="semana_op26"><input type="checkbox" id="semana_op26" name="horario[]" value="19:30:00"> 19:30</label><br>
						<label for="semana_op27"><input type="checkbox" id="semana_op27" name="horario[]" value="20:00:00"> 20:00</label>
						<label for="semana_op28"><input type="checkbox" id="semana_op28" name="horario[]" value="20:30:00"> 20:30</label><br>
						<label for="semana_op29"><input type="checkbox" id="semana_op29" name="horario[]" value="21:00:00"> 21:00</label>
						<label for="semana_op30"><input type="checkbox" id="semana_op30" name="horario[]" value="21:30:00"> 21:30</label>
						
			       </div>
				</div>
				<button class="btn btn-success pull-right btn-md button" type="submit"><i class="fa fa-check" aria-hidden="true"></i> ENVIAR</button>
			
			</div>


	</div>

</form>

<div class="col-xs-12">
	<br><br>
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


@endsection