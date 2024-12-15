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
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Book Vehicle</h4>
                                    <div class="notificationdisplay" id="notificationdisplay"></div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Id</label>
                                            <input type="text" class="form-control" id="bookingid" name="bookingid" style="color: gray;" value="{{ $booking->id }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Customer Full Name</label>
                                            <input type="text" class="form-control" id="customername" name="customername" style="color: gray;" value="{{ $booking->full_name }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">NIC</label>
                                            <input type="text" class="form-control" id="nic" name="nic" style="color: gray;" value="{{ $booking->nic }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Contact No</label>
                                            <input type="number" class="form-control" id="contactno" name="contactno" style="color: gray;" value="{{ $booking->telephone_no }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="hiretypr">Select Hire Type</label>
                                            <select name="hiretypr" id="hiretypr" class="form-control" onchange="sethiretype(this.value)">
                                                <!-- Default selected option -->
                                                <option value="{{ $booking->isdriver }}" selected>{{ $booking->isdriver }}</option>

                                                <!-- Generate other options, avoiding duplication -->
                                                @php
                                                $hireTypes = ['without_driver' => 'Without Driver', 'with_driver' => 'With Driver', 'hire' => 'Hire'];
                                                @endphp
                                                @foreach ($hireTypes as $value => $label)
                                                @if ($value != $booking->isdriver)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="vehicleno">Select Vehicle</label>
                                            <select name="vehicleno" id="vehicleno" class="form-control" onchange="checkiscompleteProfile(this.value)">
                                                <!-- Add default option -->
                                                <option value="{{ $booking->vehicle_no }}" selected>{{ $booking->vehicle_no }}</option>

                                                <!-- Generate options without duplicating the default vehicle -->
                                                @foreach ($vehicles as $vehicle)
                                                @if ($vehicle->vehical_no != $booking->vehicle_no)
                                                <option value="{{ $vehicle->vehical_no }}">{{ $vehicle->vehical_no }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Booking Start Date</label>
                                            <input type="date" class="form-control" id="booking_start_date" name="booking_start_date" style="color: gray;" value="{{ $booking->book_start_date }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Pick Time</label>
                                            <input type="time" class="form-control" id="picktime" name="picktime" style="color: gray;" value="{{ $booking->pick_time }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Pick Location</label>
                                            <input type="text" class="form-control" id="picklocation" name="picklocation" style="color: gray;" value="{{ $booking->pick_location }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Where to go?</label>
                                            <input type="text" class="form-control" id="wheretogo" name="wheretogo" style="color: gray;" value="{{ $booking->wheretogo }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Return Date</label>
                                            <input type="date" class="form-control" id="booking_return_date" name="booking_return_date" style="color: gray;" value="{{ $booking->return_date }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Return Time</label>
                                            <input type="time" class="form-control" id="booking_return_time" name="booking_return_time" style="color: gray;" value="{{ $booking->return_time }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Return Location</label>
                                            <input type="text" class="form-control" id="booking_return_location" name="booking_return_location" style="color: gray;" value="{{ $booking->return_location }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="isconfirm">Is Confirm</label>
                                            <select name="isconfirm" id="isconfirm" class="form-control" onchange="selectConfirmation(this.value)">
                                                <!-- Default selected option -->
                                                <option value="{{ $booking->isconfirm }}" selected>{{ ucfirst(str_replace('_', ' ', $booking->isconfirm)) }}</option>

                                                <!-- Generate other options, avoiding duplication -->
                                                @php
                                                $confirmationStatuses = [
                                                'not_yet' => 'Not Yet',
                                                'confirmed' => 'Confirmed'
                                                ];
                                                @endphp
                                                @foreach ($confirmationStatuses as $value => $label)
                                                @if ($value != $booking->isconfirm)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Confirmation Payment Amount</label>
                                            <input type="number" class="form-control" id="confirmation_amount" name="confirmation_amount" style="color: gray;" value="{{ $booking->confirm_amount }}">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Hire Description</label>
                                            <textarea name="note" id="note" cols="30" rows="10" class="form-control">{{ $booking->note }}</textarea>
                                        </div>
                                    </div>

                                    <button class="btn btn-dark">Cancel</button>
                                    <button type="button" class="btn btn-primary mr-2" onclick="updatebooking()" id="appoingmentsavebtn">Update</button>
                                </div>
                            </div>
                        </div>

                        <!-- myvehicles -->

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
    function updatebooking() {
        // Collect form data
        const bookingid = $('#bookingid').val();
        const customername = $('#customername').val();
        const nic = $('#nic').val();
        const contactno = $('#contactno').val();
        const vehicleno = $('#vehicleno').val();
        const booking_start_date = $('#booking_start_date').val();
        const picktime = $('#picktime').val();
        const picklocation = $('#picklocation').val();
        const wheretogo = $('#wheretogo').val();
        const booking_return_date = $('#booking_return_date').val();
        const booking_return_time = $('#booking_return_time').val();
        const booking_return_location = $('#booking_return_location').val();
        const hiretypr = $('#hiretypr').val();
        const note = $('#note').val();
        const isconfirm = $('#isconfirm').val();
        const confirmation_amount = $('#confirmation_amount').val();

        // Check required fields
        if (
            !customername || !nic || !contactno || !vehicleno || !booking_start_date ||
            !picktime || !picklocation || !wheretogo || !booking_return_date ||
            !booking_return_time || !booking_return_location || !hiretypr
        ) {
            displayMessage('Please fill in all the required fields.', 'error');
            return;
        }

        // Prepare data object
        const data = {
            bookingid: bookingid,
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
            note: note,
            isconfirm: isconfirm,
            confirmation_amount: confirmation_amount,
        };

        // Send AJAX request
        $.ajax({
            url: '/updatebooking',
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.code === 203) {
                    displayMessage('A booking conflict exists. Please check the dates.', 'warning');
                } else if (response.code === 200) {
                    displayMessage('Booking updated successfully.', 'success');
                    refresh(); // Optionally reload the page or refresh the data
                } else {
                    displayMessage('Unexpected response from the server.', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                let message = 'An error occurred while updating the booking. Please try again.';

                if (xhr.status === 404) {
                    message = 'Booking not found.';
                } else if (xhr.status === 422) {
                    message = 'Validation error. Please check your input.';
                }

                displayMessage(message, 'error');
            }
        });
    }

    // Function to display messages
    function displayMessage(message, type) {
        const messageContainer = $('#message-container'); // Assume there's a container for displaying messages
        const types = {
            success: 'alert-success',
            error: 'alert-danger',
            warning: 'alert-warning',
            info: 'alert-info'
        };

        // Clear existing messages
        messageContainer.html('');

        // Add new message
        messageContainer.append(`
        <div class="alert ${types[type] || 'alert-info'}" role="alert">
            ${message}
        </div>
    `);

        // Auto-hide the message after 5 seconds
        setTimeout(() => {
            messageContainer.html('');
        }, 5000);
    }

    function sethiretype(value) {

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