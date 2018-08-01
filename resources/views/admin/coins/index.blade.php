@extends('admin.coins.main')

@section('breadcrumb')
    <li class="active">Monedas</li>
@endsection

@section('module')
	<div class="box box-danger" id="coins-main">
		<div class="box-body table-responsive">
			<table id="coins-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th width="5%">#</th>
                        <th width="35%">Máquina</th>
                        <th width="20%">Canal</th>
		                <th width="20%">Denominación</th>
		                <th width="20%">Hopper</th>
		            </tr>
		        </thead>
		    </table>
		</div>
	</div>
@endsection
