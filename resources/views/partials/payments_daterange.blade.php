@php
use Carbon\Carbon;

@endphp





<div class="row">

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th> Customer Name </th>
                    <th> Payment Date </th>
                    <th> Discount </th>
                    <th> Total Amount </th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalSum = 0;
                @endphp
                @foreach ($invoices as $invoice)
                <tr>
                    <td> {{ $invoice->customername }} </td>
                    <td> {{ $invoice->invoice_compleat_date }} </td>
                    <td> {{ number_format($invoice->discount,2) }} </td>
                    <td> {{ number_format($invoice->total_bill,2) }} </td>
                </tr>
                @php
                $totalSum += $invoice->total_bill;
                @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>Total:</strong></td>
                    <td><strong>{{ number_format($totalSum, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>