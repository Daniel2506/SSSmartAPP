@extends('admin.users.main')

@section('breadcrumb')
    <li><a href="{{ route('usuarios.index')}}">Usuario</a></li>
	<li class="active">Nuevo</li>
@stop

@section('module')
	<div class="box box-success" id="user-create">
		{!! Form::open(['id' => 'form-user', 'data-toggle' => 'validator']) !!}
			<div class="box-body" id="render-form-user">
				{{-- Render form user --}}
			</div>

			<div class="box-footer with-border">
	        	<div class="row">
					<div class="col-sm-2 col-md-offset-4 col-xs-6 text-left">
						<a href="{{ route('usuarios.index') }}" class="btn btn-default btn-sm btn-block">{{ trans('app.cancel') }}</a>
					</div>
					<div class="col-sm-2 col-xs-6 text-right">
						<button type="submit" class="btn btn-primary btn-sm btn-block">{{ trans('app.create') }}</button>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
@stop
