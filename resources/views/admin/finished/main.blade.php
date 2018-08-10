@extends('layout.layout')

@section('title') Finalizados @endsection

@section('content')
    <section class="content-header">
        <h1>
			Finalizados <small>Administración de finalizados</small>
        </h1>
        <ol class="breadcrumb">
			<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('app.home') }}</a></li>
            @yield('breadcrumb')
        </ol>
    </section>

    <section class="content">
        @yield('module')
    </section>
@endsection
