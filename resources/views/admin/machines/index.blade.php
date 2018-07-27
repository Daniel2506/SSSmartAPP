@extends('admin.machines.main')

@section('breadcrumb')
    <li class="active">Máquinas</li>
@endsection

@section('module')
	<div class="box box-danger" id="machines-main">
		<div class="box-body table-responsive">
			<table id="machines-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th width="20%">Serie</th>
                        <th width="20%">Casillas</th>
		                <th width="20%">Ubicación</th>
		                <th width="20%">Email</th>
		                <th width="20%">Teléfono</th>
		            </tr>
		        </thead>
		    </table>
		</div>
	</div>
@endsection
