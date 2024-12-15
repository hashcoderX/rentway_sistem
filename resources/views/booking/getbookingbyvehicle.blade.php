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
                                            <label for="exampleInputUsername1">Find Vehicle</label>
                                            <input onchange="findvehicle(this.value)" type="text" class="form-control" id="vehicleno" name="vehicleno" style="color: gray;">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Vehicle List</h4>
                                        <p class="text-muted mb-1"></p>
                                        <p class="text-muted mb-1">Important data Sets</p>
                                    </div>
                                    <div id="displaydetails" class="displaydetails">
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($myvehiclelist as $vehicle)
                                                <div class="preview-list">
                                                    <div class="preview-item border-bottom">
                                                        <div class="preview-thumbnail">
                                                            <div class="preview-icon bg-primary">
                                                                <i class="mdi mdi-file-document"></i>
                                                            </div>
                                                        </div>
                                                        <div class="preview-item-content d-sm-flex flex-grow">
                                                            <div class="flex-grow">
                                                                <h6 class="preview-subject">{{ $vehicle->vehical_no }}</h6>
                                                                <p class="text-muted mb-0">{{ $vehicle->meeter }}Km</p>
                                                                <p class="text-muted mb-0"></p>
                                                                <p class="text-muted mb-0"></p>
                                                            </div>
                                                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                                <a href="/booking/vehicledetails/{{ $vehicle->id }}" class="btn btn-primary">View Booking</a>
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