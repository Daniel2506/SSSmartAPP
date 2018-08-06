@extends('layout.layout')

@section('title') Dashboard @stop

@section('content')
    <section class="content-header">
        <h1>
            Dashboard <small>Control panel</small>
        </h1>

    </section>
	<section class="content">
        <div class="box box-danger" id="dashboard-main">
            <div class="box-header without-border">
                <h3 class="box-title text-right col-md-4">Ver máquina: </h3>
                <div class="form-group col-md-5">
                    <select id="dashboard_machine_filter" name="dashboard_machine_filter" class="form-control select2-default-clear change-view-for-machine" data-placeholder="Seleccione máquina">
                        <option></option>
                        @foreach( App\Models\Base\Machine::getMachines() as $key => $machine)
                            <option value="{{ $key }}">{{ $machine }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="box-body" id="body-charts">

            </div>
        </div>
    </section>
    <script type="text/template" id="charts-dashboard-tpl">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rotación X día</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="chart_rotacion_dia" style="height: 230px; width: 548px;" width="548" height="230"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rotación últimos 6 meses</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="chart_rotacion_smeses" style="height: 230px; width: 548px;" width="548" height="230"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ventas últimos 6 meses</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="chart_ventas" style="height: 230px; width: 548px;" width="548" height="230"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>
@endsection
