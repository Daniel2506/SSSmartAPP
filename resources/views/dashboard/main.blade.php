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
            <div class="box-body">
                <div class="col-md-6">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Rotación X Día</h3>
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
        </div>
    </section>

@stop
