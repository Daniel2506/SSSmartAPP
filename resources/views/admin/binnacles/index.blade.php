@extends('admin.binnacles.main')

@section('breadcrumb')
    <li class="active">Bitacoras</li>
@stop

@section('module')
	<div class="box box-success" id="binnacles-main">
		<div class="box-body table-responsive">
			<table id="binnacles-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th width="5%">#</th>
		                <th width="20%">Usuario</th>
                        <th width="20%">Acción</th>
		                <th width="45%">Observaciones</th>
		                <th width="10%">Fecha</th>
		            </tr>
		        </thead>
		    </table>
		</div>
	</div>
@stop
