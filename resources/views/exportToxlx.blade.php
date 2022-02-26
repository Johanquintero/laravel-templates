<!DOCTYPE html>
<html>

<head>
    <title>User List</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
                <td width="16" colspan="3" align="center" valign="middle" style="border: 1px solid #000000;background-color:#cfcfcf">
                    Responsables
                </td>
            </tr>
            <tr>
                <th width="16" style="border: 1px solid #000000;background-color:#cfcfcf">FECHA</th>
                <td width="18" style="border: 1px solid #000000;">{{ $template->date }}</td>
                <th width="16" style="border: 1px solid #000000;">NOMBRES</th>
                <td width="16"align="center" colspan="2" style="border: 1px solid #000000;">{{ $template->responsible_name}}</td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th style="border: 1px solid #000000;"> CEDULA </th>
                <td colspan="2" align="center" style="border: 1px solid #000000;">{{ $template->responsible_identification}}</td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th style="border: 1px solid #000000;"> PTO VENTA</th>
                <td colspan="2" align="center" style="border: 1px solid #000000;">{{ $template->point_name}}</td>
            </tr>
        </thead>
        <tbody>
            <tr></tr>
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">VTAS A CREDITO</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">FRA</th>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">CLIENTE</th>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">VALOR</th>
            </tr>
            @if(count($creditInvoice) > 0)
            @foreach($creditInvoice as $invoiceCredit)
            <tr>
                <td align="center" style="border: 1px solid #000000;">{{ $invoiceCredit->invoice}}</td>
                <td align="center" style="border: 1px solid #000000;">{{ $invoiceCredit->client_identification}}</td>
                <td align="center" style="border: 1px solid #000000;">{{ $invoiceCredit->value}}</td>
            </tr>
            @endforeach
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">TOTAL CREDITOS</th>
                <td align="center" style="border: 1px solid #000000;"></td>
            </tr>
            @else
            <tr></tr>
            @endif
            <tr></tr>

            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">VTAS TARJETAS</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">TIPO TARJETA</th>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">NUMERO DE FACTURA</th>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">VALOR</th>
            </tr>

            @if(count($cardSales) > 0)
            @foreach($cardSales as $salesCard)
            <tr>
                <td align="center" style="border: 1px solid #000000;">{{ $salesCard->type_cards}}</td>
                <td align="center" style="border: 1px solid #000000;">{{ $salesCard->invoice}}</td>
                <td align="center" style="border: 1px solid #000000;">{{ $salesCard->value}}</td>
            </tr>
            @endforeach
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">TOTAL TARJETAS</th>
                <td align="center" style="border: 1px solid #000000;"></td>
            </tr>
            @else
            <tr></tr>
            @endif

            <tr></tr>

            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">ENCARGOS</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">FRA</th>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">CLIENTE</th>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">ANTICIPO</th>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">CONS ANTERIOR</th>
                <th width="16" style="border: 1px solid #000000;background-color:#cfcfcf">CANCELACION</th>
            </tr>

            @if(count($customOrders) > 0)
            @foreach($customOrders as $customOrder)
            <tr>
                <td align="center" style="border: 1px solid #000000;">{{ $customOrder->invoice}}</td>
                <td align="center" style="border: 1px solid #000000;">{{ $customOrder->client_identification}}</td>
                <td align="center" style="border: 1px solid #000000;">{{ $customOrder->advance}}</td>
                <td align="center" style="border: 1px solid #000000;">{{ $customOrder->previous_cost}}</td>
                <td align="center" style="border: 1px solid #000000;">{{ $customOrder->cancelation}}</td>
            </tr>
            @endforeach
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">TOTAL</th>
                <td align="center" style="border: 1px solid #000000;"></td>
            </tr>
            @else
            <tr></tr>
            @endif

            <tr></tr>

            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">MFE</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">No. ORDEN</th>
                <th align="center" colspan="3"  style="border: 1px solid #000000;background-color:#cfcfcf">CLIENTE</th>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">VALOR</th>
            </tr>

            @if(count($electronicSales) > 0)
            @foreach($electronicSales as $saleMFE)
            <tr>
                <td align="center" style="border: 1px solid #000000;">{{ $saleMFE->order_number}}</td>
                <td align="center" colspan="3" style="border: 1px solid #000000;white-space: pre-wrap;">{{ $saleMFE->client_identification}}</td>
                <td align="center" style="border: 1px solid #000000;">{{ $saleMFE->value}}</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="3" align="center" style="border: 1px solid #000000;background-color:#cfcfcf">TOTAL</th>
                <td colspan="2" align="center" style="border: 1px solid #000000;"></td>
            </tr>
            @else
            <tr></tr>
            @endif

            <tr></tr>

            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">GASTOS</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">FRA</th>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">NOMBRE</th>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">VALOR</th>
            </tr>

            @if(count($expense) > 0)
            @foreach($expense as $expenseOne)
            <tr>
                <td align="center" style="border: 1px solid #000000;">{{ $expenseOne->invoice}}</td>
                <td align="center" style="border: 1px solid #000000;white-space: pre-wrap;">{{ $expenseOne->client_name}}</td>
                <td align="center" style="border: 1px solid #000000;">{{ $expenseOne->value}}</td>
            </tr>
            @endforeach
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">TOTAL</th>
                <td style="border: 1px solid #000000;"></td>
            </tr>
            @else
            <tr></tr>
            @endif

            <tr></tr>

            <!-- Crear for para recorrer consignaciones y efectivo real -->
            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">RECAUDOS DOMICILIOS</th>
                <td style="border: 1px solid #000000;">{{$template->total_delivery}}</td>
                <td></td>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">CONSIGNACION 1</th>
                <td align="center" style="border: 1px solid #000000;">{{$template->consignment[0]}}</td>
            </tr>

            <tr>
                <th colspan="2"></th>
                <td></td>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">CONSIGNACION 2</th>
                <td align="center" style="border: 1px solid #000000;">{{$template->consignment[1]}}</td>
            </tr>

            <tr>
                <th colspan="2"></th>
                <td></td>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">EFECTIVO REAL</th>
                <td align="center" style="border: 1px solid #000000;" >{{$template->actualCash}}</td>
            </tr>

            <tr></tr>

            <tr>
                <th style="border: 1px solid #000000;background-color:#cfcfcf">OBSERVACIONES</th>
            </tr>

            <tr>
                <td colspan="5" align="center" style="border: 1px solid #000000;">{{$template->observation}}</td>
            </tr>

        </tbody>
    </table>
</body>

</html>