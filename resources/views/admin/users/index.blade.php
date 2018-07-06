@extends('admin.users.main')

@section('breadcrumb')
    <li class="active">Usuarios</li>
@stop

@section('module')
	<div class="box box-danger" id="users-main">
		<div class="box-body table-responsive">
			<table id="users-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th width="10%">Código</th>
		                <th width="40%">Nombre</th>
		                <th width="30%">Email</th>
		                <th width="20%">Teléfono</th>
		            </tr>
		        </thead>
		    </table>
		</div>
	</div>
@stop
