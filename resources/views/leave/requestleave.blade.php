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
                                            <label for="exampleInputName1">Request Leave Types</label>
                                            <!-- <input type="text" class="form-control" id="companyname" placeholder="Company Name" style="color:gray;"> -->
                                            <select name="leave_type" id="leave_type" class="form-control">
                                                <option value="casual">Casual</option>
                                                <option value="annual">Annual</option>
                                                <option value="medical">Medical</option>
                                                <option value="duty">Duty</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Leave Start Date</label>
                                            <input type="date" class="form-control" id="leave_start_date" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Leave End Date</label>
                                            <input type="date" class="form-control" id="leave_end_date" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Leave Count</label>
                                            <input type="number" class="form-control" id="datecount" style="color:gray;" placeholder="Leave Count">
                                        </div>
                                        <!-- <button class="btn btn-dark">Cancel</button> -->
                                        <button type="submit" onclick="requestLeave()" class="btn btn-primary mr-2">Request</button>
                                    </div>
                                </div>
                            </div>
                            <!-- <img src="{{ asset('assets/images/faces/face6.jpg') }}" alt="image" class="rounded-circle"> -->

                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title">Pending Aprovel</h4>
                                        <!-- <p class="text-muted mb-1 small">View all</p> -->
                                    </div>


                                    <div class="preview-list">
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <a class="text-muted text-small" data-bs-toggle="modal" data-bs-target="#addsalary"><i class="mdi mdi-shape-rectangle-plus"></i> Add Salary</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title">My Available Leave</h4>
                                        <!-- <p class="text-muted mb-1 small">View all</p> -->
                                        @foreach ($myavelible_leaves as $leave)
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="preview-list">
                                                    <div class="preview-item border-bottom">
                                                        <div class="preview-thumbnail">
                                                            <div class="preview-icon bg-primary">
                                                                <i class="mdi mdi-file-document"></i>
                                                            </div>
                                                        </div>
                                                        <div class="preview-item-content d-sm-flex flex-grow">
                                                            <div class="flex-grow">
                                                                <h6 class="preview-subject">{{ $leave->leave_type }}</h6>
                                                            </div>
                                                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                                <p class="text-muted">Available Count - {{ $leave->count }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>



                                    <div class="preview-list">
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <a class="text-muted text-small" data-bs-toggle="modal" data-bs-target="#leave_allocation"><i class="mdi mdi-shape-rectangle-plus"></i> Leave Allocation</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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