<x-app-layout>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <div class="leftsidebar">

            @include('layouts.leftsidebar')
        </div>
        <!-- partial -->
        <style>
            input {
                color: darkgray;
            }
        </style>
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('layouts.mainnavbar')
            <!-- partial -->

            <!-- main-panel ends -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title">Vehicle Details</h4>
                                        <!-- <p class="text-muted mb-1 small">View all</p> -->
                                    </div>
                                    <div class="preview-list">
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <h6 class="preview-subject">{{ $vehicleDetails->vehical_no }}</h6>
                                                        <p class="text-muted text-small">{{ $vehicleDetails->vehical_brand }}</p>
                                                        <p class="text-muted text-small">{{ $vehicleDetails->vehical_model }}</p>
                                                        <p class="text-muted text-small">{{ $vehicleDetails->meeter }} <button>Edit</button> </p>
                                                        <p class="text-muted text-small" id="vehicleid">{{ $vehicleDetails->id }}</p>

                                                    </div>
                                                    <p class="text-muted">{{ $vehicleDetails->vehical_type }}</p>
                                                    <p class="text-muted">{{ $vehicleDetails->body_type }}</p>
                                                </div>


                                            </div>

                                        </div>
                                        <!--<button  class="btn btn-danger m-3">Deactive This Vehicle</button>-->
                                        @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                        @endif

                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Per Day Free Duration</label>
                                            <input type="number" class="form-control" id="per_day_free_duration" name="per_day_free_duration" style="color: gray;" placeholder="100" value="{{ $vehicleDetails->per_day_free_duration }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Per Week Free Duration</label>
                                            <input type="number" class="form-control" id="per_week_free_duration" name="per_week_free_duration" style="color: gray;" placeholder="700" value="{{ $vehicleDetails->per_week_free_duration }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Per Month Free Duration</label>
                                            <input type="number" class="form-control" id="per_month_free_duration" name="per_month_free_duration" style="color: gray;" placeholder="3000" value="{{ $vehicleDetails->per_month_free_duration }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Per Year Free Duration</label>
                                            <input type="number" class="form-control" id="per_year_free_duration" name="per_year_free_duration" style="color: gray;" placeholder="36000" value="{{ $vehicleDetails->per_year_free_duration }}">
                                        </div>

                                        <button class="btn btn-success" onclick="updaterentaldetails()">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title">Add Billing Details</h4>
                                        <!-- <p class="text-muted mb-1 small">View all</p> -->
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Per Day Rentel</label>
                                        <input type="number" class="form-control" id="per_day_rentel" name="per_day_rentel" style="color: gray;" placeholder="3500" value="{{ $vehicleDetails->per_day_rental }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Per Week Rentel</label>
                                        <input type="number" class="form-control" id="per_week_rental" name="per_week_rental" style="color: gray;" placeholder="24500" value="{{ $vehicleDetails->per_week_rental }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Per Month Rentel</label>
                                        <input type="number" class="form-control" id="per_month_rental" name="per_month_rental" style="color: gray;" placeholder="98000" value="{{ $vehicleDetails->per_month_rental }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Per Year Rentel</label>
                                        <input type="number" class="form-control" id="per_year_rental" name="per_year_rental" style="color: gray;" placeholder="1176000" value="{{ $vehicleDetails->per_year_rental }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Addtional Per (km) Rentel</label>
                                        <input type="number" class="form-control" id="addtional_per_mile_cost" name="addtional_per_mile_cost" style="color: gray;" placeholder="35" value="{{ $vehicleDetails->addtional_per_mile_cost }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Required Deposit Amount</label>
                                        <input type="number" class="form-control" id="required_deposit" name="required_deposit" style="color: gray;" placeholder="200000" value="{{ $vehicleDetails->deposit_amount }}">
                                    </div>

                                    <button class="btn btn-success" onclick="vehiclerentelupdate()">Update</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="preview-list">
                                        <div>
                                            Add vehicle Images
                                        </div>
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <a class="text-muted text-small" data-bs-toggle="modal" data-bs-target="#addimages" onclick="setVehicleid()"><i class="mdi mdi-shape-rectangle-plus"></i> Add Vehicle Images</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Vehicle Images</h4>
                                    <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel owl-loaded owl-drag" id="owl-carousel-basic">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage" style="transform: translate3d(-1445px, 0px, 0px); transition: all 0.25s ease 0s; width: 3374px;">

                                                @foreach ($vehicleImages as $vehicleImage)
                                                <div class="owl-item cloned" style="width: 471.984px; margin-right: 10px;">
                                                    <div class="item">
                                                        <img src="{{ asset($vehicleImage->image_url) }}" alt="">
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>

                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="mdi mdi-chevron-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="mdi mdi-chevron-right"></i></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>


                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title">Vehicle Accessories</h4>
                                        <!-- <p class="text-muted mb-1 small">View all</p> -->
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Revenue Licence</label>
                                        <select name="revenuelicence" id="revenuelicence" class="form-control">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Insurance Card</label>
                                        <select name="insurance_card" id="insurance_card" class="form-control">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Emission Certificate</label>
                                        <select name="emission_certificate" id="emission_certificate" class="form-control">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Spare Wheel</label>
                                        <select name="spare_wheel" id="spare_wheel" class="form-control">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Jack</label>
                                        <select name="jack" id="jack" class="form-control">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Wheel Brush</label>
                                        <select name="wheel_brush" id="wheel_brush" class="form-control">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>

                                    <button class="btn btn-success" onclick="vehicleAccessoriesUpdate()">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- page-body-wrapper ends -->


            </div>



</x-app-layout>






<div class="modal fade" id="addimages" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Vehicle Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-sample">
                        <div class="card">
                            <div class="card-body">
                                <form action="/updatevehiclephoto" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Vehicle Id</label>
                                            <input type="text" class="form-control" id="vehicleidforiameg" name="vehicleidforiameg" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Select Image</label>
                                            <input type="file" class="form-control" id="image" name="image" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Alt</label>
                                            <textarea class="form-control" id="image_alt" name="image_alt" style="color:gray;" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                <button type="submit" class="btn btn-primary">Upload Image</button>
            </div>
            </form>
        </div>
    </div>
</div>



<script>
    function updaterentaldetails() {
        var vehicleid = document.getElementById('vehicleid').innerHTML;
        var per_day_free_duration = document.getElementById('per_day_free_duration').value;
        var per_week_free_duration = document.getElementById('per_week_free_duration').value;
        var per_month_free_duration = document.getElementById('per_month_free_duration').value;
        var per_year_free_duration = document.getElementById('per_year_free_duration').value;

        var data = {
            vehicleid: vehicleid,
            per_day_free_duration: per_day_free_duration,
            per_week_free_duration: per_week_free_duration,
            per_month_free_duration: per_month_free_duration,
            per_year_free_duration: per_year_free_duration,
        };

        $.ajax({
            url: '/updatevehicleduration',
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                location.reload();
                // Handle success response
                // console.log(response);
                // Optionally, you can perform further actions like showing a success message or refreshing the page
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
                // Optionally, you can display an error message to the user
            }
        });

    }

    function vehicleAccessoriesUpdate() {
        const vehicleid = document.getElementById('vehicleid').innerHTML.trim();
        const revenuelicence = document.getElementById('revenuelicence').value.trim();
        const insurance_card = document.getElementById('insurance_card').value.trim();
        const emission_certificate = document.getElementById('emission_certificate').value.trim();
        const spare_wheel = document.getElementById('spare_wheel').value.trim();
        const jack = document.getElementById('jack').value.trim();
        const wheel_brush = document.getElementById('wheel_brush').value.trim();

        const data = {
            vehicleid: vehicleid,
            revenuelicence: revenuelicence,
            insurance_card: insurance_card,
            emission_certificate: emission_certificate,
            spare_wheel: spare_wheel,
            jack: jack,
            wheel_brush: wheel_brush,
        };

        $.ajax({
            url: '/updatevehicleaccessories',
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // alert(response.message);
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while updating vehicle accessories.');
            }
        });
    }


    function vehiclerentelupdate() {
        var vehicleid = document.getElementById('vehicleid').innerHTML;
        var per_day_rentel = document.getElementById('per_day_rentel').value;
        var per_week_rental = document.getElementById('per_week_rental').value;
        var per_month_rental = document.getElementById('per_month_rental').value;
        var per_year_rental = document.getElementById('per_year_rental').value;
        var addtional_per_mile_cost = document.getElementById('addtional_per_mile_cost').value;
        var required_deposit = document.getElementById('required_deposit').value;

        var data = {
            vehicleid: vehicleid,
            per_day_rentel: per_day_rentel,
            per_week_rental: per_week_rental,
            per_month_rental: per_month_rental,
            per_year_rental: per_year_rental,
            addtional_per_mile_cost: addtional_per_mile_cost,
            required_deposit: required_deposit,
        };

        $.ajax({
            url: '/updatevehiclerentel',
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                location.reload();
                // Handle success response
                // console.log(response);
                // Optionally, you can perform further actions like showing a success message or refreshing the page
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
                // Optionally, you can display an error message to the user
            }
        });
    }

    function setVehicleid() {
        var vehicleid = document.getElementById('vehicleid').innerHTML;
        document.getElementById('vehicleidforiameg').value = vehicleid;
    }
</script>