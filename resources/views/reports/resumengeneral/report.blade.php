@extends('reports.layout', ['type' => $type, 'title' => $title])

@section('content')
    <table class="rtable">
        <thead>
            <tr>
                <td class="right">Fecha Inicial: {{$request->start_at}}</td>
                <td class="left">Fecha Final: {{$request->finish_at}}</td>
            </tr>
        </thead>
    </table>

    <table class="rtable" border="1" cellspacing="1" cellpadding="1">
        <tbody>
            <tr>
                <td colspan="3" class="center title">RECAUDO</td>
            </tr>
            <tr>
                <td></td>
                <td> # Facturas</td>
                <td> Total</td>
            </tr>
            <tr>
                <td>Total Recaudo: </td>
                <td> {{ number_format(array_pluck($object->aperturas_sin_pago, 'contador')[0], '2', ',', '.') }}</td>
                <td> {{ number_format(array_pluck($object->aperturas_sin_pago, 'valor')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="center title">APERTURAS x ADMINISTRADOR</td>
            </tr>
            <tr>
                <td></td>
                <td>#</td>
                <td> Total</td>
            </tr>
            <tr>
                <td>Con Pago</td>
                <td> {{ number_format(array_pluck($object->aperturas_sin_pago, 'contador')[0], '2', ',', '.') }}</td>
                <td> {{ number_format(array_pluck($object->aperturas_sin_pago, 'valor')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td>Sin Pago</td>
                <td> {{ number_format(array_pluck($object->aperturas_sin_pago, 'contador')[0], '2', ',', '.') }}</td>
                <td> {{ number_format(array_pluck($object->aperturas_sin_pago, 'valor')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="center title">FACTURACIÓN</td>
            </tr>
            <tr>
                <td></td>
                <td> # </td>
                <td> Total</td>
            </tr>
            <tr>
                <td>Subtotal: </td>
                <td></td>
                <td> {{ number_format(array_pluck($object->facturacion, 'subtotal')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td>Iva: </td>
                <td></td>
                <td> {{ number_format(array_pluck($object->facturacion, 'iva')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total: </td>
                <td></td>
                <td> {{ number_format(array_pluck($object->facturacion, 'total')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="center title">VACIADO HOPPER</td>
            </tr>
        </tbody>
    </table>
@endsection
