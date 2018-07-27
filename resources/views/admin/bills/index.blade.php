@extends('admin.bills.main')

@section('breadcrumb')
    <li class="active">Facturas</li>
@stop

@section('module')
	<div class="box box-danger" id="bills-main">
		<div class="box-body table-responsive">
			<table id="bills-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th width="20%">Número</th>
                        <th width="20%">Prefijo</th>
		                <th width="20%">Máquina</th>
		                <th width="20%">Emisión</th>
		                <th width="20%">Total</th>
		            </tr>
		        </thead>
		    </table>
		</div>
	</div>
@endsection
