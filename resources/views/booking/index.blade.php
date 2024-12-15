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
                                    <h4 class="card-title">Book Vehicle</h4>
                                    <div class="notificationdisplay" id="notificationdisplay"></div>
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Customer Full Name</label>
                                            <input type="text" class="form-control" id="customername" name="customername" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">NIC</label>
                                            <input type="text" class="form-control" id="nic" name="nic" style="color: gray;">
                                            <button class="btn btn-primary" onclick="findcustomerDetails()">Find</button>
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
                                            <label for="exampleInputUsername1">Select Hire Type</label>
                                            <select name="hiretypr" id="hiretypr" class="form-control" onchange="sethiretype(this.value)">
                                                <option value="without_driver">Without Driver</option>
                                                <option value="with_driver">With Driver</option>
                                                <option value="hire">Hire</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Select Vehicle</label>
                                            <select name="vehicleno" id="vehicleno" class="form-control" onchange="checkiscompleteProfile(this.value)">
                                                <option>Select Vehicle</option>
                                                @foreach ($vehicleLists as $vehicle)
                                                <option value="{{ $vehicle->vehical_no  }}"> {{ $vehicle->vehical_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Booking Start Date</label>
                                            <input type="date" class="form-control" id="booking_start_date" name="booking_start_date" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Pick Time</label>
                                            <input type="time" class="form-control" id="picktime" name="picktime" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Pick Location</label>
                                            <input type="text" class="form-control" id="picklocation" name="picklocation" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">where to go?</label>
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
                                            <label for="exampleInputUsername1">Is Confirm</label>
                                            <select name="isconfirm" id="isconfirm" class="form-control" onchange="selectConfirmation(this.value)">
                                                <option value="not_yet">Not Yet</option>
                                                <option value="confirmed">Confirmed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Confirmation Payment Amount</label>
                                            <input type="number" class="form-control" id="confirmation_amount" name="confirmation_amount" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Hire Description</label>
                                            <textarea name="note" id="note" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <button class="btn btn-dark">Cancel</button>
                                    <button type="button" class="btn btn-primary mr-2" onclick="savebooking()" id="appoingmentsavebtn">Save</button>
                                </div>
                            </div>
                        </div>

                        <!-- myvehicles -->
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Find Booking Date</label>
                                            <input type="date" class="form-control" id="find_booking_date" name="find_booking_date" style="color: gray;">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Booking List</h4>
                                        <p class="text-muted mb-1">Booking Date & Time</p>
                                        <p class="text-muted mb-1">Important data Sets</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach($bookings as $booking)
                                            <div class="preview-list">
                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $booking->vehicle_no }}</h6>
                                                            <p class="text-muted mb-0">{{ $booking->book_start_date }} To {{ $booking->return_date }}</p>
                                                            <p class="text-muted mb-0">Pick Location - {{ $booking->pick_location }} & Pick Time {{ $booking->pick_time }} & Return Time {{ $booking->return_time }}</p>
                                                            <p class="text-muted mb-0">Customer - {{ $booking->full_name }} ,Call {{ $booking->telephone_no }}</p>
                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <p class="text-muted">Travel To - {{ $booking->wheretogo }}</p>
                                                            @if($booking->isdriver == 'with_driver')
                                                            <p class="text-muted mb-0">Booking with driver</p>
                                                            @else
                                                            <p class="text-muted mb-0">Booking Without driver</p>
                                                            @endif
                                                            <button class="add btn btn-primary mt-2" id="{{ $booking->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="viewbooking(this.id)">View Booking</button>
                                                            <button class="add btn btn-danger mt-2" id="{{ $booking->id }}" data-bs-toggle="modal" data-bs-target="#cancelBooking" onclick="setbookingid(this.id)">Cancel Booking</button>
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
                    <button type="button" class="btn btn-primary" onclick="createInvoice()">Create Invoice</button>
                </div>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;" onclick="refresh()">Close</button>
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
    function savebooking() {
        var customername = $('#customername').val();
        var nic = $('#nic').val();
        var contactno = $('#contactno').val();
        var vehicleno = $('#vehicleno').val();
        var booking_start_date = $('#booking_start_date').val();
        var picktime = $('#picktime').val();
        var picklocation = $('#picklocation').val();
        var wheretogo = $('#wheretogo').val();
        var booking_return_date = $('#booking_return_date').val();
        var booking_return_time = $('#booking_return_time').val();
        var booking_return_location = $('#booking_return_location').val();
        var hiretypr = $('#hiretypr').val();
        var note = $('#note').val();  
        var isconfirm = $('#isconfirm').val();
        var confirmation_amount = $('#confirmation_amount').val();

        if (customername === "" || nic === "" || contactno === "" || vehicleno === "" || booking_start_date === "" || picktime === "" || picklocation === "" || wheretogo === "" || booking_return_date === "" || booking_return_time === "" || booking_return_location === "" || hiretypr === "") {
            alert("Please fill in all the required fields.");
            return;
        } else {
            var data = {
                customername: customername,
                nic: nic,
                contactno: contactno,
                vehicleno: vehicleno,
                booking_start_date: booking_start_date,
                picktime: picktime,
                picklocation: picklocation,
                wheretogo: wheretogo,
                booking_return_date: booking_return_date,
                booking_return_time: booking_return_time,
                booking_return_location: booking_return_location,
                hiretypr: hiretypr,
                note: note
            };

            $.ajax({
                url: '/addbooking',
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    if (response.code == '203') {
                        alert('Already have some booking');
                    } else {
                        refresh();
                    }
                    // alert('Booking saved successfully!');
                    // Optionally, you can perform further actions like redirecting the user or clearing the form

                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while saving the booking. Please try again.');
                }
            });
        }
    }

    function sethiretype(value){
         
    }

    function selectConfirmation(value) {
        if (value == 'not_yet') {

        }
        if (value == 'confirmed') {

        }
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
                    document.getElementById('appoingmentsavebtn').style.display = 'block';
                    document.getElementById('notificationdisplay').style.display = 'none';
                } else {
                    $('#modalMessage').text(response.message);
                    $('#responseModal').modal('show');
                    document.getElementById('appoingmentsavebtn').style.display = 'none';
                    document.getElementById('notificationdisplay').innerHTML = "The selected vehicle is incompleted.select another one.";
                    document.getElementById('notificationdisplay').style.backgroundColor = "red";
                    document.getElementById('notificationdisplay').style.color = "white";
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

    function findcustomerDetails() {
        var nic = document.getElementById('nic').value;

        $.ajax({
            url: '/getcustomerdetails',
            type: 'GET',
            data: {
                nic: nic,
            },
            success: function(response) {
                if (response.customer) {
                    // Populate the input fields with customer details
                    document.getElementById('customername').value = response.customer.full_name;
                    document.getElementById('contactno').value = response.customer.telephone_no;
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