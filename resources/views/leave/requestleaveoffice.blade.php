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
                                        <h4 class="card-title">Request Form</h4>
                                        <!-- <p class="text-muted mb-1 small">View all</p> -->
                                    </div>
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Employee NO/Nic</label>
                                            <input type="text" class="form-control" id="employeenic" style="color:gray;">
                                            <button class="btn btn-primary mr-2" onclick="checkemployeedetails()">Check Leave Availability</button>
                                        </div>

                                    </div>

                                    <div class="profile">

                                        <div class="preview-list">
                                            <div class="preview-item border-bottom">
                                                <div class="preview-thumbnail">
                                                    <img src="{{ asset('assets/images/faces/face8.jpg') }}" alt="image" class="rounded-circle">
                                                </div>
                                                <div class="preview-item-content d-flex flex-grow">
                                                    <div class="flex-grow">
                                                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                            <h6 class="preview-subject">H.W Sudharma hewavitharana</h6>
                                                            <p class="text-muted text-small">20012</p>

                                                        </div>
                                                        <p class="text-muted">Engineer</p>
                                                        <p class="text-muted">199306701924</p>
                                                        <p class="text-muted text-small">465/Namaldeniya,Parakaduwa</p>
                                                        <p class="text-muted text-small" id="employeesystemid" style="display:none;"></p>



                                                    </div>



                                                </div>
                                            </div>
                                        </div>

                                        <table class="table table-responcive">

                                            <tr>
                                                <td>Casul</td>
                                                <td>4</td>
                                                <td><button class="btn btn-success mr-2">Request</button></td>
                                            </tr>
                                            <tr>
                                                <td>Medicle</td>
                                                <td>4</td>
                                                <td><button class="btn btn-success mr-2">Request</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- <img src="{{ asset('assets/images/faces/face6.jpg') }}" alt="image" class="rounded-circle"> -->

                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title">Pending Aprovel</h4>
                                        <!-- <p class="text-muted mb-1 small">View all</p> -->

                                    </div>


                                    <table class="table table-responcive">

                                        <tr>
                                            <td>Emp Name</td>
                                            <td>Leave Type</td>
                                            <td>Leave Start</td>
                                            <td>Leave End</td>
                                            <td>Date Count</td>
                                            <td>Is M/Approve</td>
                                            <td>Is HR Approve</td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <td>C.K Dasun Chanaka - LVL111</td>
                                            <td>Casual</td>
                                            <td>2024-05-16</td>
                                            <td>2024-05-18</td>
                                            <td>2</td>
                                            <td>Yes</td>
                                            <td>No</td>
                                            <td><button class="btn btn-success mr-2">Approve</button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- page-body-wrapper ends -->
            </div>
</x-app-layout>


<div class="modal fade" id="leave_allocation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Leave Allocations</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-sample">
                        <div class="card">
                            <div class="card-body">
                                <div class="forms-sample">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Leave Types</label>
                                        <!-- <input type="text" class="form-control" id="companyname" placeholder="Company Name" style="color:gray;"> -->
                                        <select name="leave_type" id="leave_type" class="form-control">
                                            <option value="casual">Casual</option>
                                            <option value="annual">Annual</option>
                                            <option value="medical">Medical</option>
                                            <option value="duty">Duty</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Leave Count</label>
                                        <input type="number" class="form-control" id="leave_count" placeholder="Leave Count" style="color:gray;">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Applicable Year</label>
                                        <input type="date" class="form-control" id="leave_applicable_year" style="color:gray;">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                <button type="button" class="btn btn-primary" onclick="leaveAllowcate()">Leave Allocations</button>
            </div>
        </div>
    </div>
</div>



<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>



<script>
    function checkemployeedetails() {
        var employeenic = document.getElementById('employeenic').value;

        $.ajax({
            url: '/getCandidateCv',
            type: 'GET',
            data: {
                candidateId: candidateId,
            },
            success: function(response) {
                var cvLink = 'cv/' + response.cvlink; // Construct the URL to the PDF file
                var optionsAsString = '<div class="forms-sample">' +
                    '<iframe src="' + cvLink + '" width="100%" height="800"></iframe>' +
                    '</div>';

                document.getElementById('cvview').innerHTML = optionsAsString;
            }
        });

    }

    function requestLeave() {
        var leave_type = document.getElementById('leave_type').value;
        var leave_start_date = document.getElementById('leave_start_date').value;
        var leave_end_date = document.getElementById('leave_end_date').value;
        var datecount = document.getElementById('datecount').value;

        var data = {
            leave_type: leave_type,
            leave_start_date: leave_start_date,
            leave_end_date: leave_end_date,
            datecount: datecount,
        };

        $.ajax({
            url: '/requestleave',
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
</script>