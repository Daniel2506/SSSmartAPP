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

    <table class="mtable" border="0" cellspacing="1" cellpadding="1">
        <tbody>
            <tr>
                <td colspan="3" class="bold">RECAUDO</td>
            </tr>
            <tr>
                <td class="right">Total Recaudo: </td>
                <td class="right"> {{ number_format(array_pluck($object->aperturas_sin_pago, 'contador')[0], '2', ',', '.') }}</td>
                <td class="right"> {{ number_format(array_pluck($object->aperturas_sin_pago, 'valor')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="bold">APERTURAS x ADMINISTRADOR</td>
            </tr>
            <tr>
                <td class="right">Con Pago</td>
                <td class="right"> {{ number_format(array_pluck($object->aperturas_sin_pago, 'contador')[0], '2', ',', '.') }}</td>
                <td class="right"> {{ number_format(array_pluck($object->aperturas_sin_pago, 'valor')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td class="right">Sin Pago</td>
                <td class="right"> {{ number_format(array_pluck($object->aperturas_sin_pago, 'contador')[0], '2', ',', '.') }}</td>
                <td class="right"> {{ number_format(array_pluck($object->aperturas_sin_pago, 'valor')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="bold">FACTURACIÓN</td>
            </tr>
            <tr>
                <td class="right" colspan="2">Subtotal: </td>
                <td class="right"> {{ number_format(array_pluck($object->facturacion, 'subtotal')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td class="right" colspan="2">Iva: </td>
                <td class="right"> {{ number_format(array_pluck($object->facturacion, 'iva')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td class="right bold">Total: </td>
                <td class="right bold">{{ array_pluck($object->facturacion, 'contador')[0] }}</td>
                <td class="right bold"> {{ number_format(array_pluck($object->facturacion, 'total')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bold" colspan="3">VACIADO HOPPER</td>
            </tr>
            <tr>
                <td class="right">Denominación</td>
                <td class="right">#</td>
                <td class="right">Valor</td>
            </tr>
            @foreach ($object->vaciado_hopper as $item)
                <tr>
                    <td class="right">{{ $item['moneda_denominacion'] }}</td>
                    <td class="right">{{ $item['cuenta'] }}</td>
                    <td class="right">{{ number_format($item['valor'], '2', ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="bold" colspan="3">RECARGAS</td>
            </tr>
            <tr>
                <td class="right">Denominación</td>
                <td class="right">#</td>
                <td class="right">Valor</td>
            </tr>
            @foreach ($object->recargas as $item)
                <tr>
                    <td class="right">{{ $item['moneda_denominacion'] }}</td>
                    <td class="right">{{ $item['cuenta'] }}</td>
                    <td class="right">{{ $item['valor'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="bold">ROTACIÓN</td>
                <td class="left" colspan="2"> {{ number_format(array_pluck($object->rotacion, 'result')[0], '2', ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bold" colspan="3">VACIADO HOPPER</td>
            </tr>
            <tr>
                <td class="right">Total</td>
                <td class="right">{{ array_pluck($object->vaciado_cofre, 'cuenta')[0] }}</td>
                <td class="right"> {{ number_format(array_pluck($object->vaciado_cofre, 'valor')[0], '2', ',' , '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="bold">SALDOS ACTUALIES</td>
            </tr>
            <tr>
                <td class="center">HOPPERS</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td class="right">Denominación</td>
                <td class="right">#</td>
                <td class="right">Valor</td>
            </tr>
            @php
                $total = 0;
            @endphp
            @foreach ($object->saldo_hopper as $item)
                <tr>
                    <td class="right">{{ $item->moneda_denominacion }}</td>
                    <td class="right">{{ $item->moneda_hopper }}</td>
                    <td class="right"> {{ number_format($item->valor, '2', ',' , '.') }}</td>
                </tr>
                @php
                    $total += $item->valor;
                @endphp
            @endforeach
            <tr>
                <td class="right bold" colspan="2"> Total hoppers</td>
                <td class="right bold"> {{ number_format($total, '2', ',' , '.') }}</td>
            </tr>
            <tr>
                <td class="center">COFRES</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td class="right">Denominación</td>
                <td class="right">#</td>
                <td class="right">Valor</td>
            </tr>
            @php
                $total = 0;
            @endphp
            @foreach ($object->saldo_cofre as $item)
                <tr>
                    <td class="right">{{ $item->coin_denominacion }}</td>
                    <td class="right">{{ $item->coin_cofre }}</td>
                    <td class="right"> {{ number_format($item->valor, '2', ',' , '.') }}</td>
                </tr>
                @php
                    $total += $item->valor;
                @endphp
            @endforeach
            <tr>
                <td class="right bold" colspan="2"> Total cofres</td>
                <td class="right bold"> {{ number_format($total, '2', ',' , '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="bold">ROTACIÓN DIARIA</td>
            </tr>
            <tr>
                <td class="right">Fecha</td>
                <td class="right">Día</td>
                <td class="right">Valor</td>
            </tr>
            @foreach ($object->rotacion_diaria as $item)
                <tr>
                    <td class="right">{{ $item->factura_fecha_emision }}</td>
                    <td class="right">{{ config('koi.dias')[$item->day] }}</td>
                    <td class="right">{{ $item->result }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
