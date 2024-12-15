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
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Our Employees</h4> -->



                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th> Vehicle No </th>
                                                    <th> Description </th>
                                                    <th> Licen Exp </th>
                                                    <th> Insurence Exp </th>
                                                    <th> Per Day rental </th>
                                                    <th> Meeter </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($vehicles as $vehicle)
                                                <tr>
                                                    <td>{{ $vehicle->vehical_no }}</td>
                                                    <td>{{ $vehicle->vehical_brand }} - {{ $vehicle->vehical_model }}</td>
                                                    <td>{{ $vehicle->licen_exp }}</td>
                                                    <td>{{ $vehicle->insurence_exp }}</td>
                                                    <td>{{ number_format($vehicle->per_day_rental,2) }}</td>
                                                    <td>{{ $vehicle->meeter }}</td>
                                                    <td><a href="/vehicledetails/{{ $vehicle->id }}">More Details</a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

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
</x-app-layout>

<script>
    function refresh() {
        location.reload();
    }
</script>