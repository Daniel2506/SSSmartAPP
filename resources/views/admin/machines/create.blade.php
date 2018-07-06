@extends('admin.machines.main')

@section('breadcrumb')
    <li><a href="{{ route('maquinas.index')}}">Máquina</a></li>
	<li class="active">Nuevo</li>
@stop

@section('module')
	<div class="box box-danger" id="machine-create">
		{!! Form::open(['id' => 'form-machine', 'data-toggle' => 'validator']) !!}
			<div class="box-body" id="render-form-machine">
				{{-- Render form machine --}}
			</div>

			<div class="box-footer with-border">
	        	<div class="row">
					<div class="col-sm-2 col-md-offset-4 col-xs-6 text-left">
						<a href="{{ route('maquinas.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
					</div>
					<div class="col-sm-2 col-xs-6 text-right">
						<button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.create') }}</button>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
@stop
