@extends('admin.bills.main')

@section('breadcrumb')
    <li><a href="{{route('facturas.index')}}">Facturas</a></li>
    <li class="active">{{ $bill->id }}</li>
@endsection

@section('module')
    <div class="box box-danger">
        <div class="box-body">
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Máquina</label>
                    <div>{{$bill->machine->maquina_serie}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Ubicación máquina</label>
                    <div>{{$bill->machine->maquina_ubicacion}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Casilla</label>
                    <div>{{$bill->factura_casilla}}</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Número</label>
                    <div>{{$bill->factura_numero}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Prefijo</label>
                    <div>{{$bill->factura_prefijo}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Fecha</label>
                    <div>{{$bill->factura_fecha_emision}}</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Fecha</label>
                    <div>{{$bill->factura_fh_inicio}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Fecha</label>
                    <div>{{$bill->factura_fh_final}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Tiempo</label>
                    <div>{{$bill->factura_tiempo}} mins</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Subtotal</label>
                    <div>{{number_format($bill->factura_subtotal, '2', ',', '.')}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Iva</label>
                    <div>{{number_format($bill->factura_iva, '2', ',', '.')}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Total</label>
                    <div>{{number_format($bill->factura_total, '2', ',', '.')}}</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Pago</label>
                    <div>{{number_format($bill->factura_pago, '2', ',', '.')}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Cambio</label>
                    <div>{{number_format($bill->factura_cambio, '2', ',', '.')}}</div>
                </div>
            </div>
        </div>
        <div class="box-footer with-border">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-5 col-xs-6 text-left">
                    <a href=" {{ route('facturas.index')}} " class="btn btn-default btn-sm btn-block"> {{ trans('app.comeback') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
