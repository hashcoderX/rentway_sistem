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

                                    <div class="row">

                                        <div class="col">
                                            <form class="form-inline">
                                                <div class="input-group mb-3 mr-sm-3">
                                                    <label class="mr-3" for="">Start</label>
                                                    <input type="date" id="start_date" name="start_date" class="form-control" style="color: gray;">
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col">
                                            <form class="form-inline">
                                                <div class="input-group mb-3 mr-sm-3">
                                                    <label class="mr-3" for="">End</label>
                                                    <input type="date" id="end_date" name="end_date" class="form-control" style="color: gray;">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col">
                                           
                                        </div>
                                        <div class="col">
                                           
                                        </div>
                                        <div class="col">
                                           
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    
                                                    <th> Emp Name </th>
                                                    <th> Branch </th>
                                                    <th> Department </th>
                                                    <th> Date </th>
                                                    <th> Status </th>
                                                    <th> Clock In </th>
                                                    <th> Clock Out </th>
                                                    <th> Late </th>
                                                    <th> Early Leaving </th>
                                                    <th> Over Time </th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                   
                                                    <td> H.W.S Hewavitharana </td>
                                                    <td> Eheliyagoda </td>
                                                    <td> IT Department </td>
                                                    <td> 2024-03-19 </td>
                                                    <td> Presant </td>
                                                    <td> 2024-03-19 09:00 AM </td>
                                                    <td> 2024-03-19 05:30 PM </td>
                                                    <td> 30 min </td>
                                                    <td> 0 </td>
                                                    <td> 0 </td>
                                                </tr>


                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- compleat Interview  -->


                <!-- End  -->

                <!-- delete cv  -->
                < <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</x-app-layout>

<script>



</script>