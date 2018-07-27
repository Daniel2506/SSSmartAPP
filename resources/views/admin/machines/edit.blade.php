@extends('admin.machines.main')

@section('breadcrumb')
	<li><a href="{{ route('maquinas.index') }}">Máquinas</a></li>
    <li><a href="{{ route('maquinas.show', ['maquinas' => $machine->id]) }}">{{ $machine->id }}</a></li>
    <li class="active">Editar</li>
@endsection
@section('module')
    @include('admin.machines.create')
@endsection
