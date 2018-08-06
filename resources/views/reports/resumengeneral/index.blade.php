@extends('layout.layout')

@section('title') Resumen general @endsection

@section('content')
    <section class="content-header">
		<h1>
			Resumen general
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> {{ trans('app.home') }}</a></li>
			<li class="active">Resumen general</li>
		</ol>
    </section>

   	<section class="content">
	    <div class="box box-danger">
            @if ($errors->any())
                <div class="box-header without-border">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
	    	<form action="{{ route('resumengeneral.index') }}" method="GET" data-toggle="validator">
			 	<input class="hidden" id="type-report-koi-component" name="type"></input>
				<div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-offset-2 col-md-2 col-xs-12">
                            <label for="finish_at">Fecha inicial</label>
                            <input type="text" name="start_at" class="form-control input-sm datepicker" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group col-md-2"> <br>
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input name="start_at_time" class="form-control input-sm timepicker" value="{{ date('H:m') }}" required>
                                    <div class="input-group-addon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-2 col-xs-12">
                            <label for="finish_at">Fecha final</label>
                            <input type="text" name="finish_at" class="form-control input-sm datepicker" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group col-md-2"> <br>
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" name="finish_at_time" class="form-control input-sm timepicker" value="{{ date('H:m') }}" required>
                                    <div class="input-group-addon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-offset-2 col-md-8 col-xs-12">
                            <select name="machine_filter" class="form-control select2-default" data-placeholder="Seleccione máquina">
                                <option></option>
                                @foreach( App\Models\Base\Machine::getMachines() as $key => $machine)
                                    <option value="{{ $key }}">{{ $machine }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
				</div>
                <div class="box-footer">
                    <div class="col-md-2 col-md-offset-4 col-sm-6 col-xs-6">
                        <button type="submit" class="btn btn-default btn-sm btn-block btn-export-xls-koi-component">
                            <i class="far fa-file-excel"></i> {{ trans('app.xls') }}
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <button type="submit" class="btn btn-default btn-sm btn-block btn-export-pdf-koi-component">
                            <i class="far fa-file-pdf"></i> {{ trans('app.pdf') }}
                        </button>
                    </div>
                </div>
			</form>
		</div>
	</section>
@endsection
