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
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Invoice</h4>
                                    <div class="notificationdisplay" id="notificationdisplay"></div>
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Booking Records</label>
                                            <select class="form-control" id="booking_record" name="booking_record" style="color: gray;" onchange="getbookingDetails(this.value)">
                                                <option value="0">No</option>
                                                @foreach ($bookings as $booking)
                                                <option value="{{ $booking->id }}">{{ $booking->vehicle_no }} - {{ $booking->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Customer Name</label>
                                            <input type="text" class="form-control" id="customer_name" name="customer_name" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">NIC</label>
                                            <input type="text" class="form-control" id="nic" name="nic" style="color: gray;" onkeyup="findenquary(event, this.value); return false;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Driving license No</label>
                                            <input type="text" class="form-control" id="drivinglicenseno" name="drivinglicenseno" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Contact No</label>
                                            <input type="number" class="form-control" id="contactno" name="contactno" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Select Vehicle</label>
                                            <select name="vehicleno" id="vehicleno" class="form-control" onchange="checkiscompleteProfile(this.value)">
                                                <option>Select Vehicle</option>
                                                @foreach ($avalibleVehicles as $vehicle)
                                                <option value="{{ $vehicle->vehical_no }}">{{ $vehicle->vehical_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Issue Date</label>
                                            <input type="date" class="form-control" id="issue_date" name="issue_date" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Issue Time</label>
                                            <input type="time" class="form-control" id="issue_time" name="issue_time" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Where to go?</label>
                                            <input type="text" class="form-control" id="wheretogo" name="wheretogo" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Return Date</label>
                                            <input type="date" class="form-control" id="booking_return_date" name="booking_return_date" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Return Time</label>
                                            <input type="time" class="form-control" id="booking_return_time" name="booking_return_time" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Return Location</label>
                                            <input type="text" class="form-control" id="booking_return_location" name="booking_return_location" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Select Hire Type</label>
                                            <select name="hiretypr" id="hiretypr" class="form-control">
                                                <option value="with_driver">With Driver</option>
                                                <option value="without_driver">Without Driver</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Description</label>
                                            <textarea name="note" id="note" cols="30" rows="5" class="form-control" style="color:gray;"></textarea>
                                        </div>
                                    </div>



                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Permanent Address</label>
                                            <textarea class="form-control" id="p_address" name="p_address" style="color: gray;" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Temp Address</label>
                                            <textarea class="form-control" id="t_address" name="t_address" style="color: gray;" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Witness Full Name</label>
                                            <input type="text" class="form-control" id="witnessname" name="witnessname" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Witness Permanent Address</label>
                                            <textarea class="form-control" id="witness_p_address" name="witness_p_address" style="color: gray;" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="forms-sample">
                                        <div class="form-group row">
                                            <div class="col">
                                                <label>NIC No</label>
                                                <div id="the-basics">
                                                    <span class="twitter-typeahead" style="position: relative; display: inline-block;"><input class="typeahead tt-hint" type="text" readonly="" autocomplete="off" spellcheck="false" tabindex="-1" dir="ltr" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: none 0% 0% / auto repeat scroll padding-box padding-box rgb(42, 48, 56);"><input class="typeahead tt-input" id="witnessnic" name="witnessnic" type="text" placeholder="Identity Card No" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;">
                                                        <pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: Rubik, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre>
                                                        <div class="tt-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;">
                                                            <div class="tt-dataset tt-dataset-states"></div>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label>Telepone</label>
                                                <div id="bloodhound">
                                                    <span class="twitter-typeahead" style="position: relative; display: inline-block;"><input class="typeahead tt-hint" type="text" readonly="" autocomplete="off" spellcheck="false" tabindex="-1" dir="ltr" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: none 0% 0% / auto repeat scroll padding-box padding-box rgb(42, 48, 56);"><input class="typeahead tt-input" id="witnesstelephone" name="witnesstelephone" type="text" placeholder="Telephone Number" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;">
                                                        <pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: Rubik, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre>
                                                        <div class="tt-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;">
                                                            <div class="tt-dataset tt-dataset-states"></div>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Address Line Two</label>
                                            <input type="text" class="form-control" id="addresslinetwo" name="addresslinetwo" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">City</label>
                                            <input type="text" class="form-control" id="city" name="city" style="color: gray;">
                                        </div>
                                    </div> -->

                                    <div class="filesview" id="filesview">

                                    </div>

                                    <button class="btn btn-dark">Cancel</button>
                                    <button type="button" class="btn btn-primary mr-2" onclick="checkisempty()" id="reqinvoicebtn">Request For Invoice</button>
                                </div>
                            </div>
                        </div>

                        <!-- myvehicles -->
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Today Invoice List</h4>
                                        <p class="text-muted mb-1">Invoice Date & Time</p>
                                        <p class="text-muted mb-1">Important data Sets</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach($invoicereqbookings as $invoicereqbooking)
                                            <div class="preview-list">
                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $invoicereqbooking->vehicle_no }}</h6>
                                                            <p class="text-muted mb-0">{{ $invoicereqbooking->book_start_date }} To {{ $invoicereqbooking->return_date }}</p>
                                                            <p class="text-muted mb-0">Pick Location - {{ $invoicereqbooking->pick_location }} & Pick Time {{ $invoicereqbooking->pick_time }}</p>
                                                            <p class="text-muted mb-0">Customer - {{ $invoicereqbooking->full_name }} ,Call {{ $invoicereqbooking->telephone_no }}</p>
                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <p class="text-muted">Travel To - {{ $invoicereqbooking->wheretogo }}</p>
                                                            @if($invoicereqbooking->isdriver == 'with_driver')
                                                            <p class="text-muted mb-0">Booking with driver</p>
                                                            @else
                                                            <p class="text-muted mb-0">Booking Without driver</p>
                                                            @endif
                                                            <button class="add btn btn-primary mt-2" id="{{ $invoicereqbooking->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="viewbooking(this.id)">View pending Invoice</button>
                                                            <button class="add btn btn-danger mt-2" id="{{ $invoicereqbooking->id }}" data-bs-toggle="modal" data-bs-target="#cancelBooking" onclick="setbookingid(this.id)">Cancel pending Invoice</button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Invoice</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="invoicedisplay" id="invoicedisplay">
                    <form id="invoiceForm" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <div class="modal-body">
                                    <div class="modal-body" style="display:none">
                                        <div class="forms-sample">
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Booking Id</label>
                                                <input type="number" class="form-control" id="bookingid" name="bookingid" style="color: gray;" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Customer Photo</label>
                                            <input type="file" class="form-control" id="customerphoto" name="customerphoto" style="color: gray;object-fit: scale-down;">
                                        </div>
                                    </div>


                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Driving license Photo</label>
                                            <input type="file" class="form-control" id="drivinglicensephoto" name="drivinglicensephoto" style="color: gray;object-fit: scale-down;">
                                        </div>
                                    </div>


                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Living Verification</label>
                                            <input type="file" class="form-control" id="livingverification" name="livingverification" style="color: gray;object-fit: scale-down;">
                                        </div>
                                    </div>


                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="10" rows="5"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="modal-body">

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Issue Type</label>
                                            <select name="issutype" id="issutype" class="form-control" onchange="getRentalsDetails(this.value)">
                                                <option value="select">Select</option>
                                                <option value="day">Rent for the day</option>
                                                <option value="week">Rent for the week</option>
                                                <option value="month">Rent for the month</option>
                                                <option value="year">Rent for the year</option>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Out-Meeter Reading</label>
                                            <input type="number" class="form-control" id="outmeeterreading" name="outmeeterreading" style="color: gray;">
                                        </div>
                                    </div>



                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Delivery Charges</label>
                                            <input type="number" class="form-control" id="deliverycharges" name="deliverycharges" style="color: gray;" onblur="calcdelivery()" value="0">
                                        </div>
                                    </div>


                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Fual Level</label>
                                            <input type="text" class="form-control" id="fual_level" name="fual_level" style="color: gray;" value="Full">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Date Count</label>
                                            <input type="text" class="form-control" id="datecount" name="datecount" style="color: gray;" readonly>
                                        </div>
                                    </div>


                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Maximum Free Distance (Km)</label>
                                            <input type="number" class="form-control" id="freeissueduration" name="freeissueduration" style="color: gray;">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="modal-body">
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Price Per Day / week / Month</label>
                                            <input type="text" class="form-control" id="allc_price" name="allc_price" style="color: gray;" onblur="calcTotalAmountDeside(this.value)">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Expected Discount</label>
                                            <input
                                                type="number"
                                                class="form-control"
                                                id="expected_discount"
                                                name="expected_discount"
                                                style="color: gray;"
                                                onkeyup="calcDiscount(this.value, event)" />
                                        </div>
                                    </div>


                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Advance Type</label>
                                            <select name="deposittype" id="deposittype" class="form-control">
                                                <option value="no">Select</option>
                                                <option value="not request">Not Request</option>
                                                <option value="cash advance">Cash Advance</option>
                                                <option value="property">Property</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Refundable Deposit Amount</label>
                                            <input type="number" class="form-control" id="advance" name="advance" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Amount Of Total</label>
                                            <input type="number" class="form-control" id="amountoftotal" name="amountoftotal" style="color: gray;" readonly>
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">First Payment</label>
                                            <input type="number" class="form-control" id="firstpayment" name="firstpayment" style="color: gray;" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="modal-body">
                                    <h4>Payments</h4>
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Amount of paid for first payment</label>
                                            <input type="number" class="form-control" id="firstpaid" name="firstpaid" style="color: gray;">
                                        </div>
                                    </div>
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Amount of paid for Delivery payment</label>
                                            <input type="number" class="form-control" id="deliverypaid" name="deliverypaid" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Print Type</label>
                                            <select name="printertype" id="printertype" class="form-control">
                                                <option value="a4">Standerd Size A4 Printer</option>
                                                <option value="pos">Pos Printer</option>

                                            </select>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;" onclick="refresh()">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="advanceinvoice()">Create Agreement</button>

                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <!-- <button type="button" class="btn btn-primary" onclick="printbill()">Print Bill</button> -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancelBooking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Booking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="bookingidforcancel" id="bookingidforcancel" style="display: none;">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                    <button type="button" class="btn btn-primary" onclick="cancelBooking()">Cancel Booking</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Vehicle Check</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalMessage">
                    <!-- Response message will be inserted here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;" onclick="refresh()">Close</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Modal -->


<!-- <script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script> -->



<script>
    function getRentalsDetails(value) {
        var bookingid = document.getElementById('bookingid').value;
        var datecount = document.getElementById('datecount').value;
        var deliverycharges = parseFloat(document.getElementById('deliverycharges').value);
        // alert(vehicleno); amountoftotal  freeissueduration
        $.ajax({
            url: '/getrentaldetails',
            type: 'GET',
            data: {
                value: value,
                bookingid: bookingid
            },
            success: function(response) {
                if (response.rentaldetails) {
                    // alert(response.data.nic);
                    if (value == 'day') {
                        var rentalamount = response.rentaldetails.per_day_rental;
                        var amountoftotal = (response.rentaldetails.per_day_rental * datecount);
                        var freeDuration = response.rentaldetails.per_day_free_duration * datecount;
                    }
                    if (value == 'week') {
                        var rentalamount = response.rentaldetails.per_week_rental;
                        var amountoftotal = (response.rentaldetails.per_week_rental * (datecount / 7));
                        var freeDuration = response.rentaldetails.per_week_free_duration * (datecount / 7);
                    }
                    if (value == 'month') {
                        var rentalamount = response.rentaldetails.per_month_rental;
                        var amountoftotal = (response.rentaldetails.per_month_rental * (datecount / 31));
                        var freeDuration = response.rentaldetails.per_month_free_duration * (datecount / 31);
                    }
                    if (value == 'year') {
                        var rentalamount = response.rentaldetails.per_year_rental;
                        var amountoftotal = (response.rentaldetails.per_year_rental * (datecount / 365));
                        var freeDuration = response.rentaldetails.per_year_free_duration * (datecount / 365);
                    }

                    $('#allc_price').val(rentalamount);
                    $('#firstpayment').val(amountoftotal.toFixed(2));
                    $('#firstpaid').val(amountoftotal.toFixed(2));
                    $('#freeissueduration').val(freeDuration);
                    $('#deliverycharges').val(deliverycharges.toFixed(2));
                    $('#amountoftotal').val(amountoftotal.toFixed(2));
                    $('#deliverypaid').val(0.0);
                    

                }
            }
        });
    }

    function calcdelivery() {
        var deliveryCharges = parseFloat(document.getElementById('deliverycharges').value) || 0;
        var bookingId = document.getElementById('bookingid').value.trim();
        var dateCount = parseFloat(document.getElementById('datecount').value) || 0;
        var issueType = document.getElementById('issutype').value;

        // Highlight 'issutype' if not properly selected
        if (issueType === 'select') {
            document.getElementById('issutype').style.border = '2px solid red';
            return; // Exit early if 'issutype' is not selected
        } else {
            document.getElementById('issutype').style.border = 'none';
        }

        // Highlight 'deliverycharges' if empty
        if (!document.getElementById('deliverycharges').value.trim()) {
            document.getElementById('deliverycharges').style.border = '2px solid red';
            return; // Exit early if 'deliverycharges' is empty
        } else {
            document.getElementById('deliverycharges').style.border = 'none';
        }

        // AJAX request
        $.ajax({
            url: '/getrentaldetails',
            type: 'GET',
            data: {
                value: issueType,
                bookingid: bookingId
            },
            success: function(response) {
                if (response.rentaldetails) {
                    var rentalAmount = 0;
                    var amountOfTotal = 0;

                    if (issueType === 'day' && response.rentaldetails.per_day_rental) {
                        rentalAmount = parseFloat(response.rentaldetails.per_day_rental) || 0;
                        amountOfTotal = (rentalAmount * dateCount) + deliveryCharges;
                    } else if (issueType === 'week' && response.rentaldetails.per_week_rental) {
                        rentalAmount = parseFloat(response.rentaldetails.per_week_rental) || 0;
                        amountOfTotal = (rentalAmount * (dateCount / 7)) + deliveryCharges;
                    } else if (issueType === 'month' && response.rentaldetails.per_month_rental) {
                        rentalAmount = parseFloat(response.rentaldetails.per_month_rental) || 0;
                        amountOfTotal = (rentalAmount * (dateCount / 31)) + deliveryCharges;
                    } else if (issueType === 'year' && response.rentaldetails.per_year_rental) {
                        rentalAmount = parseFloat(response.rentaldetails.per_year_rental) || 0;
                        amountOfTotal = (rentalAmount * (dateCount / 365)) + deliveryCharges;
                    }

                    // Update the UI with validated values
                    $('#allc_price').val(rentalAmount.toFixed(2));
                    $('#amountoftotal').val(amountOfTotal.toFixed(2));
                    $('#deliverypaid').val(deliveryCharges.toFixed(2));
                }
            }
        });
    }

    function calcTotalAmountDeside(value) {
        var deliveryCharges = parseFloat(document.getElementById('deliverycharges').value) || 0;

        var bookingid = document.getElementById('bookingid').value;
        var datecount = document.getElementById('datecount').value;
        var issutype = document.getElementById('issutype').value;
        // alert(vehicleno); amountoftotal
        if (issutype == 'select') {
            document.getElementById('issutype').style.border = '2px solid red';
        } else {
            if (issutype == 'day') {

                var amountoftotal = ((value * datecount) + deliveryCharges);
            }
            if (issutype == 'week') {

                var amountoftotal = ((value * (datecount / 7)) + deliveryCharges);
            }
            if (issutype == 'month') {

                var amountoftotal = ((value * (datecount / 31)) + deliveryCharges);
            }
            if (issutype == 'year') {

                var amountoftotal = ((value * (datecount / 365)) + deliveryCharges);
            }

            $('#amountoftotal').val(amountoftotal.toFixed(2));
        }
    }

    function calcDiscount(discountAmount, event) {
        if (event.key === "Enter" || event.keyCode === 13) {
            // Retrieve the total amount
            var firstpayment = parseFloat(document.getElementById('firstpayment').value);
            var deliverycharge = parseFloat(document.getElementById('deliverycharges').value);
            var discount =parseFloat(discountAmount);


            amountOfTotals = parseFloat(firstpayment + deliverycharge - discount);
            // discountAmounts = parseFloat(discountAmount);
            // deliverycharges = parseFloat(deliverycharge);

            // var stm = (amountOfTotals - discountAmounts);

            // newAmountoftotal = stm + deliverycharges;
            // firstpaidAmount = parseFloat(stm) - discountAmounts;

            document.getElementById('amountoftotal').value = amountOfTotals.toFixed(2);
            document.getElementById('firstpaid').value = (firstpayment-discount).toFixed(2);
            // document.getElementById('firstpaid').value = firstpaidAmount.toFixed(2);
        }
    }


    function checkisempty() {
        var nic = $('#nic').val();
        var customer_name = $('#customer_name').val();
        var contactno = $('#contactno').val();
        var issue_date = $('#issue_date').val(); // Set the date value
        var issue_time = $('#issue_time').val(); // Set the date value 
        var wheretogo = $('#wheretogo').val();
        var booking_return_date = $('#booking_return_date').val();
        var booking_return_time = $('#booking_return_time').val();
        var booking_return_location = $('#booking_return_location').val();
        var hiretypr = $('#hiretypr').val();
        var note = $('#note').val();


        if (nic == '' || customer_name == '' || contactno == '' || issue_date == '' || issue_time == '' || wheretogo == '' || booking_return_date == '' || booking_return_time == '' || booking_return_location == '' || hiretypr == '' || note == '') {
            alert('Some Text feaild empty');
        } else {

            saveInvoice();
        }


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
                </head>
                <body>
                    
                    <div class="invoice-body">
                        ${content} <!-- Insert the invoicedisplay content -->
                    </div>
                   
                </body>
            </html>
        `);


        printWindow.print();

        document.body.innerHTML = restorePage;
    }

    function checkiscompleteProfile(vehicalno) {
        $.ajax({
            url: '/ischeckcompletevehicle',
            type: 'GET',
            data: {
                vehicalno: vehicalno,
            },
            success: function(response) {
                if (response.message == 'verified') {
                    $('#modalMessage').text('Vehicle is verified and complete.');
                    document.getElementById('reqinvoicebtn').style.display = 'block';
                    document.getElementById('notificationdisplay').style.display = 'none';
                } else {
                    $('#modalMessage').text(response.message);
                    $('#responseModal').modal('show');
                    document.getElementById('reqinvoicebtn').style.display = 'none';
                    document.getElementById('notificationdisplay').innerHTML = "The selected vehicle is incompleted.select another one.";
                    document.getElementById('notificationdisplay').style.backgroundColor = "red";
                    document.getElementById('notificationdisplay').style.color = "white";
                }

            }
        });
    }

    function viewbooking(bookingid) {
        $('#bookingid').val(bookingid);

        // Get vehicle details 
        $.ajax({
            url: '/getvehicledetails',
            type: 'GET',
            data: {
                bookingid: bookingid,
            },
            success: function(response) {
                if (response.vehicle) {
                    // alert(response.data.nic); booking
                    $('#outmeeterreading').val(response.vehicle.meeter);
                    $('#allc_price').val(response.vehicle.per_day_rental);

                    var startdate = response.booking.book_start_date;
                    var endday = response.booking.return_date;

                    var startDate = new Date(startdate);
                    var endDate = new Date(endday);

                    // Calculate the difference in milliseconds
                    var differenceInTime = endDate - startDate;

                    // Convert milliseconds to days
                    var differenceInDays = differenceInTime / (1000 * 60 * 60 * 24);

                    if (differenceInDays <= 0) {
                        differenceInDays = 1;
                    }

                    document.getElementById('datecount').value = differenceInDays;

                }
            }
        });
        // End 
    }

    function advanceinvoice() {
        var printertype = document.getElementById('printertype').value;
        var issutype = document.getElementById('issutype').value;
        var deposittype = document.getElementById('deposittype').value;
        if (deposittype == 'no') {
            document.getElementById('deposittype').style.border = "2px solid red";
        }
        if (issutype == 'select') {
            document.getElementById('issutype').style.border = "2px solid red";
        } else {
            if (printertype == 'pos') {
                var formData = new FormData(document.getElementById('invoiceForm'));
                document.getElementById('invoicedisplay').innerHTML = '';
                document.getElementById('invoicedisplay').style.padding = '20px';
                $.ajax({
                    url: '/advanceinvoice',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        document.getElementById('invoicedisplay').innerHTML = response;
                        printbill();
                    }
                });
            } else {
                var formData = new FormData(document.getElementById('invoiceForm'));

                $.ajax({
                    url: '/advanceinvoice',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var invoiceid = response.invoice.id;
                        // window.location.href = `/viewagreement/${invoiceid}` ;
                        window.open(`/viewagreement/${invoiceid}`, '_blank');
                        location.reload();
                    }
                });
            }
        }

    }

    function saveInvoice() {
        var booking_record = document.getElementById('booking_record').value;
        var nic = document.getElementById('nic').value;
        var drivinglicenseno = document.getElementById('drivinglicenseno').value;
        var customer_name = document.getElementById('customer_name').value;
        var contactno = document.getElementById('contactno').value;
        var issue_date = document.getElementById('issue_date').value;
        var issue_time = document.getElementById('issue_time').value;
        var wheretogo = document.getElementById('wheretogo').value;
        var booking_return_date = document.getElementById('booking_return_date').value;
        var booking_return_time = document.getElementById('booking_return_time').value;
        var booking_return_location = document.getElementById('booking_return_location').value;
        var hiretypr = document.getElementById('hiretypr').value;
        var note = document.getElementById('note').value;
        var vehicleNo = document.getElementById('vehicleno').value;
        var customer_name = document.getElementById('customer_name').value;
        // var street = document.getElementById('street').value;
        // var addresslinetwo = document.getElementById('addresslinetwo').value;
        // var city = document.getElementById('city').value;
        var paddress = document.getElementById('p_address').value;
        var taddress = document.getElementById('t_address').value;

        var witnessname = document.getElementById('witnessname').value;
        var witness_p_address = document.getElementById('witness_p_address').value;
        var witnessnic = document.getElementById('witnessnic').value;
        var witnesstelephone = document.getElementById('witnesstelephone').value;

        $.ajax({
            url: '/saveinvoice',
            type: 'POST',
            data: {
                booking_record: booking_record,
                nic: nic,
                drivinglicenseno: drivinglicenseno,
                customer_name: customer_name,
                contactno: contactno,
                issue_date: issue_date,
                issue_time: issue_time,
                wheretogo: wheretogo,
                booking_return_date: booking_return_date,
                booking_return_time: booking_return_time,
                booking_return_location: booking_return_location,
                hiretypr: hiretypr,
                note: note,
                vehicleNo: vehicleNo,
                paddress: paddress,
                taddress: taddress,
                witnessname: witnessname,
                witness_p_address: witness_p_address,
                witnessnic: witnessnic,
                witnesstelephone: witnesstelephone,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                location.reload();
            }
        });
    }


    function getbookingDetails(id) {
        if (id == '0') {
            $('#nic').val('');
            $('#customer_name').val('');
            $('#contactno').val('');
            $('#issue_date').val(''); // Set the date value
            $('#issue_time').val(''); // Set the date value 
            $('#wheretogo').val('');
            $('#booking_return_date').val('');
            $('#booking_return_time').val('');
            $('#booking_return_location').val('');
            $('#hiretypr').val('');
            $('#note').val('');

            $('#nic').removeAttr('readonly');
            $('#customer_name').removeAttr('readonly');
            $('#contactno').removeAttr('readonly');
            $('#issue_date').removeAttr('readonly');
            $('#issue_time').removeAttr('readonly');
            $('#wheretogo').removeAttr('readonly');
            $('#booking_return_date').removeAttr('readonly');
            $('#booking_return_time').removeAttr('readonly');
            $('#booking_return_location').removeAttr('readonly');
            $('#hiretypr').removeAttr('readonly');
            $('#note').removeAttr('readonly');

        } else {
            $.ajax({
                url: '/getdetailsbooking',
                type: 'GET',
                data: {
                    bookingid: id,
                },
                success: function(response) {
                    if (response.data) {
                        // alert(response.data.nic);
                        $('#nic').val(response.data.nic);
                        $('#customer_name').val(response.data.full_name);
                        $('#contactno').val(response.data.telephone_no);
                        $('#issue_date').val(response.data.book_start_date); // Set the date value
                        $('#issue_time').val(response.data.pick_time); // Set the date value 
                        $('#wheretogo').val(response.data.wheretogo);
                        $('#booking_return_date').val(response.data.return_date);
                        $('#booking_return_time').val(response.data.return_time);
                        $('#booking_return_location').val(response.data.return_location);
                        $('#hiretypr').val(response.data.isdriver);
                        $('#note').val(response.data.note);
                        $('#street').val(response.data.street);
                        $('#addresslinetwo').val(response.data.address_line_one);
                        $('#city').val(response.data.city);

                        // Add more fields if needed

                        $('#nic').val(response.data.nic).attr('readonly', true);
                        $('#customer_name').val(response.data.full_name).attr('readonly', true);
                        $('#contactno').val(response.data.telephone_no).attr('readonly', true);
                        $('#issue_date').val(response.data.book_start_date).attr('readonly', true);
                        $('#issue_time').val(response.data.pick_time).attr('readonly', true);
                        $('#wheretogo').val(response.data.wheretogo).attr('readonly', true);
                        $('#booking_return_date').val(response.data.return_date).attr('readonly', true);
                        $('#booking_return_time').val(response.data.return_time).attr('readonly', true);
                        $('#booking_return_location').val(response.data.return_location).attr('readonly', true);
                        $('#hiretypr').val(response.data.isdriver).attr('readonly', true);
                        $('#note').val(response.data.note).attr('readonly', true);

                        // filesview
                        document.getElementById('filesview').innerHTML = "";

                        var customerimageUrl = response.data.customer_photo; // Example image URL from response
                        var driving_licen_photo = response.data.driving_licen_photo; // Example image URL from response
                        var livingvarification = response.data.livingvarification; // Example image URL from response

                        var imageContainer = `
<div class="gallery">
  <a target="_blank" href="${customerimageUrl}">
    <img src="${customerimageUrl}" alt="Customer Photo" width="200" height="75">
  </a>
 
</div>
<div class="gallery">
  <a target="_blank" href="${driving_licen_photo}">
    <img src="${driving_licen_photo}" alt="Driving Licen Photo" width="200" height="75">
  </a>
 
</div>
<div class="gallery">
  <a target="_blank" href="${livingvarification}">
    <img src="${livingvarification}" alt="Living Verification Photo" width="200" height="75">
  </a>
</div>
`;
                        document.getElementById('filesview').innerHTML = imageContainer;
                    }
                }
            });
        }
    }

    function refresh() {
        location.reload();
    }

    function setbookingid(bookingid) {
        document.getElementById('bookingidforcancel').innerHTML = bookingid;
    }

    function cancelBooking() {
        var bookingid = document.getElementById('bookingidforcancel').innerHTML;

        $.ajax({
            url: '/cancelbooking',
            type: 'GET',
            data: {
                bookingid: bookingid,

            },
            success: function(response) {
                refresh();
            }
        });
    }

    function findenquary(event, value) {
        if (event.key === "Enter" || event.keyCode === 13) {
            // Code to execute when Enter is pressed


            // Call the function to find payment history or any other logic
            // Example:
            searchCustomer(value);
        }
    }

    function searchCustomer(value) {
        $.ajax({
            url: '/getcustomerdetails',
            type: 'GET',
            data: {
                nic: value,
            },
            success: function(response) {
                if (response.customer) {
                    // Populate the input fields with customer details
                    document.getElementById('customer_name').value = response.customer.full_name;
                    document.getElementById('nic').value = response.customer.nic;
                    document.getElementById('drivinglicenseno').value = response.customer.drivinglicenseno;
                    document.getElementById('contactno').value = response.customer.telephone_no;
                    document.getElementById('p_address').value = response.customer.p_address;
                    document.getElementById('t_address').value = response.customer.t_address;

                } else {
                    // Display an error message if the customer is not found
                    // alert("No customer found.");
                    document.getElementById('notificationdisplay').innerHTML = response.error || "No customer found.";
                    document.getElementById('notificationdisplay').style.color = "white";
                    document.getElementById('notificationdisplay').style.backgroundColor = "red";
                    document.getElementById('notificationdisplay').style.padding = "10px";
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors that occurred during the AJAX request
                console.error("Error occurred: " + error);
                document.getElementById('notificationdisplay').innerHTML = "An error occurred while fetching customer details.";
                document.getElementById('notificationdisplay').style.color = "white";
                document.getElementById('notificationdisplay').style.backgroundColor = "red";
                document.getElementById('notificationdisplay').style.padding = "10px";
            }
        });
    }
</script>