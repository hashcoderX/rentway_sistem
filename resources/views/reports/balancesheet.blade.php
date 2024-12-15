<x-app-layout>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <div class="leftsidebar">

            @include('layouts.leftsidebar')
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('layouts.mainnavbar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <!-- myvehicles -->
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="forms-sample">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">

                                                    <input type="date" class="form-control" id="expencestdate" name="expencestdate" style="color: gray;">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">

                                                    <input type="date" class="form-control" id="expenceenddate" name="expenceenddate" style="color: gray;">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">

                                                    <button class="btn btn-primary" onclick="getReport()">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="displaydetails" class="displaydetails">
                                        <div class="row">
                                            <div class="col-12">

                                                <p style="text-align: center;">Data Range - {{ $startOfMonth }} To {{ $endOfMonth }}</p>
                                                <table class="table table-responsive">
                                                    <tr>
                                                        <td>Date</td>
                                                        <td>Description</td>
                                                        <td>Credit</td>
                                                        <td>Debit</td>
                                                        <td>Balance</td>
                                                    </tr>

                                                    <!-- Example rows -->
                                                    @php
                                                    $totalCredit = 0;
                                                    $totalDebit = 0;
                                                    @endphp

                                                    @foreach($pnls as $pnl)
                                                    <tr>
                                                        <td>{{ $pnl->date_time }}</td>
                                                        <td>{{ $pnl->description }}</td>
                                                        <td>{{ number_format($pnl->credit, 2) }}</td>
                                                        <td>{{ number_format($pnl->debit, 2) }}</td>
                                                        <td>{{ number_format($pnl->balance, 2) }}</td>
                                                    </tr>

                                                    @php
                                                    $totalCredit += $pnl->credit;
                                                    $totalDebit += $pnl->debit;
                                                    @endphp
                                                    @endforeach

                                                    <!-- Totals Row -->
                                                    <tr>
                                                        <td colspan="2" style="text-align: center; font-weight: bold;">Total</td>
                                                        <td style="text-align: right; font-weight: bold;">{{ number_format($totalCredit, 2) }}</td>
                                                        <td style="text-align: right; font-weight: bold;">{{ number_format($totalDebit, 2) }}</td>
                                                        <td></td>
                                                    </tr>

                                                    <!-- Final Balance Row (if you need it) -->
                                                    <tr>
                                                        <td colspan="5" style="text-align: center; font-weight: bold;">
                                                            Final Balance: {{ number_format($totalCredit - $totalDebit, 2) }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                    <button class="btn btn-primary" onclick="printReport()">Get Pdf Report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <!-- footer   -->

                <!-- End Footer  -->
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">View Booking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="bookingindetails" id="bookingindetails">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                    <!-- <button type="button" class="btn btn-primary" onclick="createInvoice()">Create Invoice</button> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Modal -->

<script>
    function refresh() {
        location.reload();
    }

    function printReport() {
        // Get the content of the invoicedisplay div
        var content = document.getElementById('displaydetails').innerHTML;

        // Create a new window or iframe to hold the content
        var printWindow = window.open('', '_blank', 'width=210mm,height=297mm');
        printWindow.document.open();
        printWindow.document.write(`
    <html>
        <head>
            <title>Balance Sheets</title>
            <style>
                /* Add custom styles for A4 printing */
                @page {
                    size: A4;
                    margin: 20mm;
                }
                body {
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    margin: 0;
                    padding: 0;
                }
                .invoice-header, .invoice-footer {
                    text-align: center;
                    margin-bottom: 10mm;
                }
                .invoice-body {
                    margin: 10mm 0;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                table, th, td {
                    border: 1px solid #000;
                }
                th, td {
                    padding: 5px;
                    text-align: left;
                }
            </style>
        </head>
        <body>
            <div class="invoice-header">
                <h1>Balance Sheets</h1>
                
            </div>
            <div class="invoice-body">
                ${content} <!-- Insert the invoicedisplay content -->
            </div>
            <div class="invoice-footer">
                <p>Thank you for your business!</p>
            </div>
        </body>
    </html>
    `);

        // Trigger the print dialog
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();

        // Close the print window after printing (optional)
        // printWindow.close();
    }


    function getReport() {
        const startDate = document.getElementById('expencestdate').value;
        const endDate = document.getElementById('expenceenddate').value;

        if (!startDate || !endDate) {
            alert("Please select both start and end dates.");
            return;
        }

        fetch('/balancesheet/filter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    start_date: startDate,
                    end_date: endDate
                })
            })
            .then(response => response.json())
            .then(data => {
                const displayDetails = document.getElementById('displaydetails');

                // Prepare the table HTML dynamically
                let html = `
            <table class="table table-responsive">
                <tr>
                    <td>Date</td>
                    <td>Description</td>
                    <td>Credit</td>
                    <td>Debit</td>
                    <td>Balance</td>
                </tr>
        `;

                let totalCredit = 0;
                let totalDebit = 0;

                // Loop through the fetched data and create rows dynamically
                data.pnls.forEach(pnl => {
                    totalCredit += pnl.credit;
                    totalDebit += pnl.debit;

                    html += `
                <tr>
                    <td>${pnl.date_time}</td>
                    <td>${pnl.description}</td>
                    <td>${pnl.credit.toFixed(2)}</td>
                    <td>${pnl.debit.toFixed(2)}</td>
                    <td>${pnl.balance.toFixed(2)}</td>
                </tr>
            `;
                });

                // Add the totals row
                html += `
            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold;">Total</td>
                <td style="text-align: right; font-weight: bold;">${totalCredit.toFixed(2)}</td>
                <td style="text-align: right; font-weight: bold;">${totalDebit.toFixed(2)}</td>
                <td></td>
            </tr>
        `;

                // Add the final balance row
                html += `
            <tr>
                <td colspan="5" style="text-align: center; font-weight: bold;">
                    Final Balance: ${(totalCredit - totalDebit).toFixed(2)}
                </td>
            </tr>
        </table>
        `;

                // Update the display details content with the generated table
                displayDetails.innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
    }




    function viewbooking(id) {
        $.ajax({
            url: '/getbookingdetails',
            type: 'GET',
            data: {
                bookingid: id,

            },
            success: function(response) {
                if (response.html) {
                    document.querySelector('.bookingindetails').innerHTML = response.html;
                }
            }
        });
    }

    function createInvoice() {
        var bookingid = document.getElementById('bookingidc').innerHTML;
        alert(bookingid);
    }
</script>