@extends('layouts.layout')
@section('content')
	<label for="" class="negrito">Coordenador</label>
	<br>
	<label for="" class="negrito">Curso: </label>
	<label>{{Auth::user()->coordenador->curso->nome_curso}}</label>
	<br>
	<label for="" class="negrito">Nome: </label>
	<label>{{Auth::user()->coordenador->professor->nome_professor}} {{Auth::user()->coordenador->professor->sobrenome_professor}}</label>		
	<br>
	<label class="negrito">Usuário: </label>
	<label>{{Auth::user()->login}}</label>
	<br>
	<label for="" class="negrito">Email: </label>
	<label>{{Auth::user()->coordenador->professor->email_professor}}</label>

@endsection

