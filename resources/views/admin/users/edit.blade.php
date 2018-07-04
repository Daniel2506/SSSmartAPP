@extends('admin.users.main')

@section('breadcrumb')
	<li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
    <li><a href="{{ route('usuarios.show', ['usuarios' => $user->id]) }}">{{ $user->id }}</a></li>
    <li class="active" >Editar</li>
@stop
@section('module')
    @include('admin.users.create')
@stop
