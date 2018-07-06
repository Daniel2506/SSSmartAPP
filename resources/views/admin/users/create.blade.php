@extends('admin.users.main')

@section('breadcrumb')
    <li><a href="{{ route('usuarios.index')}}">Usuario</a></li>
	<li class="active">Nuevo</li>
@stop

@section('module')
	<div class="box box-danger" id="user-create">
        <div class="box-body" id="render-form-user">
            {{-- Render form user --}}
        </div>
    </div>
@stop
