@extends('admin.users.main')

@section('breadcrumb')
    <li><a href="{{route('usuarios.index')}}">Usuario</a></li>
    <li class="active">{{ $user->id }}</li>
@stop

@section('module')
    <div class="box box-danger" id="user-show">
        <div class="box-body">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="control-label">Nombre</label>
                    <div>{{ $user->user_name }}  {{ $user->user_lastname }}</div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">Dirección</label>
                    <div>{{ $user->user_address }} </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="control-label">Teléfono</label>
                    <div>{{ $user->user_telephone }} </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    <label class="">Email</label>
                    <div>{{ $user->user_email }} </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="">Nombre de usuario</label>
                    <div>{{ $user->username }} </div>
                </div>
                <div class="form-group col-sm-4">
                    <label class="">Creado</label>
                    <div>{{ $user->created_at }} </div>
                </div>
            </div>
            <div class=" col-sm-8 col-md-offset-2">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Roles de usuario</h3>
                    </div>
                    <div class="box-body">
                        <!-- table table-bordered table-striped -->
                        <div class="table-responsive no-padding">
                            <table id="browse-roles-list" class="table table-bordered" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="100%">Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Render content roles --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer with-border">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-4 col-xs-6 text-left">
                    <a href=" {{ route('usuarios.index')}} " class="btn btn-default btn-sm btn-block"> {{ trans('app.comeback') }}</a>
                </div>
                <div class="col-sm-2 col-xs-6 text-right">
                    <a href=" {{ route('usuarios.edit', ['user' => $user->id])}}" class="btn btn-primary btn-sm btn-block">{{trans('app.edit')}}</a>
                </div>
            </div>
        </div>


    </div>
@stop
