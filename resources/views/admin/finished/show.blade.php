@extends('admin.finished.main')

@section('breadcrumb')
    <li><a href="{{route('finalizados.index')}}"> Finalizados</a></li>
    <li class="active">{{ $finalized->id }}</li>
@endsection

@section('module')
    <div class="box box-danger">
        <div class="box-body">
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Máquina</label>
                    <div>{{$finalized->machine->maquina_serie}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Ubicación máquina</label>
                    <div>{{$finalized->machine->maquina_ubicacion}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Casilla</label>
                    <div>{{$finalized->finalizado_casilla}}</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Fecha inicio</label>
                    <div>{{$finalized->finalizado_finicio}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Fecha final</label>
                    <div>{{$finalized->finalizado_ffinal}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Tiempo</label>
                    <div>{{$finalized->finalizado_tiempo}} Min</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Cambio</label>
                    <div>{{number_format($finalized->finalizado_apagar, '2', ',', '.')}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Ingreso</label>
                    <div>{{number_format($finalized->finalizado_ingreso, '2', ',', '.')}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Cambio</label>
                    <div>{{number_format($finalized->finalizado_cambio, '2', ',', '.')}}</div>
                </div>
            </div>
        </div>
        <div class="box-footer with-border">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-5 col-xs-6 text-left">
                    <a href=" {{ route('finalizados.index')}} " class="btn btn-default btn-sm btn-block"> {{ trans('app.comeback') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
