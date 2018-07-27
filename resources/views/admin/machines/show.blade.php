@extends('admin.machines.main')

@section('breadcrumb')
    <li><a href="{{route('maquinas.index')}}">Máquina</a></li>
    <li class="active">{{ $machine->id }}</li>
@endsection

@section('module')
    <div class="box box-danger">
        <div class="box-body">
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Serie</label>
                    <div>{{$machine->maquina_serie}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Ubicación</label>
                    <div>{{$machine->maquina_ubicacion}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Documentos</label>
                    <div>{{$machine->maquina_documentos}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Casillas</label>
                    <div>{{$machine->maquina_casillas}}</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Contacto</label>
                    <div>{{$machine->maquina_contacto}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Email</label>
                    <div>{{$machine->maquina_email}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Dirección</label>
                    <div>{{$machine->maquina_direccion}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Teléfono</label>
                    <div>{{$machine->maquina_telefono}}</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Comisión 1</label>
                    <div>{{$machine->maquina_comision1}} %</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Comisión 2</label>
                    <div>{{$machine->maquina_comision2}} %</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Comisión 3</label>
                    <div>{{$machine->maquina_comision3}} %</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="control-label">Servidor</label>
                    <div>{{$machine->maquina_servidor}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Usuario</label>
                    <div>{{$machine->maquina_usuario}}</div>
                </div>
                <div class="form-group col-sm-3">
                    <label class="control-label">Directorio</label>
                    <div>{{$machine->maquina_directorio}}</div>
                </div>
            </div>
        </div>
        <div class="box-footer with-border">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-4 col-xs-6 text-left">
                    <a href=" {{ route('maquinas.index')}} " class="btn btn-default btn-sm btn-block"> {{ trans('app.comeback') }}</a>
                </div>
                <div class="col-sm-2 col-xs-6 text-right">
                    <a href=" {{ route('maquinas.edit', ['user' => $machine->id])}}" class="btn btn-primary btn-sm btn-block">{{trans('app.edit')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
