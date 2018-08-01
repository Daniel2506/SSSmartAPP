@extends('layout.layout')

@section('title') Facturas @endsection

@section('content')
    <section class="content-header">
        <h1>
			Facturas <small>Administración de facturas</small>
        </h1>
        <ol class="breadcrumb">
			<li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> {{ trans('app.home') }}</a></li>
            @yield('breadcrumb')
        </ol>
    </section>

    <section class="content">
        @yield('module')
    </section>
@endsection
