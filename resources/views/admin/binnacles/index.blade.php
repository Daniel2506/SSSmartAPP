@extends('admin.binnacles.main')

@section('breadcrumb')
    <li class="active">Bitácoras</li>
@endsection

@section('module')
	<div class="box box-danger" id="binnacles-main">
		<div class="box-body table-responsive">
			<table id="binnacles-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th width="5%">#</th>
		                <th width="20%">Usuario</th>
                        <th width="15%">Acción</th>
		                <th width="40%">Observaciones</th>
		                <th width="20%">Fecha</th>
		            </tr>
		        </thead>
		    </table>
		</div>
	</div>
@endsection
