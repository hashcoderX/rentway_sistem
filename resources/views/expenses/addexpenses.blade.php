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
                                    <h4 class="card-title">Add Expenses</h4>
                                    <div class="notificationdisplay" id="notificationdisplay"></div>
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Expenses Type</label>
                                            <!-- <input type="text" class="form-control" id="customername" name="customername" style="color: gray;"> -->
                                            <select name="expense_type" id="expense_type" class="form-control">
                                                <option value="utilities">Utilities</option>
                                                <option value="rent">Rent</option>
                                                <option value="salaries">Salaries</option>
                                                <option value="office_supplies">Office Supplies</option>
                                                <option value="transportation">Transportation</option>
                                                <option value="marketing">Marketing</option>
                                                <option value="travel">Travel</option>
                                                <option value="insurance">Insurance</option>
                                                <option value="legal_fees">Legal Fees</option>
                                                <option value="training">Training and Development</option>
                                                <option value="vehicle maintenance">Vehicle maintenance</option>
                                                <option value="fual">Fual</option>
                                                <option value="other">Other</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Expenses Amount</label>
                                            <input type="number" class="form-control" id="expenses_amount" name="expenses_amount" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Expenses Date</label>
                                            <input type="date" class="form-control" id="expensesdate" name="expensesdate" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Reference</label>
                                            <select class="form-control" id="reference" name="reference" style="color: gray;">
                                                <option>Other</option>
                                                @foreach ($myvehicles as $vehicle)
                                                <option>{{ $vehicle->vehical_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Note</label>
                                            <textarea name="note" id="note" cols="30" rows="10" style="color: gray;" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <button class="btn btn-dark">Cancel</button>
                                    <button type="button" class="btn btn-primary mr-2" onclick="saveexpenses()" id="appoingmentsavebtn">Save</button>
                                </div>
                            </div>
                        </div>

                        <!-- myvehicles -->
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Find By Date</label>
                                            <input type="date" class="form-control" id="find_booking_date" name="find_booking_date" style="color: gray;">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Expenses</h4>
                                        <p class="text-muted mb-1"></p>
                                        <p class="text-muted mb-1"></p>
                                        <p class="text-muted mb-1"></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach($expenseslists as $expense)
                                            <div class="preview-list">
                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ ucfirst($expense->expenses_type) }}</h6>
                                                            <p class="text-muted mb-0">{{ number_format($expense->amount, 2) }}</p>
                                                            <p class="text-muted mb-0">Expence Date - {{ $expense->date_time }}</p>
                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <p class="text-muted">Ref - {{ $expense->reference }}</p>
                                                            <p class="text-muted">Note - {{ $expense->description }}</p>

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
    function saveexpenses() {
        var expense_type = $('#expense_type').val();
        var expenses_amount = $('#expenses_amount').val();
        var expensesdate = $('#expensesdate').val();
        var reference = $('#reference').val();
        var note = $('#note').val();

        if (expense_type === "" || expenses_amount === "" || expensesdate === "" || reference === "" || note === "") {
            alert("Please fill in all the required fields.");
            return;
        } else {
            var data = {
                expense_type: expense_type,
                expenses_amount: expenses_amount,
                expensesdate: expensesdate,
                reference: reference,
                note: note,
            };

            $.ajax({
                url: '/addexpenses',
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

            });
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