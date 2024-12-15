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
                                            <label for="exampleInputUsername1">Find Booking Date</label>
                                            <input onchange="findBookings(this.value)" type="date" class="form-control" id="find_booking_date" name="find_booking_date" style="color: gray;">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Booking List</h4>
                                        <p class="text-muted mb-1">Booking Date & Time</p>
                                        <p class="text-muted mb-1">Important data Sets</p>
                                    </div>
                                    <div id="displaydetails" class="displaydetails">
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
                                                                <p class="text-muted mb-0">Pick Location - {{ $booking->pick_location }} & Pick Time {{ $booking->pick_time }}</p>
                                                                <p class="text-muted mb-0">Customer - {{ $booking->full_name }} ,Call {{ $booking->telephone_no }}</p>
                                                            </div>
                                                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                                <p class="text-muted">Travel To - {{ $booking->wheretogo }}</p>
                                                                @if($booking->isdriver == 'with_driver')
                                                                <p class="text-muted mb-0">Booking with driver</p>
                                                                @else
                                                                <p class="text-muted mb-0">Booking Without driver</p>
                                                                @endif
                                                                <button id="{{ $booking->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="add btn btn-primary" onclick="viewbooking(this.id)">View Booking</button>
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

    function createInvoice(){
        var bookingid = document.getElementById('bookingidc').innerHTML;
        alert(bookingid); 
    }
</script>