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
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Find Invoice Date</label>
                                            <input onchange="findBookings(this.value)" type="date" class="form-control" id="find_booking_date" name="find_booking_date" style="color: gray;">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Invoice List</h4>
                                        <p class="text-muted mb-1">Invoice Start Date</p>
                                        <p class="text-muted mb-1">Important data Sets</p>
                                    </div>
                                    <div id="displaydetails" class="displaydetails">
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($pendingInvoices as $pendingInvoice)
                                                <div class="preview-list">
                                                    <div class="preview-item border-bottom">
                                                        <div class="preview-thumbnail">
                                                            <div class="preview-icon bg-primary">
                                                                <i class="mdi mdi-file-document"></i>
                                                            </div>
                                                        </div>
                                                        <div class="preview-item-content d-sm-flex flex-grow">
                                                            <div class="flex-grow">
                                                                <h6 class="preview-subject">{{ $pendingInvoice->vehicle_no }}</h6>
                                                                <p class="text-muted mb-0">Invoice Date - {{ $pendingInvoice->invoice_date }} </p>
                                                                <p class="text-muted mb-0">Customer Name - {{ $pendingInvoice->customername }} </p>
                                                                <p class="text-muted mb-0">Out meeter Reading - {{ $pendingInvoice->starting_meeter }} Km</p>

                                                            </div>
                                                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                                <p class="text-muted">Advance Pay - {{ number_format($pendingInvoice->advance_charge,2) }}</p>
                                                                <button id="{{ $pendingInvoice->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="add btn btn-primary" onclick="completinvoice(this.id)">Complet Invoice</button>
                                                                <button id="{{ $pendingInvoice->id }}" data-bs-toggle="modal" data-bs-target="#cancelinvoiceModel" class="add btn btn-danger" onclick="cancelinvoicesetinvoiceid(this.id)">Cancel Invoice</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach
                                            </div>
                                            <!-- <a href="/vehiclelist" class="btn btn-outline-primary btn-fw">Load All Vehicle</a> -->

                                        </div>
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
                    <div id="invoicedisplay">
                        <div class="row g-3" id="payments_display">

                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col-12 col-md-4">
                                <div class="form-group" style="display:none;">
                                    <label for="exampleInputUsername1">Invoice Id</label>
                                    <input type="number" class="form-control" id="invoiceid" name="invoiceid" style="color: gray;" readonly>
                                </div>

                                <div class="form-group" style="display: none;">
                                    <label for="exampleInputUsername1">Issue Date</label>
                                    <input type="date" class="form-control" id="issuedate" name="issuedate" style="color: gray;">
                                </div>

                                <div class="form-group" style="display: none;">
                                    <label for="exampleInputUsername1">Return Date</label>
                                    <input type="date" class="form-control" id="returndate" name="returndate" style="color: gray;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Out-meeter</label>
                                    <input type="number" class="form-control" id="outmeeter" name="outmeeter" style="color: gray;" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">In-meeter reading</label>
                                    <input type="number" class="form-control" id="inmeeter" name="inmeeter" style="color: gray;" onkeyup="calInvoicen(this.value)">
                                    <button class="btn btn-primary" onclick="calInvoicen()">Calculate</button>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Maximum Free Distance (Km)</label>
                                    <input type="number" class="form-control" id="freedistance" name="freedistance" style="color: gray;" readonly>
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


                            </div>

                            <div class="col-12 col-md-4">

                                <div class="form-group" style="display: none;">
                                    <label for="exampleInputUsername1">B.Amount</label>
                                    <input type="number" class="form-control" id="bamount" name="bamount" style="color: gray;" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">First Payment Balance</label>
                                    <input type="number" class="form-control" id="firstpaybalance" name="firstpaybalance" style="color: gray;" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Delivery Charges Balance</label>
                                    <input type="number" class="form-control" id="deliverychargesbalance" name="deliverychargesbalance" style="color: gray;" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Extra Drive Amount</label>
                                    <input type="number" class="form-control" id="extra_drive_amount" name="extra_drive_amount" style="color: gray;" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">2nd Delivery Charges</label>
                                    <input type="number" class="form-control" id="deliverycharges" name="deliverycharges" style="color: gray;" onblur="addDeliveryCharges(this.value)">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Extra</label>
                                    <input type="number" class="form-control" id="extra" name="extra" style="color: gray;" onblur="addextra(this.value)">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">2nd Discount</label>
                                    <input type="number" class="form-control" id="discount" name="discount" style="color: gray;" onblur="adddiscount(this.value)">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Net Total</label>
                                    <input type="number" class="form-control" id="net_total" name="net_total" style="color: gray;" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Repair Deduction</label>
                                    <input type="number" class="form-control" id="repairdeduction" name="repairdeduction" style="color: gray;" onblur="addrepairdeduction(this.value)">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Refundable Deposit Amount</label>
                                    <input type="number" class="form-control" id="paidadvance" name="paidadvance" style="color: gray;" readonly>
                                </div>


                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Bill Total</label>
                                    <input type="number" class="form-control" id="total_amount" name="total_amount" style="color: gray;" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Pay Type</label>
                                    <div id="paytypenotification"></div>
                                    <select class="form-control" id="paytype" name="paytype" onchange="setpaytype(this.value)">
                                        <option value="no">Select</option>
                                        <option value="pay from paid amount">Deduct from the amount of paid</option>
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="cheque">Cheque</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Pay Amount</label>
                                    <input type="number" class="form-control" id="payamount" name="payamount" style="color: gray;" onkeyup="calbalance(this.value,event)">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Balance</label>
                                    <input type="number" class="form-control" id="balance" name="balance" style="color: gray;" readonly>
                                </div>

                                <div class="form-group" style="display: none;">
                                    <label for="exampleInputUsername1">First Payment</label>
                                    <input type="number" class="form-control" id="firstpayment" name="firstpayment" style="color: gray;" readonly>
                                </div>

                                <div class="form-group" style="display: none;">
                                    <label for="exampleInputUsername1">Description</label>
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="2"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Print By</label>
                                    <select name="printertype" id="printertype" class="form-control">
                                        <option value="a4">Standerd Size A4 Printer</option>
                                        <option value="pos">Pos Printer</option>
                                    </select>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveInvoice()">Complete Invoice</button>
                    <!-- <button type="button" class="btn btn-primary" onclick="printbill()">Print Invoice</button> -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;" onclick="refresh()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancelinvoiceModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Invoice</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cancelinvoiceid" id="cancelinvoiceid">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                    <button type="button" class="btn btn-primary" onclick="cancelpendinginvoice()">Cancel Pending Invoice</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Modal -->


<script>
    function addrepairdeduction(amount) {
        var netTodal = $('#net_total').val();

        var totalAmount = parseFloat(netTodal) - parseFloat(amount);
        $('#net_total').val(totalAmount.toFixed(2));

        var newNettotal = $('#net_total').val();
        $('#total_amount').val(newNettotal);

    }

    function close() {
        location.reload();
    }
</script>



<script>
    function addDeliveryCharges(deliveryfee) {
        var balancePayment = document.getElementById('firstpaybalance').value;
        var balanceDelivery = document.getElementById('deliverychargesbalance').value;
        var extradriveamount = document.getElementById('extra_drive_amount').value;

        var nettotal = parseFloat(deliveryfee) + parseFloat(balancePayment) + parseFloat(balanceDelivery) + parseFloat(extradriveamount);
        $('#net_total').val(nettotal.toFixed((2)));


    }

    function calInvoicen(inmeeter) {
        // console.log(inmeeter);
        // alert(inmeeter);
        var invoiceid = document.getElementById('invoiceid').value;
        var inmeeter = document.getElementById('inmeeter').value;
        var freeissueddistance = document.getElementById('freedistance').value;

        var data = {
            invoiceid: invoiceid,
        };

        $.ajax({
            url: '/getpreinvoicedetails',
            type: 'GET',
            data: data,
            success: function(response) {

                // var issuType = response.invoiceDetails.issue_type;

                // var advanceCharges = response.invoiceDetails.advance_charge;
                // var firstpayment = response.invoiceDetails.firstpayment;

                var outmeeter_reading = response.invoiceDetails.starting_meeter;
                var addtionalkmprice = response.invoiceDetails.addtional_mile_chargers;
                var date_count = $('#date_count').val();

                // var deliverycharges = response.invoiceDetails.deliverycharges;

                var totalDuration = inmeeter - outmeeter_reading;

                if (totalDuration <= freeissueddistance) {
                    // console.log('yes');  kudai
                    $('#extramillege').val(0);
                    $('#extra_drive_amount').val(0);

                } else {
                    // console.log('no');   wishalai
                    var extradriveDistance = totalDuration - freeissueddistance;
                    var extradriveCharges = extradriveDistance * addtionalkmprice;
                    $('#extramillege').val(extradriveDistance);

                    $('#extra_drive_amount').val(extradriveCharges.toFixed(2));
                }

                // var alreadyPaidAmount = advanceCharges + firstpayment;

                $('#totaldrivedistance').val(totalDuration);
                // $('#paidadvance').val(advanceCharges);
                // $('#deliverycharges').val(response.invoiceDetails.deliverycharges);
                // $('#firstpayment').val(response.invoiceDetails.firstpayment);








            },

        });

    }

    function cancelinvoicesetinvoiceid(value) {
        document.getElementById('cancelinvoiceid').innerHTML = value;

    }

    function cancelpendinginvoice() {
        var invoiceId = document.getElementById('cancelinvoiceid').innerHTML;

        $.ajax({
            url: '/cancelinvoicesource',
            type: 'GET',
            data: {
                invoiceId: invoiceId,

            },
            success: function(response) {

            }
        });


    }

    function setpaytype(value) {
        var paytype = value;
        var paidadvance = document.getElementById('paidadvance').value;
        var total_amount = document.getElementById('total_amount').value;

        if (paytype == 'pay from paid amount') {
            if (paidadvance == 0) {
                alert('No refundable Deposit payment');
            } else {
                if (paidadvance < total_amount) {
                    balance = paidadvance - total_amount;
                    payamount = 0;
                    $('#payamount').val(payamount.toFixed(2));
                    $('#balance').val(balance.toFixed(2));
                }
                if (paidadvance == total_amount) {
                    balance = 0;
                    payamount = 0;
                    $('#payamount').val(payamount.toFixed(2));
                    $('#balance').val(balance.toFixed(2));
                }
                if (paidadvance > total_amount) {
                    balance = total_amount - paidadvance;
                    payamount = balance;
                    $('#payamount').val(payamount.toFixed(2));
                    $('#balance').val(balance.toFixed(2));
                }
            }


            // $('#payamount').val();
        } else {
            console.log('d');
            // var balance = parseFloat(paidTotal) - parseFloat(total_amount);
            // $('#balance').val(balance);
            // document.getElementById('paytypenotification').innerHTML = '';
            $('#payamount').val(parseFloat(total_amount).toFixed(2));
            $('#balance').val(parseFloat(0).toFixed(2));

        }
    }


    function calbalance(payamount) {

        if (event.key === "Enter" || event.keyCode === 13) {
            // Code to execute when Enter is pressed

            // Retrieve input values
            var paytype = document.getElementById('paytype').value;
            var depositamount = parseFloat(document.getElementById('paidadvance').value) || 0; // Default to 0 if empty
            var payamount = parseFloat(document.getElementById('payamount').value) || 0; // Default to 0 if empty
            var total_amount = parseFloat(document.getElementById('total_amount').value) || 0; // Default to 0 if empty
            var balanceAmount = parseFloat(document.getElementById('balance').value);

            var balance = 0; // Initialize balance



            if (paytype === 'pay from paid amount') {
                console.log('tx');
                if (depositamount <= total_amount) {
                    console.log('tx');
                    balance = (depositamount + payamount - total_amount).toFixed(2); // Balance from deposit
                } else {
                    console.log('tb');
                    balance = (payamount - balanceAmount).toFixed(2); // Balance from deposit
                }

                document.getElementById('balance').value = balance;

            } else {
                console.log('tn');
                // Balance from total amount

                let balance;

                if (payamount > total_amount) {
                    // Positive balance when payamount is greater than total_amount
                    balance = (payamount - total_amount).toFixed(2);
                } else if (payamount === total_amount) {
                    // Zero balance when payamount equals total_amount
                    balance = (0).toFixed(2);
                } else if (payamount < total_amount) {
                    // Negative balance when payamount is less than total_amount
                    balance = (payamount - total_amount).toFixed(2);
                }
                document.getElementById('balance').value = balance;

            }



        }
    }

    function addextra(extraamount) {
        var netTodal = $('#net_total').val();
        var total = parseFloat(netTodal) + parseFloat(extraamount);
        $('#discount').val(0);
        $('#net_total').val(total.toFixed(2));
    }

    function adddiscount(discount) {
        var netTodal = $('#net_total').val();

        var totalAmount = parseFloat(netTodal) - parseFloat(discount);
        $('#net_total').val(totalAmount);
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
                // Clear the payment display section
                $('#payments_display').empty();

                // Extract invoice details
                var issuType = response.invoiceDetails.issue_type;
                var outmeeter = response.invoiceDetails.starting_meeter;
                var freeissuedDuration = response.invoiceDetails.free_issued_duration;
                var paidadvance = response.invoiceDetails.advance_charge;

                var paymentbalance = response.invoiceDetails.first_payment_balance;
                var deliverybalance = response.invoiceDetails.delivery_payment_balance;

                // Populate invoice fields
                document.getElementById('invoiceid').value = response.invoiceDetails.id;

                const startDate = response.bookingDetails.book_start_date;
                const endDate = response.bookingDetails.return_date;

                const start = new Date(startDate);
                const end = new Date(endDate);

                const timeDifference = end - start;
                const daysDifference = timeDifference / (1000 * 3600 * 24);



                // Populate payment details
                if (response.payments && response.payments.length > 0) {
                    response.payments.forEach(function(payment) {
                        var paymentHtml = `
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <p><strong>Amount:</strong> ${payment.payamount.toFixed(2)}</p>
                                    <p><strong>Date:</strong> ${payment.date_time}</p>
                                    <p><strong>Description</strong> ${payment.payment_type}</p>
                                </div>
                            </div>
                        </div>
                    `;
                        $('#payments_display').append(paymentHtml);
                    });
                } else {
                    // Display a message if no payments are found
                    $('#payments_display').html('<p>No payments found.</p>');
                }

                $('#issuedate').val(response.bookingDetails.book_start_date);
                $('#returndate').val(response.bookingDetails.return_date);
                $('#date_count').val(daysDifference);
                $('#outmeeter').val(outmeeter);
                $('#freedistance').val(freeissuedDuration);
                $('#paidadvance').val(paidadvance);
                $('#bamount').val(paymentbalance);
                $('#firstpaybalance').val(paymentbalance);
                $('#deliverychargesbalance').val(deliverybalance);
            },
            error: function(error) {
                console.error("Error loading payment details:", error);
                $('#payments_display').html('<p>Failed to load payment details.</p>');
            }
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

    function saveInvoice(event) {


        var invoiceid = $('#invoiceid').val();
        var outmeeter = $('#outmeeter').val();
        var inmeeter = $('#inmeeter').val();
        var freedistance = $('#freedistance').val();
        var totaldrivedistance = $('#totaldrivedistance').val();
        var date_count = $('#date_count').val();
        var extramillege = $('#extramillege').val();
        var firstpaybalance = $('#firstpaybalance').val();
        var deliverychargesbalance = $('#deliverychargesbalance').val();
        var extra_drive_amount = $('#extra_drive_amount').val();
        var deliverycharges = $('#deliverycharges').val();
        var extra = $('#extra').val();
        var discount = $('#discount').val();
        var net_total = $('#net_total').val();
        var repairdeduction = $('#repairdeduction').val();
        var paidadvance = $('#paidadvance').val();
        var total_amount = $('#total_amount').val();
        var paytype = $('#paytype').val();
        var payamount = $('#payamount').val();
        var balance = $('#balance').val();
        var printertype = $('#printertype').val();

        // Array of input fields
        var inputs = [{
                field: $('#invoiceid'),
                value: invoiceid
            },

            {
                field: $('#outmeeter'),
                value: outmeeter
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
                field: $('#firstpaybalance'),
                value: firstpaybalance
            },
            {
                field: $('#deliverychargesbalance'),
                value: deliverychargesbalance
            },
            {
                field: $('#extra_drive_amount'),
                value: extra_drive_amount
            },
            {
                field: $('#deliverycharges'),
                value: deliverycharges
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
                field: $('#net_total'),
                value: net_total
            },
            {
                field: $('#repairdeduction'),
                value: repairdeduction
            },
            {
                field: $('#paidadvance'),
                value: paidadvance
            },
            {
                field: $('#total_amount'),
                value: total_amount
            },
            {
                field: $('#paytype'),
                value: paytype
            },
            {
                field: $('#payamount'),
                value: payamount
            },
            {
                field: $('#balance'),
                value: balance
            },
            {
                field: $('#printertype'),
                value: printertype
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

            if (printertype == 'pos') {
                document.getElementById('invoicedisplay').innerHTML = '';
                document.getElementById('invoicedisplay').style.padding = '20px';
                $.ajax({
                    url: '/saveinvoicefinal',
                    type: 'POST',
                    data: {
                        invoiceid: invoiceid,
                        outmeeter: outmeeter,
                        inmeeter: inmeeter,
                        freedistance: freedistance,
                        date_count: date_count,
                        extramillege: extramillege,
                        firstpaybalance: firstpaybalance,
                        deliverychargesbalance: deliverychargesbalance,
                        extra_drive_amount: extra_drive_amount,
                        deliverycharges: deliverycharges,
                        extra: extra,
                        discount: discount,
                        net_total: net_total,
                        repairdeduction: repairdeduction,
                        paidadvance: paidadvance,
                        total_amount: total_amount,
                        paytype: paytype,
                        payamount: payamount,
                        balance: balance,
                        printertype: printertype
                    },

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // document.getElementById('invoicedisplay').innerHTML = response;
                        var invoiceid = response.invoice.id;
                        alert(invoiceid);
                        window.open(`/viewinvoicereport/${invoiceid}`, '_blank');
                    }
                });
            } else {
                $.ajax({
                    url: '/saveinvoicefinal',
                    type: 'POST',
                    data: {
                        invoiceid: invoiceid,
                        outmeeter: outmeeter,
                        inmeeter: inmeeter,
                        freedistance: freedistance,
                        date_count: date_count,
                        extramillege: extramillege,
                        firstpaybalance: firstpaybalance,
                        deliverychargesbalance: deliverychargesbalance,
                        extra_drive_amount: extra_drive_amount,
                        deliverycharges: deliverycharges,
                        extra: extra,
                        discount: discount,
                        net_total: net_total,
                        repairdeduction: repairdeduction,
                        paidadvance: paidadvance,
                        total_amount: total_amount,
                        paytype: paytype,
                        payamount: payamount,
                        balance: balance,
                        printertype: printertype
                    },

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var invoiceid = response.invoice.id;
                        alert(invoiceid);
                        window.open(`/viewinvoicereport/${invoiceid}`, '_blank');
                    }
                });
            }


        }
    }


    function createInvoice() {
        var bookingid = document.getElementById('bookingidc').innerHTML;
        alert(bookingid);
    }

    function printbill() {
        // Get the content of the invoicedisplay div
        var content = document.getElementById('invoicedisplay').innerHTML;

        // Create a new window or iframe to hold the content
        var restorePage = document.body.innerHTML;
        var printWindow = window.open('', '_blank', 'width=219.21259843px,height=auto');
        printWindow.document.open();
        printWindow.document.write(`
    <html>
        <head>
            <title>Invoice</title>
            <style>
                /* Add any custom styles for printing */
                body {
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                }
                .invoice-header, .invoice-footer {
                    text-align: center;
                }
                .invoice-body {
                    margin-top: 10px;
                }
            </style>
        </head>
        <body>
            <div class="invoice-body">
                ${content} <!-- Insert the invoicedisplay content -->
            </div>
            <div class="invoice-footer">
                <p>Thank you for your business!</p>
            </div>
        </body>
    </html>
`);


        printWindow.print();

        document.body.innerHTML = restorePage;
    }
</script>