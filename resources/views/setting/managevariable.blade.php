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
                                    <h4 class="card-title">Manage Bill Variable Visibility</h4>

                                    <table class="table table-responcive">
                                        <tr>
                                            <th>Variable Name</th>
                                            <th>Margin Top (px)</th>
                                            <th>Margin Left (px)</th>
                                            <th>Display</th>
                                        </tr>

                                        @foreach ($variables as $variable)
                                        <tr>
                                            <td>{{ $variable->elementid }}</td>
                                            <td>{{ $variable->element_top_possition }}</td>
                                            <td>{{ $variable->element_left_possition }}</td>
                                            <td><select id="{{ $variable->id }}" class="form-control" onchange="savevisibility(this.value,this.id)">
                                                    <option value="{{ $variable->display }}">{{ $variable->display }}</option>
                                                    <option value="block">Block</option>
                                                    <option value="none">None</option>
                                                </select></td>
                                        </tr>
                                        @endforeach

                                    </table>


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
</x-app-layout>


<!-- Modal -->


<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>



<script>
    function savevisibility(value, variableid) {
        
        var data = {
            variableid: variableid,
            value: value,
        };

        $.ajax({
            url: '/savevariablevisibility',
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