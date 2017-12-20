@extends('layouts.layout')

@section('content')

<h3>Todos os registros associados a este curso serão apagados</h3>

<a href="{{ URL::previous() }}" class="btn btn-primary">Cancelar</a>
<a href="" class="btn btn-success">Excluir</a>

@endsenction