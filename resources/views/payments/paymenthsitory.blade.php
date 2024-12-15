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

                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order Status</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>

                                                    <th> Date </th>
                                                    <th> Bill Amount </th>
                                                    <th>Pay Amount </th>
                                                    <th> Balance </th>
                                                    <th> Pay Type </th>
                                                    <th> Description </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->date_time }}</td>
                                                    <td>{{ number_format($payment->amount,2) }}</td>
                                                    <td>{{ number_format($payment->payamount,2) }}</td>
                                                    <td>{{ number_format($payment->balance,2) }}</td>
                                                    <td>{{ $payment->paytype }}</td>
                                                    <td>{{ $payment->description	 }}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">View Invoice</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Invoice Id</label>
                                <input type="number" class="form-control" id="invoiceid" name="invoiceid" style="color: gray;" readonly>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Issue Date</label>
                                <input type="date" class="form-control" id="issuedate" name="issuedate" style="color: gray;">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Return Date</label>
                                <input type="date" class="form-control" id="returndate" name="returndate" style="color: gray;">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">In-meeter reading</label>
                                <input type="number" class="form-control" id="inmeeter" name="inmeeter" style="color: gray;" onkeyup="calInvoice(this.value)">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Total drive distance</label>
                                <input type="number" class="form-control" id="totaldrivedistance" name="totaldrivedistance" style="color: gray;" readonly>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Total Date Count</label>
                                <input type="number" class="form-control" id="date_count" name="date_count" style="color: gray;" readonly>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Extra Millege</label>
                                <input type="number" class="form-control" id="extramillege" name="extramillege" style="color: gray;" readonly>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">B.Amount</label>
                                <input type="number" class="form-control" id="bamount" name="bamount" style="color: gray;" readonly>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Extra Drive Amount</label>
                                <input type="number" class="form-control" id="extra_drive_amount" name="extra_drive_amount" style="color: gray;" readonly>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Net Total</label>
                                <input type="number" class="form-control" id="net_total" name="net_total" style="color: gray;" readonly>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Extra</label>
                                <input type="number" class="form-control" id="extra" name="extra" style="color: gray;" onkeyup="addextra(this.value)">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Discount</label>
                                <input type="number" class="form-control" id="discount" name="discount" style="color: gray;" onkeyup="adddiscount(this.value)">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Total Amount</label>
                                <input type="number" class="form-control" id="total_amount" name="total_amount" style="color: gray;" readonly>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveInvoice()">Complete Invoice</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Modal -->


<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>



<script>
    function calInvoice(inmeeter) {
        var invoiceid = document.getElementById('invoiceid').value;

        var data = {
            invoiceid: invoiceid,
        };

        $.ajax({
            url: '/getpreinvoicedetails',
            type: 'GET',
            data: data,
            success: function(response) {

                var issuType = response.invoiceDetails.issue_type;
                var advanceCharges = response.invoiceDetails.advance_charge;
                var outmeeter_reading = response.invoiceDetails.starting_meeter;
                var date_count = $('#date_count').val();

                var totalDuration = inmeeter - outmeeter_reading;

                $('#totaldrivedistance').val(totalDuration);


                if (issuType == 'day') {
                    var per_day_rental = response.vehicleDetails.per_day_rental;
                    var per_day_free_duration = response.vehicleDetails.per_day_free_duration;
                    var addtional_per_mile_cost = response.vehicleDetails.addtional_per_mile_cost;

                    var freemil = per_day_free_duration * date_count;
                    var extraMile = totalDuration - (per_day_free_duration * date_count);
                    var day_by_rental = per_day_rental * date_count;


                    if (extraMile < freemil) {
                        $('#extramillege').val(0);
                        $('#extra_drive_amount').val(0);
                        $('#net_total').val(day_by_rental);
                        $('#total_amount').val(day_by_rental);
                    } else {
                        var extra_drive_amount = extraMile * addtional_per_mile_cost;
                        var net_total = extra_drive_amount + day_by_rental;
                        var total_amount = parseFloat(net_total) - parseFloat(advanceCharges);

                        $('#extramillege').val(extraMile);
                        $('#extra_drive_amount').val(extra_drive_amount);
                        $('#bamount').val(day_by_rental);
                        $('#net_total').val(net_total);
                        $('#extra').val(0);
                        $('#discount').val(0);
                        $('#total_amount').val(total_amount);
                    }

                }
                if (issuType == 'week') {
                    var per_week_rental = response.vehicleDetails.per_week_rental;
                    var per_week_free_duration = response.vehicleDetails.per_week_free_duration;
                    var addtional_per_mile_cost = response.vehicleDetails.addtional_per_mile_cost;

                    var weekCount = (parseInt(date_count) / 7);

                    var freemil = per_week_free_duration * weekCount;
                    var extraMile = totalDuration - (per_week_free_duration * weekCount);
                    var week_by_rental = per_week_rental * weekCount;


                    if (extraMile < freemil) {
                        $('#extramillege').val(0);
                        $('#extra_drive_amount').val(0);
                        $('#net_total').val(week_by_rental);
                        $('#total_amount').val(week_by_rental);
                    } else {
                        var extra_drive_amount = extraMile * addtional_per_mile_cost;
                        var net_total = extra_drive_amount + week_by_rental;
                        var total_amount = parseFloat(net_total) - parseFloat(advanceCharges);

                        $('#extramillege').val(extraMile);
                        $('#extra_drive_amount').val(extra_drive_amount);
                        $('#bamount').val(week_by_rental);
                        $('#net_total').val(net_total);
                        $('#extra').val(0);
                        $('#discount').val(0);
                        $('#total_amount').val(total_amount);
                    }

                }
                if (issuType == 'month') {
                    var per_month_rental = response.vehicleDetails.per_month_rental;
                    var per_month_free_duration = response.vehicleDetails.per_month_free_duration;
                    var addtional_per_mile_cost = response.vehicleDetails.addtional_per_mile_cost;

                    var monthCount = (parseInt(date_count) / 30);

                    var freemil = per_week_free_duration * monthCount;
                    var extraMile = totalDuration - (per_month_free_duration * monthCount);
                    var month_by_rental = per_month_rental * monthCount;


                    if (extraMile < freemil) {
                        $('#extramillege').val(0);
                        $('#extra_drive_amount').val(0);
                        $('#net_total').val(month_by_rental);
                        $('#total_amount').val(month_by_rental);
                    } else {
                        var extra_drive_amount = extraMile * addtional_per_mile_cost;
                        var net_total = extra_drive_amount + month_by_rental;
                        var total_amount = parseFloat(net_total) - parseFloat(advanceCharges);

                        $('#extramillege').val(extraMile);
                        $('#extra_drive_amount').val(extra_drive_amount);
                        $('#bamount').val(month_by_rental);
                        $('#net_total').val(net_total);
                        $('#extra').val(0);
                        $('#discount').val(0);
                        $('#total_amount').val(total_amount);
                    }
                }
                if (issuType == 'year') {
                    var per_year_rental = response.vehicleDetails.per_year_rental;
                    var per_year_free_duration = response.vehicleDetails.per_year_free_duration;
                    var addtional_per_mile_cost = response.vehicleDetails.addtional_per_mile_cost;

                    var freemil = per_week_free_duration * monthCount;
                    var extraMile = totalDuration - (per_month_free_duration * monthCount);
                    var month_by_rental = per_month_rental * monthCount;


                    if (extraMile < freemil) {
                        $('#extramillege').val(0);
                        $('#extra_drive_amount').val(0);
                        $('#net_total').val(month_by_rental);
                        $('#total_amount').val(month_by_rental);
                    } else {
                        var extra_drive_amount = extraMile * addtional_per_mile_cost;
                        var net_total = extra_drive_amount + month_by_rental;
                        var total_amount = parseFloat(net_total) - parseFloat(advanceCharges);

                        $('#extramillege').val(extraMile);
                        $('#extra_drive_amount').val(extra_drive_amount);
                        $('#bamount').val(month_by_rental);
                        $('#net_total').val(net_total);
                        $('#extra').val(0);
                        $('#discount').val(0);
                        $('#total_amount').val(total_amount);
                    }
                }

            },

        });

    }

    function addextra(extraamount) {
        var netTodal = $('#net_total').val();
        var total = parseFloat(netTodal) + parseFloat(extraamount);
        $('#discount').val(0);
        $('#total_amount').val(total);
    }

    function adddiscount(discount) {
        var netTodal = $('#net_total').val();
        var extra = $('#extra').val();

        var totalAmount = (parseFloat(netTodal) + parseFloat(extra)) - parseFloat(discount);
        $('#total_amount').val(totalAmount);
    }

    function completinvoice(invoiceid) {
        var data = {
            invoiceid: invoiceid,
        };

        $.ajax({
            url: '/getpreinvoicedetails',
            type: 'GET',
            data: data,
            success: function(response) {

                var issuType = response.invoiceDetails.issue_type;
                document.getElementById('invoiceid').value = response.invoiceDetails.id;

                const startDate = response.bookingDetails.book_start_date;
                const endDate = response.bookingDetails.return_date;

                const start = new Date(startDate);
                const end = new Date(endDate);

                const timeDifference = end - start;
                const daysDifference = timeDifference / (1000 * 3600 * 24);


                $('#issuedate').val(response.bookingDetails.book_start_date);
                $('#returndate').val(response.bookingDetails.return_date);
                $('#date_count').val(daysDifference);

            },

        });
    }


    function refresh() {
        location.reload();
    }

    function findBookings(bookingdate) {
        $.ajax({
            url: '/getbookingbydate',
            type: 'GET',
            data: {
                bookingdate: bookingdate,

            },
            success: function(response) {
                if (response.html) {
                    document.querySelector('.displaydetails').innerHTML = response.html;
                }
            }
        });
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

    function saveInvoice() {
        var invoiceid = $('#invoiceid').val();
        var issuedate = $('#issuedate').val();
        var returndate = $('#returndate').val();
        var inmeeter = $('#inmeeter').val();
        var totaldrivedistance = $('#totaldrivedistance').val();
        var date_count = $('#date_count').val();
        var extramillege = $('#extramillege').val();
        var bamount = $('#bamount').val();
        var extra_drive_amount = $('#extra_drive_amount').val();
        var net_total = $('#net_total').val();
        var extra = $('#extra').val();
        var discount = $('#discount').val();
        var total_amount = $('#total_amount').val();

        // Array of input fields
        var inputs = [{
                field: $('#invoiceid'),
                value: invoiceid
            },
            {
                field: $('#issuedate'),
                value: issuedate
            },
            {
                field: $('#returndate'),
                value: returndate
            },
            {
                field: $('#inmeeter'),
                value: inmeeter
            },
            {
                field: $('#totaldrivedistance'),
                value: totaldrivedistance
            },
            {
                field: $('#date_count'),
                value: date_count
            },
            {
                field: $('#extramillege'),
                value: extramillege
            },
            {
                field: $('#bamount'),
                value: bamount
            },
            {
                field: $('#extra_drive_amount'),
                value: extra_drive_amount
            },
            {
                field: $('#net_total'),
                value: net_total
            },
            {
                field: $('#extra'),
                value: extra
            },
            {
                field: $('#discount'),
                value: discount
            },
            {
                field: $('#total_amount'),
                value: total_amount
            }
        ];

        // Check each input and add red border if empty
        var allFilled = true;
        inputs.forEach(function(input) {
            if (input.value === '') {
                input.field.css('border', '1px solid red');
                allFilled = false;
            } else {
                input.field.css('border', ''); // Remove red border if not empty
            }
        });

        // If all fields are filled, proceed with AJAX request
        if (allFilled) {
            $.ajax({
                url: '/saveinvoicefinal',
                type: 'POST',
                data: {
                    invoiceid: invoiceid,
                    issuedate: issuedate,
                    returndate: returndate,
                    inmeeter: inmeeter,
                    totaldrivedistance: totaldrivedistance,
                    date_count: date_count,
                    extramillege: extramillege,
                    bamount: bamount,
                    extra_drive_amount: extra_drive_amount,
                    net_total: net_total,
                    extra: extra,
                    discount: discount,
                    total_amount: total_amount
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle the success response
                    var mywindow = window.open('', 'Rent a car Management System', 'height=400,width=600');
                    mywindow.document.write('<html><head>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(response);
                    mywindow.document.write('</body></html>');

                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10

                    mywindow.print();
                    mywindow.close();
                }
            });
        }
    }


    function createInvoice() {
        var bookingid = document.getElementById('bookingidc').innerHTML;
        alert(bookingid);
    }
</script>