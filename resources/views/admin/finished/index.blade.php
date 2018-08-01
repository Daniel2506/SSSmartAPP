@extends('admin.finished.main')

@section('breadcrumb')
    <li class="active">Finalizados</li>
@endsection

@section('module')
	<div class="box box-danger" id="finished-main">
		<div class="box-body table-responsive">
			<table id="finished-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th width="5%">#</th>
                        <th width="35%">Máquina</th>
                        <th width="10%">Casilla</th>
		                <th width="20%">F. Inicio</th>
		                <th width="20%">F. Final</th>
		            </tr>
		        </thead>
		    </table>
		</div>
	</div>
@endsection
