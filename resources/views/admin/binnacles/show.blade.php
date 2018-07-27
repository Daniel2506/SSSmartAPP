@extends('admin.binnacles.main')

@section('breadcrumb')
    <li><a href="{{route('bitacoras.index')}}">Bitácoras</a></li>
    <li class="active">{{ $binnacle->id }}</li>
@endsection

@section('module')
    <div class="box box-danger">
        <div class="box-body">
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Usuario</label>
                    <div>{{ $binnacle->bitacora_usuario }}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Acción</label>
                    <div>{{ $binnacle->bitacora_accion }}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Fecha</label>
                    <div>{{ $binnacle->bitacora_fh }}</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Valor 1</label>
                    <div>{{ number_format($binnacle->bitacora_valor1, '2', ',', '.') }}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Valor 2</label>
                    <div>{{ number_format($binnacle->bitacora_valor2, '2', ',', '.') }}</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-9">
                    <label class="control-label">Observaciones</label>
                    <div>{{ $binnacle->bitacora_observaciones }}</div>
                </div>
            </div>
        </div>
        <div class="box-footer with-border">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-5 col-xs-6 text-left">
                    <a href=" {{ route('bitacoras.index')}} " class="btn btn-default btn-sm btn-block"> {{ trans('app.comeback') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
