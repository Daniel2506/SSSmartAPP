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
                <td rowspan="2"></td>
                <td> {{ number_format(array_pluck($object->facturacion, 'subtotal')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td>Iva: </td>
                <td> {{ number_format(array_pluck($object->facturacion, 'iva')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total: </td>
                <td>{{ array_pluck($object->facturacion, 'contador')[0] }}</td>
                <td> {{ number_format(array_pluck($object->facturacion, 'total')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="center title">VACIADO HOPPER</td>
            </tr>
            <tr>
                <td>Denominación</td>
                <td>#</td>
                <td>Valor</td>
            </tr>
            @foreach ($object->vaciado_hopper as $item)
                <tr>
                    <td>{{ $item['moneda_denominacion'] }}</td>
                    <td>{{ $item['cuenta'] }}</td>
                    <td>{{ $item['valor'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="center title">RECARGAS</td>
            </tr>
            <tr>
                <td>Denominación</td>
                <td>#</td>
                <td>Valor</td>
            </tr>
            @foreach ($object->recargas as $item)
                <tr>
                    <td>{{ $item['moneda_denominacion'] }}</td>
                    <td>{{ $item['cuenta'] }}</td>
                    <td>{{ $item['valor'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="center title">ROTACIÓN</td>
            </tr>
            <tr>
                <td colspan="3" class="center"> {{ number_format(array_pluck($object->rotacion, 'result')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="center title">VACIADO HOPPER</td>
            </tr>
            <tr>
                <td></td>
                <td>#</td>
                <td>Total</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>{{ array_pluck($object->vaciado_cofre, 'cuenta')[0] }}</td>
                <td> {{ number_format(array_pluck($object->vaciado_cofre, 'valor')[0], '2', ',' , '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="center title">ROTACIÓ DIARIA</td>
            </tr>
            <tr>
                <td>Fecha</td>
                <td>Día</td>
                <td>Valor</td>
            </tr>
            @foreach ($object->rotacion_diaria as $item)
                <tr>
                    <td>{{ $item->factura_fecha_emision }}</td>
                    <td>{{ date('D', strtotime($item->factura_fecha_emision)) }}</td>
                    <td>{{ $item->result }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
