<x-app-layout>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <div class="leftsidebar">

            @include('../layouts.leftsidebar')
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('../layouts.mainnavbar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create New Department</h4>

                                    <div class="forms-sample">
                                        <div class="form-group" style="display:none;">
                                            <label for="exampleInputUsername1">Department Code</label>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" id="branch_code" placeholder="Branch Code" value="{{ $branchCode }}" style="color:gray" readonly>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="department_code" placeholder="Department Code" style="color:gray" value="{{ $departmentMax }}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Department Name</label>
                                            <input type="text" class="form-control" id="departmentname" placeholder="Department Name" style="color:gray">
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <label for="exampleInputEmail1">Branch - {{ $branchNme }}</label>
                                            <input type="text" class="form-control" id="branchid" readonly value="{{ $branchId }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Unit Head</label>
                                            <!-- <input type="number" class="form-control" id="phone_number" placeholder="Phone Number"> -->
                                            <select class="form-control" name="manager" id="manager">
                                                <option value="n/a">N/A</option>
                                                @foreach ($levels as $level)
                                                <option value="{{ $level->lvl }}">{{ $level->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First Layer </label>
                                            <!-- <input type="text" class="form-control" id="firstlawyer" placeholder="First Layer"> -->
                                            <select class="form-control" id="firstlawyer">
                                                <option value="n/a">N/A</option>
                                                @foreach ($levels as $level)
                                                <option value="{{ $level->lvl }}">{{ $level->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Secound Layer </label>
                                            <!-- <input type="text" class="form-control" id="secound_lawyer" placeholder="Secound Layer"> -->
                                            <select class="form-control" id="secound_lawyer">
                                                <option value="n/a">N/A</option>
                                                @foreach ($levels as $level)
                                                <option value="{{ $level->lvl }}">{{ $level->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Third Layer </label>
                                            <!-- <input type="text" class="form-control" id="third_lawyer" placeholder="Third Layer"> -->
                                            <select class="form-control" id="third_lawyer">
                                                <option value="n/a">N/A</option>
                                                @foreach ($levels as $level)
                                                <option value="{{ $level->lvl }}">{{ $level->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Forth Layer </label>
                                            <!-- <input type="text" class="form-control" id="forth_lawyer" placeholder="Forth Layer"> -->
                                            <select class="form-control" id="forth_lawyer">
                                                <option value="n/a">N/A</option>
                                                @foreach ($levels as $level)
                                                <option value="{{ $level->lvl }}">{{ $level->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea class="form-control" id="description" name="description" cols="30" rows="10" style="color:gray"></textarea>
                                        </div>

                                        <button type="button" class="btn btn-primary mr-2" onclick="addDepartment()">Create</button>
                                        <!-- <button class="btn btn-dark">Cancel</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Our {{ $branchNme }} Departments</h4>
                                        <p class="text-muted mb-1">Important data Sets</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="preview-list">

                                                @foreach($departments as $department)

                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $department->name }}</h6>
                                                            <p class="text-muted mb-0">{{ $department->description }}</p>
                                                        </div>

                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <button class="btn btn-outline-info btn-fw">View Teams</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                @endforeach
                                            </div>

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
</x-app-layout>

<script>
    function addDepartment() {
        var departmentname = document.getElementById('departmentname').value;
        var branchid = document.getElementById('branchid').value;
        var manager = document.getElementById('manager').value;
        var description = document.getElementById('description').value;
        var department_code = document.getElementById('department_code').value;
        var branchCode = document.getElementById('branch_code').value;
        var firstlyer = document.getElementById('firstlawyer').value;
        var secoundlayer = document.getElementById('secound_lawyer').value;
        var thirdlayer = document.getElementById('third_lawyer').value;
        var forthlayer = document.getElementById('forth_lawyer').value;

        var fullcode_department = branchCode + '_' + department_code;

        $.ajax({
            url: '/savedepartment',
            type: 'POST',
            data: {
                departmentname: departmentname,
                branch_id: branchid,
                manager: manager,
                description: description,
                department_code: fullcode_department,
                firstlyer: firstlyer,
                secoundlayer: secoundlayer,
                thirdlayer: thirdlayer,
                forthlayer: forthlayer,
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                // $('#success-message').html('<div class="alert alert-success">' + response.success + '</div>');
                location.reload();

            }, // /success function
            error: function(xhr, status, error) {
                // Handle error if AJAX request fails
                console.error(xhr.responseText);
            }
        });
    }
</script>