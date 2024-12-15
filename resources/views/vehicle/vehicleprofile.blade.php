<x-app-layout>

    <style>
        .disabled {
            opacity: 0.5;
            /* Adjust the opacity as desired */
            pointer-events: none;
            /* Prevent pointer events */
        }
    </style>

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
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Our Employees</h4> -->
                                <div class="table-responsive">
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
                                            <div class="preview-item border-bottom mt-4">

                                                <div class="preview-item-content d-flex flex-grow">
                                                    <div class="flex-grow">
                                                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                            <h6 class="preview-subject">{{ $vehicle->vehical_no }}</h6>
                                                            <p class="text-muted text-small"> {{ $vehicle->vehical_brand }} </p>
                                                            <p class="text-muted text-small">{{ $vehicle->vehical_model }}</p>
                                                            <p class="text-muted text-small">Meeter - {{ $vehicle->meeter }}Km <button
                                                                    class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#meetereditmodal"
                                                                    id="vehicle-{{ $vehicle->id }}"
                                                                    onclick="setVehicleId({{ $vehicle->id }}, {{ $vehicle->meeter }})">
                                                                    Edit
                                                                </button></p>
                                                            <p class="text-muted text-small" id="vehicleid">{{ $vehicle->id }}</p>
                                                        </div>
                                                        <p class="text-muted">{{ $vehicle->vehical_type }}</p>
                                                        <p class="text-muted">{{ $vehicle->body_type }}</p>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="preview-item border-bottom mt-4">

                                                <div class="preview-item-content d-flex flex-grow">
                                                    <div class="flex-grow">
                                                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                            <h6 class="preview-subject">Licen Exp - </h6>
                                                            <h6 class="text-muted "> {{ $vehicle->	licen_exp }} </h6>
                                                        </div>
                                                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                            <h6 class="preview-subject"> Insurence Exp - </h6>
                                                            <h6 class="text-muted"> {{ $vehicle->insurence_exp }} </h6>
                                                        </div>

                                                    </div>


                                                </div>

                                            </div>

                                            <div class="preview-item border-bottom mt-4">

                                                <div class="preview-item-content d-flex flex-grow">
                                                    <div class="flex-grow">
                                                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                            <h6 class="preview-subject">Avalibility - </h6>
                                                            <h6 class="text-muted "> {{ $vehicle->avalibility }} </h6>
                                                        </div>

                                                    </div>


                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="card">
                                            <div class="d-flex flex-row justify-content-between">
                                                <h4 class="card-title p-2 d-flex">Rental Details</h4>
                                            </div>
                                            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                <div class="text-md-center text-xl-left">
                                                    <h6 class="mb-1">Per Day </h6>
                                                </div>
                                                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                                    <h6 class="font-weight-bold mb-0">{{ number_format($vehicle->per_day_rental,2) }}</h6>
                                                </div>
                                            </div>
                                            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                <div class="text-md-center text-xl-left">
                                                    <h6 class="mb-1">Per Week </h6>
                                                </div>
                                                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                                    <h6 class="font-weight-bold mb-0">{{ number_format($vehicle->per_week_rental,2) }}</h6>
                                                </div>
                                            </div>
                                            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                <div class="text-md-center text-xl-left">
                                                    <h6 class="mb-1">Per Month </h6>
                                                </div>
                                                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                                    <h6 class="font-weight-bold mb-0">{{ number_format($vehicle->per_month_rental,2) }}</h6>
                                                </div>
                                            </div>
                                            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                <div class="text-md-center text-xl-left">
                                                    <h6 class="mb-1">Addtional Mile Price </h6>
                                                </div>
                                                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                                    <h6 class="font-weight-bold mb-0">{{ number_format($vehicle->addtional_per_mile_cost,2) }}</h6>
                                                </div>
                                            </div>

                                            <a href="/vehicle/{{ $vehicle->id }}" class="btn btn-success">Edit Rental Details</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="card">
                                            <div class="d-flex flex-row justify-content-between">
                                                <h4 class="card-title p-2 d-flex">Duration Details</h4>
                                            </div>
                                            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                <div class="text-md-center text-xl-left">
                                                    <h6 class="mb-1">Per Day (Free)</h6>

                                                </div>
                                                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                                    <h6 class="font-weight-bold mb-0">{{ $vehicle->per_day_free_duration }}Km</h6>
                                                </div>
                                            </div>
                                            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                <div class="text-md-center text-xl-left">
                                                    <h6 class="mb-1">Per Week (Free)</h6>

                                                </div>
                                                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                                    <h6 class="font-weight-bold mb-0">{{ $vehicle->per_week_free_duration }}Km</h6>
                                                </div>
                                            </div>
                                            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                                <div class="text-md-center text-xl-left">
                                                    <h6 class="mb-1">Per Month (Free)</h6>

                                                </div>
                                                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                                    <h6 class="font-weight-bold mb-0">{{ $vehicle->per_month_free_duration }}Km</h6>
                                                </div>
                                            </div>

                                            <a href="/vehicle/{{ $vehicle->id }}" class="btn btn-success">Edit Rental Duration</a>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>


    <div class="modal fade" id="meetereditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Vehicle Meeter Update</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="invoicedisplay" id="invoicedisplay">
                        <div class="forms-sample">
                            <div class="form-group">
                                <label for="vehicleidk">Vehicle ID</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="vehicleidk"
                                    name="vehicleidk"
                                    style="color: gray;"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Now Meeter Reading</label>
                                <input type="number" class="form-control" id="meeterreading" name="meeterreading" style="color: gray;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="updateMeeter()">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    function setVehicleId(vehicleId, meeter) {
        document.getElementById('vehicleidk').value = vehicleId;
        document.getElementById('meeterreading').value = meeter;
    }

    function refresh() {
        location.reload();
    }

    function updateMeeter() {
        var vehicleId = document.getElementById('vehicleidk').value;
        var meeter = document.getElementById('meeterreading').value;

        $.ajax({
            url: '/updatemeeter',
            type: 'GET',
            data: {
                vehicleId: vehicleId,
                meeter: meeter,
            },
            success: function(response) {
                location.reload();
            }
        });
    }
</script>