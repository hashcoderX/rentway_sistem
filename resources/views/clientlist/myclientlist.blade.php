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
                                            <!-- <label for="exampleInputUsername1">Client List</label> -->
                                            <!-- <input onchange="findBookings(this.value)" type="date" class="form-control" id="find_booking_date" name="find_booking_date" style="color: gray;"> -->
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Client List</h4>
                                        <p class="text-muted mb-1">Client Basic</p>
                                        <p class="text-muted mb-1">Important data Sets</p>
                                    </div>
                                    <div id="displaydetails" class="displaydetails">
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($customers as $client)
                                                <div class="preview-list">
                                                    <div class="preview-item border-bottom">
                                                        <div class="preview-thumbnail">
                                                            <div class="preview-icon bg-primary">
                                                                <i class="mdi mdi-file-document"></i>
                                                            </div>
                                                        </div>
                                                        <div class="preview-item-content d-sm-flex flex-grow">
                                                            <div class="flex-grow">
                                                                <h6 class="preview-subject">{{ $client->full_name }}</h6>
                                                                <p class="text-muted mb-0">{{ $client->nic }} </p>


                                                            </div>
                                                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                                <p class="text-muted">Call - {{ $client->telephone_no }}</p>
                                                                <button class="btn btn-success" onclick="viewcustomerdetails('{{ $client->nic }}')" data-bs-toggle="modal" data-bs-target="#viewcustmerdetails">More Details</button>
                                                                <a class="badge badge-outline-warning" href="viewaccount/{{ $client->id }}">View Transaction Account</a>
                                                                <button class="btn btn-primary" onclick="getcustomerdetails('{{ $client->nic }}')" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach

                                                <div class="pagination-links">
                                                    {{ $customers->links() }}
                                                </div>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Customer Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="/updatecustomer" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Customer Id</label>
                                    <input type="text" class="form-control" id="customerid" name="customerid" style="color: gray;">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" style="color: gray;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">NIC</label>
                                    <input type="text" class="form-control" id="nic" name="nic" style="color: gray;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Street</label>
                                    <input type="text" class="form-control" id="street" name="street" style="color: gray;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Address Line Two</label>
                                    <input type="text" class="form-control" id="addresslinetwo" name="addresslinetwo" style="color: gray;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">City</label>
                                    <input type="text" class="form-control" id="city" name="city" style="color: gray;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Telephone</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" style="color: gray;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Driving Licen Image (.png,jpg)</label>
                                    <input type="file" class="form-control" id="drivinglicensephoto" name="drivinglicensephoto" style="color: gray;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Living Verification (.png,jpg)</label>
                                    <input type="file" class="form-control" id="livingverification" name="livingverification" style="color: gray;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Customer Image (.png,jpg)</label>
                                    <input type="file" class="form-control" id="customerphoto" name="customerphoto" style="color: gray;">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Customer</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>



    <div class="modal fade" id="viewcustmerdetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Profile</h4>
                                <div class="row">
                                    <div class="col">
                                        <img id="modal-photo-customer" src="" alt="">
                                    </div>
                                    <div class="col">
                                        <img id="modal-photo-verification" src="" alt="">
                                    </div>
                                    <div class="col">
                                        <img id="model-photo-drivinglicen" src="" alt="">
                                    </div>
                                </div>
                                <div class="d-flex py-4">
                                    <div class="preview-list w-100">
                                        <div class="preview-item p-0">
                                            <div class="preview-thumbnail">
                                                <img src="" id="customerimg" class="rounded-circle" alt="">
                                            </div>
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <h4 id="customername"></h4>
                                                        <p class="text-muted text-small" id="nic"></p>
                                                        <p class="text-muted text-small" id="mobileno"></p>
                                                    </div>
                                                    <p class="text-muted" id="address"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <p class="text-muted">Well, it seems to be working now. </p> -->

                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>
</x-app-layout>



<!-- Modal -->

<script>
    function getcustomerdetails(nic) {
        $.ajax({
            url: '/getcustomerdetails',
            type: 'GET',
            data: {
                nic: nic,

            },
            success: function(response) {
                // refresh();
                document.getElementById('customerid').value = response.customer.id;
                document.getElementById('fullname').value = response.customer.full_name;
                document.getElementById('nic').value = response.customer.nic;
                document.getElementById('street').value = response.customer.street;
                document.getElementById('addresslinetwo').value = response.customer.address_line_one;
                document.getElementById('city').value = response.customer.city;
                document.getElementById('telephone').value = response.customer.telephone_no;
            }
        });
    }

    function viewcustomerdetails(nic) {
        $.ajax({
            url: '/getcustomerdetails',
            type: 'GET',
            data: {
                nic: nic,
            },
            success: function(response) {
                // refresh();
                document.getElementById('customername').innerHTML = response.customer.full_name;
                document.getElementById('nic').innerHTML = response.customer.nic;
                document.getElementById('mobileno').innerHTML = response.customer.telephone_no;
                document.getElementById('address').innerHTML = response.customer.street + ',' + response.customer.address_line_one + ',' + response.customer.city;

                if (response.customer.customer_photo) {  
                    document.getElementById('customerimg').src = response.customer.customer_photo;
                    document.getElementById('modal-photo-customer').src = response.customer.customer_photo;
                    document.getElementById('modal-photo-verification').src = response.customer.livingvarification;
                    document.getElementById('model-photo-drivinglicen').src = response.customer.driving_licen_photo;
                } else {
                    document.getElementById('modal-photo').src = 'path-to-placeholder-image.jpg';
                    document.getElementById('modal-photo-verification').src = 'path-to-placeholder-image.jpg';
                    document.getElementById('modal-photo-verification').src = 'path-to-placeholder-image.jpg';
                }
            }
        });
    }
</script>