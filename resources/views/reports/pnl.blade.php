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

                                                    <button class="btn btn-primary" onclick="searchExpenses()">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="displaydetails" class="displaydetails">
                                        <div class="row">
                                            <div class="col-12">

                                                <p style="text-align: center;">Data Range - {{ $startOfMonth }} To {{ $endOfMonth }}</p>
                                                <table class="table table-responcive">
                                                    <tr>
                                                        <td colspan="3" style="text-align: center; font-weight: bold;">
                                                            Total Income: {{ number_format($totalincome, 2) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date</td>
                                                        <td>Description</td>
                                                        <td>Amount</td>
                                                    </tr>

                                                    <!-- Example rows -->
                                                    @foreach($expenses as $expense)
                                                    <tr>
                                                        <td>{{ $expense->date_time }}</td>
                                                        <td>{{ $expense->description }}</td>
                                                        <td>{{ number_format($expense->amount,2) }}</td>
                                                    </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="3" style="text-align: center; font-weight: bold;">
                                                            Total Expenses: {{ number_format( $totalAmount , 2) }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3" style="text-align: center; font-weight: bold;">
                                                            NET INCOME/LOSS: {{ number_format($totalincome - $totalAmount , 2) }}
                                                        </td>
                                                    </tr>
                                                </table>


                                            </div>


                                        </div>



                                        <!-- Pagination Links -->
                                        <div class="d-flex justify-content-center">
                                            {{ $expenses->links() }}
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
            <title>PROPIT & LOSS REPORT</title>
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
                <h1>PROPIT & LOSS REPORT</h1>
                
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


    function searchExpenses() {
        const startDate = document.getElementById('expencestdate').value;
        const endDate = document.getElementById('expenceenddate').value;

        if (!startDate || !endDate) {
            alert("Please select both start and end dates.");
            return;
        }

        fetch('/pnl/filter', {
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

                let html = `
            <div class="row">
                <div class="col-12">
                    <p style="text-align: center;">Data Range - ${start_date} To ${end_date}</p>
                    <table class="table table-responsive">
                        <tr>
                            <td colspan="3" style="text-align: center; font-weight: bold;">
                                Total Income: ${Number(data.total_income).toFixed(2)}
                            </td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>Description</td>
                            <td>Amount</td>
                        </tr>`;

                // Generate table rows for expenses
                data.expenses.forEach(expense => {
                    html += `
                <tr>
                    <td>${expense.date_time}</td>
                    <td>${expense.description}</td>
                    <td>${Number(expense.amount).toFixed(2)}</td>
                </tr>`;
                });

                // Add total expenses and net income/loss
                html += `
                        <tr>
                            <td colspan="3" style="text-align: center; font-weight: bold;">
                                Total Expenses: ${Number(data.total_amount).toFixed(2)}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center; font-weight: bold;">
                                NET INCOME/LOSS: ${(data.total_income - data.total_amount).toFixed(2)}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Pagination Links -->
            `;

                // Update the display details content
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