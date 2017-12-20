@extends('layouts.layout')
@section('content')

<h3 class="titulo_boby">Status</h3>
<br>		
		<label for="" class="negrito">Administrador</label>
		<br>		
		<label class="negrito">Usuário: </label>
		<label> {{Auth::user()->login}}</label>
		<br>
		<label for="" class="negrito">Email: </label> 
		<label for=""> {{Auth::user()->administrador->email_administrador}}</label>

@endsection