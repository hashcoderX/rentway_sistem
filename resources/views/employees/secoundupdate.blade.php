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
                                        <h4 class="card-title">Profile</h4>
                                        <!-- <p class="text-muted mb-1 small">View all</p> -->
                                    </div>
                                    <div class="preview-list">
                                        <div class="preview-item border-bottom">
                                            <div class="preview-thumbnail">
                                                <img src="{{ asset('assets/images/faces/face8.jpg') }}" alt="image" class="rounded-circle">
                                            </div>
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <h6 class="preview-subject">{{ $employee->fullName }}</h6>
                                                        <p class="text-muted text-small">{{ $employee->employeeID }}</p>

                                                    </div>
                                                    <p class="text-muted">{{ $employee->jobTitle }}</p>
                                                    <p class="text-muted">{{ $employee->nic }}</p>
                                                    <p class="text-muted text-small">{{ $employee->address }}</p>
                                                    <p class="text-muted text-small" id="employeesystemid" style="display:none;">{{ $employee->id }}</p>
                                                    <div style="padding: 5px 0 5px 0;">Education</div>

                                                    @if($otherqualification == null)

                                                    @else

                                                    @foreach ($otherqualification as $qualification)
                                                    <p class="text-muted text-small" id="employeesystemid">{{ $qualification->results }} - {{ $qualification->exam_year }}</p>
                                                    @endforeach

                                                    @endif

                                                    <div style="padding: 5px 0 5px 0;">Experiance</div>
                                                    @if($otherqualification == null)

                                                    @else

                                                    @foreach ($experiances as $experiance)
                                                    <p class="text-muted text-small" id="employeesystemid">{{ $experiance->results }} - {{ $experiance->exam_year }}</p>
                                                    @endforeach

                                                    @endif
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- <img src="{{ asset('assets/images/faces/face6.jpg') }}" alt="image" class="rounded-circle"> -->
                            <div class="card">
                                <div class="card-header">
                                    Eduction Details
                                </div>
                                <div class="card-body">
                                    <div class="preview-list">
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <a class="text-muted text-small"><i class="mdi mdi-shape-rectangle-plus"></i> O/L Result</a>
                                                        @if($olresult == null)
                                                        <p class="text-muted text-small" data-bs-toggle="modal" data-bs-target="#olmodal">Add+</p>
                                                        @else
                                                        <p class="text-muted text-small">Compleated</p>
                                                        <p class="text-muted text-small" data-bs-toggle="modal" data-bs-target="#olresultmodal">View</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <a class="text-muted text-small"><i class="mdi mdi-shape-rectangle-plus"></i> A/L Result</a>

                                                        @if($alresult == null)
                                                        <p class="text-muted text-small" data-bs-toggle="modal" data-bs-target="#almodal">Add+</p>
                                                        @else
                                                        <p class="text-muted text-small">Compleated</p>
                                                        <p class="text-muted text-small" data-bs-toggle="modal" data-bs-target="#alresultmodal">View</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <a class="text-muted text-small" data-bs-toggle="modal" data-bs-target="#addotherqualification"><i class="mdi mdi-shape-rectangle-plus"></i> Add Qualification</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            Experiance
                                        </div>
                                        <div class="preview-item border-bottom">
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <a class="text-muted text-small" data-bs-toggle="modal" data-bs-target="#addexperiance"><i class="mdi mdi-shape-rectangle-plus"></i> Add Experiance</a>
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
                                        <h4 class="card-title">Salary & Deductions</h4>
                                        <!-- <p class="text-muted mb-1 small">View all</p> -->
                                    </div>
                                    @if($salaryDetails == null)
                                    @else
                                    @foreach ($salaryDetails as $salary)
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
                                                            <h6 class="preview-subject">{{ $salary->salary_category }}</h6>
                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <p class="text-muted">Rs.{{ $salary->amount }}</p>
                                                            <p class="text-muted mb-0">{{ $salary->aplicable_year }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif

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
                                        <h4 class="card-title">Leave Allocation</h4>
                                        <!-- <p class="text-muted mb-1 small">View all</p> -->
                                    </div>

                                    @foreach ($employee_leaves as $x)
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
                                                            <h6 class="preview-subject">{{ $x->leave_type }}</h6>
                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <p class="text-muted">{{ $x->count }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

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


<!-- Modal -->
<div class="modal fade" id="olmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add your Education</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-sample">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Index Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="index_no" style="color:gray;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Year</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="ol_examyear" style="color:gray;">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Result Table</h4>
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-dark" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 80%;"> Subject </th>
                                                <th style="width: 20%;"> Result </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="subject1" style="color:gray;" value='Sinhala'> </td>
                                                <td> <input type="text" class="form-control" id="subject1_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="subject2" style="color:gray;" value='Mathematics'> </td>
                                                <td> <input type="text" class="form-control" id="subject2_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="subject3" style="color:gray;" value='English'> </td>
                                                <td> <input type="text" class="form-control" id="subject3_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="subject4" style="color:gray;" value='Science'> </td>
                                                <td> <input type="text" class="form-control" id="subject4_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="subject5" style="color:gray;" value='Economics'> </td>
                                                <td> <input type="text" class="form-control" id="subject5_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="subject6" style="color:gray;" value='Accounting'> </td>
                                                <td> <input type="text" class="form-control" id="subject6_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="subject7" style="color:gray;" value='Dance'> </td>
                                                <td> <input type="text" class="form-control" id="subject7_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="subject8" style="color:gray;" value='Mathematics'> </td>
                                                <td> <input type="text" class="form-control" id="subject8_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="subject9" style="color:gray;" value='Information Technology'> </td>
                                                <td> <input type="text" class="form-control" id="subject9_r" style="color:gray;"> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveolresult()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="almodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add your Education</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-sample">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Index Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="al_index_no">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Year</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="al_examyear">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Result Table</h4>
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-dark" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 50%;"> Subject </th>
                                                <th style="width: 50%;"> Result </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="al_subject1" value="Maths" style="color:gray;"> </td>
                                                <td> <input type="text" class="form-control" id="al_subject1_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="al_subject2" value="Physics" style="color:gray;"> </td>
                                                <td> <input type="text" class="form-control" id="al_subject2_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="al_subject3" value="Chemestry" style="color:gray;"> </td>
                                                <td> <input type="text" class="form-control" id="al_subject3_r" style="color:gray;"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input type="text" class="form-control" id="al_subject4" value="English" style="color:gray;"> </td>
                                                <td> <input type="text" class="form-control" id="al_subject4_r" style="color:gray;"> </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                <button type="button" class="btn btn-primary" onclick="savealresult()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addotherqualification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add your Qualification</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-sample">
                        <div class="card">
                            <div class="card-body">
                                <div class="forms-sample">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Qualification</label>
                                        <input type="text" class="form-control" id="qualification_other" placeholder="Qualification" style="color:gray;">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline">
                                            <label class="sr-only" for="inlineFormInputName2">Time Period</label>
                                            <input type="date" class="form-control mb-2 mr-sm-2" id="qo_startdate" placeholder="Jane Doe" style="color:gray;">

                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="date" class="form-control" id="qo_enddate" placeholder="Username" style="color:gray;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <select name="isgraduate" id="isgraduate" class="form-control">
                                            <option value="graduated">Graduated</option>
                                            <option value="undergraduated">Under graduated</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputCity1">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="5" style="color:gray;"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveotherqualification()">Add Qualification</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addexperiance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add your Experiance</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-sample">
                        <div class="card">
                            <div class="card-body">
                                <div class="forms-sample">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Company Name</label>
                                        <input type="text" class="form-control" id="companyname" placeholder="Company Name" style="color:gray;">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline">
                                            <label class="sr-only" for="inlineFormInputName2">Time Period</label>
                                            <input type="date" class="form-control mb-2 mr-sm-2" id="work_startdate" style="color:gray;">

                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="date" class="form-control" id="work_enddate" style="color:gray;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputCity1">Description</label>
                                        <textarea name="description" id="working_description" class="form-control" rows="5" style="color:gray;"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveExperiance()">Add Experiance</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addsalary" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Salary</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-sample">
                        <div class="card">
                            <div class="card-body">
                                <div class="forms-sample">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Salary Particulars</label>
                                        <!-- <input type="text" class="form-control" id="companyname" placeholder="Company Name" style="color:gray;"> -->
                                        <select name="category" id="salary_category" class="form-control">
                                            <option value="basic">Basic</option>
                                            <option value="allowance_one">Allowance I</option>
                                            <option value="allowance_two">Allowance II</option>
                                            <option value="allowance_three">Allowance III</option>
                                            <option value="deduction">Deduction</option>
                                            <option value="loan">Loan</option>
                                            <option value="epf">EPF</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Amount</label>
                                        <input type="number" class="form-control" id="salary_amount" placeholder="Amount" style="color:gray;">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Applicable Year</label>
                                        <input type="date" class="form-control" id="applicable_year" style="color:gray;">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                <button type="button" class="btn btn-primary" onclick="addsal()">Add Salary</button>
            </div>
        </div>
    </div>
</div>

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
    function addsal() {

        var employeesystemid = document.getElementById('employeesystemid').innerHTML;
        var salary_category = document.getElementById('salary_category').value;
        var salary_amount = document.getElementById('salary_amount').value;
        var applicable_year = document.getElementById('applicable_year').value;



        var data = {
            salary_category: salary_category,
            salary_amount: salary_amount,
            applicable_year: applicable_year,
            employeesystemid: employeesystemid,
        };



        $.ajax({
            url: '/updateemployeesalary',
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

    function leaveAllowcate() {
        var employeesystemid = document.getElementById('employeesystemid').innerHTML;
        var leave_type = document.getElementById('leave_type').value;
        var leave_count = document.getElementById('leave_count').value;
        var leave_applicable_year = document.getElementById('leave_applicable_year').value;

        var data = {
            leave_type: leave_type,
            leave_count: leave_count,
            leave_applicable_year: leave_applicable_year,
            employeesystemid: employeesystemid,
        };

        $.ajax({
            url: '/allowcateleaves',
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

    function saveotherqualification() {
        var qualification_other = document.getElementById('qualification_other').value;
        var qo_enddate = document.getElementById('qo_enddate').value;
        var qo_startdate = document.getElementById('qo_startdate').value;
        var isgraduate = document.getElementById('isgraduate').value;
        var employeesystemid = document.getElementById('employeesystemid').innerHTML;

        //    alert(employeesystemid);

        var data = {
            qualification_other: qualification_other,
            qo_enddate: qo_enddate,
            qo_startdate: qo_startdate,
            isgraduate: isgraduate,
            employeesystemid: employeesystemid,
        };

        $.ajax({
            url: '/saveotherqualification',
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



    function saveExperiance() {
        var companyname = document.getElementById('companyname').value;
        var work_startdate = document.getElementById('work_startdate').value;
        var work_enddate = document.getElementById('work_enddate').value;
        var working_description = document.getElementById('working_description').value;
        var employeesystemid = document.getElementById('employeesystemid').innerHTML;

        var data = {
            companyname: companyname,
            work_startdate: work_startdate,
            work_enddate: work_enddate,
            working_description: working_description,
            employeesystemid: employeesystemid,
        };

        $.ajax({
            url: '/updateemployeeexperiance',
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

    function saveolresult() {
        var index_no = $('#index_no').val();
        var ol_examyear = $('#ol_examyear').val();
        var subject_one_result = $('#subject1').val() + '-' + $('#subject1_r').val();
        var subject_two_result = $('#subject2').val() + '-' + $('#subject2_r').val();
        var subject_three_result = $('#subject3').val() + '-' + $('#subject3_r').val();
        var subject_four_result = $('#subject4').val() + '-' + $('#subject4_r').val();
        var subject_five_result = $('#subject5').val() + '-' + $('#subject5_r').val();
        var subject_six_result = $('#subject6').val() + '-' + $('#subject6_r').val();
        var subject_seven_result = $('#subject7').val() + '-' + $('#subject7_r').val();
        var subject_eight_result = $('#subject8').val() + '-' + $('#subject8_r').val();
        var subject_nine_result = $('#subject9').val() + '-' + $('#subject9_r').val();

        var employeesystemid = document.getElementById('employeesystemid').innerHTML;

        var result = subject_one_result + ',' + subject_two_result + ',' + subject_three_result + ',' + subject_four_result + ',' + subject_five_result + ',' + subject_six_result + ',' + subject_seven_result + ',' + subject_eight_result + ',' + subject_nine_result;

        var data = {
            index_no: index_no,
            ol_examyear: ol_examyear,
            result: result,
            employeesystemid: employeesystemid,
        };

        $.ajax({
            url: '/updateemployeeresult',
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
        // alert(subject_one_result);
    }

    function savealresult() {
        var al_index_no = $('#al_index_no').val();
        var al_examyear = $('#al_examyear').val();

        var subject_one_result = $('#al_subject1').val() + '-' + $('#al_subject1_r').val();
        var subject_tworesult = $('#al_subject2').val() + '-' + $('#al_subject2_r').val();
        var subject_three_result = $('#al_subject3').val() + '-' + $('#al_subject3_r').val();
        var subject_four_result = $('#al_subject4').val() + '-' + $('#al_subject4_r').val();

        var employeesystemid = document.getElementById('employeesystemid').innerHTML;

        var result = subject_one_result + ',' + subject_tworesult + ',' + subject_three_result + ',' + subject_four_result;

        var data = {
            al_index_no: al_index_no,
            al_examyear: al_examyear,
            result: result,
            employeesystemid: employeesystemid,
        };

        $.ajax({
            url: '/updateemployeealresult',
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

    function addSalaryfield() {
        var salary_category = document.getElementById('salary_category').value;
        var salary_amount = document.getElementById('salary_amount').value;
        var work_enddate = document.getElementById('work_enddate').value;
        var working_description = document.getElementById('working_description').value;
        var employeesystemid = document.getElementById('employeesystemid').innerHTML;
    }
</script>