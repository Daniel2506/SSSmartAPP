@extends('admin.coinscasket.main')

@section('breadcrumb')
    <li class="active">Monedas cofre</li>
@endsection

@section('module')
	<div class="box box-danger" id="coinscasket-main">
		<div class="box-body table-responsive">
			<table id="coinscasket-search-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th width="5%">#</th>
                        <th width="35%">Máquina</th>
                        <th width="20%">Canal</th>
		                <th width="20%">Denominación</th>
		                <th width="20%">Cofre</th>
		            </tr>
		        </thead>
		    </table>
		</div>
	</div>
@endsection
