@extends('admin.roles.main')

@section('module')
    <section class="content-header">
        <h1>
            Roles <small>Administración de roles</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> {{ trans('app.home') }}</a></li>
            <li class="active">Roles</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-danger" id="roles-main">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="roles-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="25%">Nombre</th>
                                <th width="25%">Key</th>
                                <th width="50%">Descripcion</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
