@extends('layout.layout')

@section('title') Máquinas @endsection

@section('content')
    <section class="content-header">
        <h1>
			Máquinas <small>Administración de máquinas</small>
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
