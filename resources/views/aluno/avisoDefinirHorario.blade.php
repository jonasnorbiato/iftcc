@extends('layouts.layout')

@section('content')

<h3 class="titulo_boby">Marcar Defesa de TCC</h3>
<br><br>

@if(Session::has('aviso'))
	<div class="alert alert-warning" role="alert">
			
			<i class="fa fa-exclamation-triangle fa-1x" aria-hidden="true"></i>
			&nbsp;&nbsp;&nbsp;
			{!! session('aviso') !!}

	</div>
@endif

@endsection