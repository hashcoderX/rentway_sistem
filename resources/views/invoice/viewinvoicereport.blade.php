<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="bill" id="bill" style="width: 100%; max-width: 800px; margin: auto; font-family: Arial, sans-serif; border: 1px solid #ddd; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <!-- Header -->
        <img src="{{ asset($company->header) }}" class="img-fluid" alt="Company Header" style="width: 100%; margin-bottom: 20px;">

        <h3 style="text-align: center; font-size: 1.5rem; margin-top: 30px;">Invoice</h3>
        <div class="row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <div class="col" style="flex: 1; padding: 5px; font-weight: bold;">Invoice No - {{ $invoice->id }}</div>
            <div class="col" style="flex: 1; padding: 5px; font-weight: bold; text-align: center;">Date Time - {{ date('Y-m-d H:i:s') }}</div>
            <div class="col" style="flex: 1; padding: 5px; font-weight: bold; text-align: right;">Name - {{ $invoice->customername }}</div>
        </div>
        <!-- Details Table -->
        <table class="table table-responsive" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tbody>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Out Meeter</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $invoice->starting_meeter }} Km</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">In Meeter</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $invoice->endmeeter }} Km</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Total Drive</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $invoice->endmeeter - $invoice->starting_meeter }} Km</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Extra Drive Distance</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $invoice->extramillege }} Km</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Extra Drive Amount</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">LKR {{ number_format($invoice->extra_drive_amount,2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Refundable Deposit</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">LKR {{ number_format($invoice->advance_charge,2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">First Payment Balance</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">LKR {{ number_format($invoice->first_payment_balance,2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">All Delivery Charges</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">LKR {{ number_format($invoice->deliverycharges,2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">All Extra Charges</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">LKR {{ number_format($invoice->extra_charges,2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Total Amount</td>
                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">LKR {{ number_format($invoice->total_bill,2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">All Discount</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">LKR {{ number_format($invoice->discount,2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">All Deductions(Discount,Repairs)</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">LKR {{ number_format(($invoice->discount + $invoice->repair_deduction),2) }}</td>
                </tr>

                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Pay Amount</td>
                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold; color: green;">LKR {{ number_format(($invoice->paidamount),2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Balance</td>
                    <td style="padding: 10px; border: 1px solid #ddd; color: red;">LKR {{ number_format(($invoice->balance),2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Footer -->
        <img src="{{ asset($company->footer) }}" class="img-fluid" alt="Company Footer" style="width: 100%; margin-top: 20px;">
    </div>


    <button class="btn btn-primary" onclick="printinvoice()">Print Agreement</button>


</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

<!-- Add this to your HTML file to include jQuery -->



<script>
    function printinvoice() {
        var content = document.getElementById('bill').innerHTML;

        // Open a new window
        var printWindow = window.open('', '_blank', 'width=720,height=auto');
        printWindow.document.open();
        printWindow.document.write(`
        <html>
            <head>
                <title>Print Agreement</title>
                
            </head>
            <body>
                
                    ${content} 
                
                
            </body>
        </html>
    `);

        // Wait for the content to load before printing
        printWindow.document.close();
        printWindow.onload = function() {
            printWindow.print();
            // printWindow.close();
        };
    }
</script>



<!-- Add this to your HTML file to include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>