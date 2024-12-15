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
                                        <!-- filter by branch  -->
                                        <div class="col">
                                            <form class="form-inline">

                                                <div class="input-group mb-3 mr-sm-3">
                                                    <label class="mr-3" for="">Filter by Branch</label>
                                                    <select class="form-control" style="width: 100px;">
                                                        <option value="0">Select</option>
                                                        @foreach($branches as $branche)
                                                        <option value="{{ $branche->id }}">{{ $branche->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary mb-2">Filter</button>
                                            </form>
                                        </div>
                                        <!-- end  -->
                                        <div class="col">
                                            <form class="form-inline">

                                                <div class="input-group mb-3 mr-sm-3">
                                                    <label class="mr-3" for="">Filter by Status</label>
                                                    <select class="form-control" style="width: 100px;" style="color: gray;">
                                                        <option>Active</option>
                                                        <option>On Leave</option>
                                                        <option>Terminated</option>
                                                        <option>Retired</option>
                                                        <option>On Probation</option>
                                                        <option>Contract/Temporary</option>
                                                        <option>Suspended</option>
                                                        <option>Part-time/Full-time</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary mb-2">Filter</button>
                                            </form>
                                        </div>

                                        <div class="col">
                                            <form class="form-inline">

                                                <div class="input-group mb-3 mr-sm-3">
                                                    <label class="mr-3" for="">Filter by Name</label>


                                                    <input type="text" id="emp_name" name="emp_name" class="form-control" style="color: gray;">
                                                </div>

                                            </form>
                                        </div>

                                        <div class="col">
                                            <form class="form-inline">

                                                <div class="input-group mb-3 mr-sm-3">
                                                    <label class="mr-3" for="">Emp No</label>


                                                    <input type="text" id="emp_no" name="emp_no" class="form-control" style="color: gray;">
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="form-check form-check-muted m-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input">
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                    </th>
                                                    <th> Emp No </th>
                                                    <th> Employee Name </th>
                                                    <th> Job Title </th>
                                                    <th> Phone Number </th>
                                                    <th>View Profile</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($employees as $employee)
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-muted m-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input">
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                    </td>
                                                    <td>{{ $employee->employeeID }}</td>
                                                    <td>
                                                        <!-- <img src="assets/images/faces/face1.jpg" alt="image"> -->
                                                        <span class="pl-2">{{ $employee->fullName }}</span>
                                                    </td>
                                                    <td> {{ $employee->	jobTitle }} </td>
                                                    <td> {{ $employee->phoneNumber }} </td>
                                                    <td>
                                                        @if ($employee->profile_status == 'completed')
                                                        <a href="employee/{{ $employee->id }}" class="btn btn-outline-success btn-fw">View Profile</a>
                                                        @else
                                                        <a href="employee/{{ $employee->id }}" class="btn btn-outline-danger btn-fw">incompleted Profile</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{ $employees->links() }}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- compleat Interview  -->
                <div class="modal fade" id="viewcv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div id="success-message"></div>

                            </div>
                            <div class="modal-body">
                                <div id="cvview"></div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End  -->

                <!-- delete cv  -->
                <div class="modal fade" id="deletecv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div id="success-message"></div>

                            </div>
                            <div class="modal-body">
                                <div id="deleteid"></div>
                                <p>Are you sure you want to delete this Employee?</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="deleteEmployee()">Delete</button>
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end  -->
                <!-- Modal -->
                <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="employeeModalLabel">Update new employee</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Place your form here -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                Genaral Informaiton
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Empolyee ID - </label>
                                                    <lable id="employeeides"></lable> <br>
                                                    <lable id="emailes" style="color: #ce6701;font-size: 13px;"></lable>
                                                    <!-- <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"> -->
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Phone Number</label>
                                                    <input type="text" name="phone_number" class="form-control" id='phone_number' placeholder="Phone Number" style="color: gray;" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                                    <textarea class="form-control" name="address" id='address' rows="5" style="color: gray;"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputUsername1">Marital Status</label>
                                                    <select class="form-control" id="maritalstatus" name="maritalstatus" style="color: gray;">
                                                        <option value="single">Single</option>
                                                        <option value="merried">Merried</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                Reporting And Education
                                            </div>
                                            <div class="card-body">

                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Staff Level</label>

                                                    <select name="staff_level" id="staff_level" class="form-control" style="color: gray;">
                                                        @foreach($staffLevels as $staffLevel)
                                                        <option value="{{ $staffLevel->lvl }}">{{ $staffLevel->description }}</option>
                                                        @endforeach
                                                    </select>
                                                    <!-- <input type="text" name="phone_number" class="form-control" id='phone_number' placeholder="Phone Number" /> -->
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Report Person</label>

                                                    <select name="reported_manager" id="reported_manager" class="form-control" style="color: gray;">
                                                        <option>CEO</option>
                                                    </select>
                                                    <!-- <input type="text" name="phone_number" class="form-control" id='phone_number' placeholder="Phone Number" /> -->
                                                </div>



                                                <div class="mb-3">
                                                    <label for="exampleInputUsername1">Highest Education</label>
                                                    <select class="form-control" id="higheducation" name="higheducation" style="color: gray;">
                                                        <option>High School Diploma or Equivalent</option>
                                                        <option>Associate's Degree</option>
                                                        <option>Bachelor's Degree</option>
                                                        <option>Master's Degree</option>
                                                        <option>Doctoral Degree (Ph.D., Ed.D., etc.)</option>
                                                        <option>Professional Degree</option>
                                                        <option>Vocational or Technical Certification</option>
                                                        <option>Some College or No Degree</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputUsername1">Degree</label>
                                                    <select id="degree" class="form-control" name="degree" style="color: gray;">
                                                        <option value="bsc_software_engineering">B.Sc. Software Engineering</option>
                                                        <option value="bsc_computer_science">B.Sc. Computer Science</option>
                                                        <option value="bsc_information_technology">B.Sc. Information Technology</option>
                                                        <option value="bsc_mathematics">B.Sc. Mathematics</option>
                                                        <option value="bsc_physics">B.Sc. Physics</option>
                                                        <option value="bsc_biology">B.Sc. Biology</option>
                                                        <option value="bsc_chemistry">B.Sc. Chemistry</option>
                                                        <option value="bsc_environmental_science">B.Sc. Environmental Science</option>
                                                        <option value="bsc_psychology">B.Sc. Psychology</option>
                                                        <option value="bsn_nursing">B.S.N. Nursing</option>
                                                        <option value="ba_english_literature">B.A. English Literature</option>
                                                        <option value="ba_history">B.A. History</option>
                                                        <option value="ba_sociology">B.A. Sociology</option>
                                                        <option value="ba_political_science">B.A. Political Science</option>
                                                        <option value="ba_economics">B.A. Economics</option>
                                                        <option value="ba_anthropology">B.A. Anthropology</option>
                                                        <option value="ba_fine_arts">B.A. Fine Arts</option>
                                                        <option value="ba_music">B.A. Music</option>
                                                        <option value="ba_philosophy">B.A. Philosophy</option>
                                                        <!-- Add more degrees as needed -->
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputUsername1">Institution</label>
                                                    <input type="text" name="institution" class="form-control" id='institution' placeholder="Institution" style="color: gray;" />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputUsername1">Graduation Date</label>
                                                    <input type="date" name="graduation" class="form-control" id='graduation' style="color: gray;" />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputUsername1">Field Of Study</label>
                                                    <select id="feildofstudy" class="form-control" name="feildofstudy" style="color: gray;">
                                                        <option value="biology">Biology</option>
                                                        <option value="chemistry">Chemistry</option>
                                                        <option value="physics">Physics</option>
                                                        <option value="environmental_science">Environmental Science</option>
                                                        <option value="computer_science">Computer Science</option>
                                                        <option value="mathematics">Mathematics</option>
                                                        <!-- Add more options for Science -->

                                                        <option value="civil_engineering">Civil Engineering</option>
                                                        <option value="mechanical_engineering">Mechanical Engineering</option>
                                                        <option value="electrical_engineering">Electrical Engineering</option>
                                                        <option value="computer_engineering">Computer Engineering</option>
                                                        <option value="information_technology">Information Technology</option>
                                                        <option value="software_engineering">Software Engineering</option>
                                                        <!-- Add more options for Engineering and Technology -->

                                                        <option value="psychology">Psychology</option>
                                                        <option value="sociology">Sociology</option>
                                                        <option value="anthropology">Anthropology</option>
                                                        <option value="political_science">Political Science</option>
                                                        <option value="economics">Economics</option>
                                                        <option value="geography">Geography</option>
                                                        <!-- Add more options for Social Sciences -->

                                                        <option value="literature">Literature</option>
                                                        <option value="philosophy">Philosophy</option>
                                                        <option value="languages">Languages</option>
                                                        <option value="history">History</option>
                                                        <option value="cultural_studies">Cultural Studies</option>
                                                        <option value="religion">Religion</option>
                                                        <!-- Add more degrees as needed -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                Job Details
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Job Title</label>
                                                    <select class="form-control" id="jobtitle" name="jobtitle" style="color: gray;">
                                                        <option>Select a job title</option>
                                                        <option>Accountant</option>
                                                        <option>Administrative Assistant</option>
                                                        <option>Business Analyst</option>
                                                        <option>Customer Service Representative</option>
                                                        <option>Data Analyst</option>
                                                        <option>Graphic Designer</option>
                                                        <option>Human Resources Manager</option>
                                                        <option>Marketing Manager</option>
                                                        <option>Project Manager</option>
                                                        <option>Software Developer</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Branch</label>
                                                    <select class="form-control" id="branch" name="branch" style="color: gray;">
                                                        @foreach($branches as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Department</label>
                                                    <select class="form-control" id="department" name="department" style="color: gray;">
                                                        @foreach($departments as $department)
                                                        <option value="{{ $branch->id }}">{{ $department->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputUsername1">Employement Type</label>
                                                    <select class="form-control" id="employeementtype" name="employeementtype" style="color: gray;">
                                                        <option>Full-Time Employment</option>
                                                        <option>Part-Time Employment</option>
                                                        <option>Contractual Employment</option>
                                                        <option>Temporary Employment</option>
                                                        <option>Permanent Employment</option>
                                                        <option>Freelance/Self-Employment</option>
                                                        <option>Internship/Apprenticeship</option>
                                                        <option>Remote/Telecommuting Employment</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputUsername1">Employement Status</label>
                                                    <select class="form-control" id="employeementstatus" name="employeementstatus" style="color: gray;">
                                                        <option>Active</option>
                                                        <option>On Leave</option>
                                                        <option>Terminated</option>
                                                        <option>Retired</option>
                                                        <option>On Probation</option>
                                                        <option>Contract/Temporary</option>
                                                        <option>Suspended</option>
                                                        <option>Part-time/Full-time</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Employement Start Date</label>
                                                    <input type="date" class="form-control" name="employee_start_date" id="employee_start_date" style="color: gray;">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Social Security Number</label>
                                                    <input type="text" class="form-control" name="social_sec_number" id="social_sec_number" style="color: gray;">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Employement History</label>
                                                    <textarea name="employeehistory" class="form-control" id="employeehistory" cols="30" rows="5" style="color: gray;"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputUsername1">Work Shedule</label>
                                                    <select class="form-control" id="workshedule" name="workshedule" style="color: gray;">
                                                        <option value="40h_fulltime">40 Hrs Per Week - Full Time</option>
                                                        <option value="40h_parttime">20 Hrs Per Week - Part Time</option>
                                                        <option value="sh6_2">Shift - 6am - 2pm</option>
                                                        <option value="sh2_10">Shift - 2pm - 10pm</option>
                                                        <option value="sh10_6">Shift - 10pm - 6am</option>
                                                        <option value="weekend">Week End</option>
                                                        <option value="sat_part">Satday Only</option>
                                                        <option value="sun_part">Sunday Only</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">

                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Bank Account No</label>
                                                    <input type="text" class="form-control" name="bank_account_no" id="bank_account_no" style="color: gray;">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Tax Identification No</label>
                                                    <input type="text" class="form-control" name="taxfileno" id="taxfileno" style="color: gray;">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputUsername1">Helth Insurence (Policy No)</label>
                                                    <input type="text" class="form-control" name="helthpolicyno" id="helthpolicyno" style="color: gray;">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                Salary Details
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Basic salary</label>
                                                    <input type="number" class="form-control" name="basic_salary" id="basic_salary" style="color: gray;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Attendance Incentive</label>
                                                    <input type="number" class="form-control" name="atendence_incentive" id="atendence_incentive" style="color: gray;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Commis (5%)</label>
                                                    <input type="number" class="form-control" name="commition" id="commition" style="color: gray;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Other incentives</label>
                                                    <input type="number" class="form-control" name="other_insentive" id="other_insentive" style="color: gray;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">O/T Rate (Per hr)</label>
                                                    <input type="number" class="form-control" name="otrate" id="otrate" style="color: gray;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                Emergency Contacts
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Emergency Contact Name</label>
                                                    <input type="text" class="form-control" name="emergency_contact_name" id="emergency_contact_name" style="color: gray;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Emergency Contact Relationship</label>
                                                    <select id="emergencyRelationship" class="form-control" name="emergencyRelationship" style="color: gray;">
                                                        <option value="parent">Parent</option>
                                                        <option value="sibling">Sibling</option>
                                                        <option value="spouse">Spouse</option>
                                                        <option value="child">Child</option>
                                                        <option value="relative">Relative</option>
                                                        <option value="friend">Friend</option>
                                                        <option value="colleague">Colleague</option>
                                                        <option value="neighbor">Neighbor</option>
                                                        <option value="guardian">Guardian</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Contact No</label>
                                                    <input type="number" class="form-control" name="emergency_contact" id="emergency_contact" style="color: gray;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Contact Address</label>
                                                    <textarea name="contactaddress" id="contactaddress" cols="30" rows="5" class="form-control" style="color: gray;"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Employee File No</label>
                                                    <input type="text" class="form-control" name="employee_file_no" id="employee_file_no" style="color: gray;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;" onclick="refresh()">Close</button>
                                <button type="button" class="btn btn-primary" onclick="upgradeprofile()">Upgrade Profile</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- assign leave model  -->

                <div class="modal fade" id="assign_leave" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="employeeModalLabel"> Mark Employee Leaves</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Place your form here -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">

                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3" style="display: none;">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Emp Id </label>
                                                    <input type="text" name="empidlv " class="form-control" id='empidlv' />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Annual Leave </label>
                                                    <input type="text" name="annual_leave " class="form-control" id='annual_leave' placeholder="Annual Leave" style="color: gray;" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Sick Leave </label>
                                                    <input type="text" name="sick_leave " class="form-control" id='sick_leave' placeholder="Sick Leave" style="color: gray;" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Personal </label>
                                                    <input type="text" name="personal " class="form-control" id='personal' placeholder="Personal" style="color: gray;" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Maternity </label>
                                                    <input type="text" name="maternity " class="form-control" id='maternity' placeholder="Maternity" style="color: gray;" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Parental Leave </label>
                                                    <input type="text" name="parental_leave " class="form-control" id='parental_leave' placeholder="Parental Leave" style="color: gray;" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Bereavement </label>
                                                    <input type="text" name="bereavement " class="form-control" id='bereavement' placeholder="Bereavement" style="color: gray;" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Unpaid Leave </label>
                                                    <input type="text" name="unpaid_leave " class="form-control" id='unpaid_leave' placeholder="Unpaid Leave" style="color: gray;" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Special Leave </label>
                                                    <input type="text" name="special_leave " class="form-control" id='special_leave' placeholder="Special Leave" style="color: gray;" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;" onclick="refresh()">Close</button>
                                <button type="button" class="btn btn-primary" onclick="assignLeave()">Assign Leave</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End  -->

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</x-app-layout>

<script>
    function upgradeprofile() {
        var empid = $('#employeeides').html();
        var phone_number = $('#phone_number').val();
        var address = $('#address').val();
        var maritalstatus = $('#maritalstatus').val();
        var reported_manager = $('#reported_manager').val();
        var highest_education = $('#higheducation').val();
        var degree = $('#degree').val();
        var institution = $('#institution').val();
        var graduation = $('#graduation').val();
        var feildofstudy = $('#feildofstudy').val();
        var jobtitle = $('#jobtitle').val();
        var branch = $('#branch').val();
        var department = $('#department').val();
        var employeementtype = $('#employeementtype').val();
        var social_sec_number = $('#social_sec_number').val();
        var employeementstatus = $('#employeementstatus').val();
        var employee_start_date = $('#employee_start_date').val();
        var employeehistory = $('#employeehistory').val();
        var workshedule = $('#workshedule').val();
        var bank_account_no = $('#bank_account_no').val();
        var taxfileno = $('#taxfileno').val();
        var helthpolicyno = $('#helthpolicyno').val();
        var basic_salary = $('#basic_salary').val();
        var atendence_incentive = $('#atendence_incentive').val();
        var commition = $('#commition').val();
        var other_insentive = $('#other_insentive').val();
        var emergency_contact_name = $('#emergency_contact_name').val();
        var emergency_contact = $('#emergency_contact').val();
        var emergencyRelationship = $('#emergencyRelationship').val();
        var contactaddress = $('#contactaddress').val();
        var employee_file_no = $('#employee_file_no').val();
        var otrate = $('#otrate').val();



        if (empid === "" || phone_number === "" || address === "" || maritalstatus === "" || reported_manager === "" || highest_education === "" || social_sec_number === "" || degree === "" || institution === "" || graduation === "" || feildofstudy === "" || jobtitle === "" || branch === "" || department === "" || employeementtype === "" || employeementstatus === "" || employee_start_date === "" || employeehistory === "" || workshedule === "" || bank_account_no === "" || taxfileno === "" || helthpolicyno === "" || basic_salary === "" || atendence_incentive === "" || commition === "" || other_insentive === "" || emergency_contact === "" || emergencyRelationship === "" || contactaddress === "" || employee_file_no === "" || otrate === "") {
            // Alert the user or handle the error as needed
            alert("Please fill in all the required fields.");
            return;
        } else {

            var data = {
                empid: empid,
                phone_number: phone_number,
                address: address,
                maritalstatus: maritalstatus,
                reported_manager: reported_manager,
                highest_education: highest_education,
                degree: degree,
                institution: institution,
                graduation: graduation,
                feildofstudy: feildofstudy,
                jobtitle: jobtitle,
                branch: branch,
                department: department,
                employeementtype: employeementtype,
                employeementstatus: employeementstatus,
                employee_start_date: employee_start_date,
                employeehistory: employeehistory,
                workshedule: workshedule,
                bank_account_no: bank_account_no,
                taxfileno: taxfileno,
                helthpolicyno: helthpolicyno,
                basic_salary: basic_salary,
                atendence_incentive: atendence_incentive,
                commition: commition,
                other_insentive: other_insentive,
                emergency_contact: emergency_contact,
                emergencyRelationship: emergencyRelationship,
                contactaddress: contactaddress,
                employee_file_no: employee_file_no,
                social_sec_number: social_sec_number,
                emergency_contact_name: emergency_contact_name,
                otrate: otrate
            };

            // Send the data using AJAX
            $.ajax({
                url: 'updateEmployee',
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
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
    }

    function setempidforleave(empid) {
        $('#empidlv').val(empid);
    }

    function assignLeave() {
        var empid = $('#empidlv').val();
        var annual_leave = $('#annual_leave').val();
        var sick_leave = $('#sick_leave').val();
        var personal = $('#personal').val();
        var maternity = $('#maternity').val();
        var parental_leave = $('#parental_leave').val();
        var bereavement = $('#bereavement').val();
        var unpaid_leave = $('#unpaid_leave').val();
        var special_leave = $('#special_leave').val();

        if (annual_leave === "" || sick_leave === "" || personal === "" || maternity === "" || parental_leave === "" || bereavement === "" || unpaid_leave === "" || special_leave === "") {
            // At least one of the variables is empty
            alert("One or more leave variables are empty.");
        } else {
            // All variables have values
            // Proceed with further actions
            console.log(special_leave);
            var data = {
                empid: empid,
                annual_leave: annual_leave,
                sick_leave: sick_leave,
                personal: personal,
                maternity: maternity,
                parental_leave: parental_leave,
                bereavement: bereavement,
                unpaid_leave: unpaid_leave,
                special_leave: special_leave
            };

            $.ajax({
                url: 'saveEmpsalary',
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
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


    }

    function setEmployeeData(employeeId) {
        $.ajax({
            url: '/getEmployeeDetails',
            type: 'GET',
            data: {
                employeeId: employeeId,
            },
            success: function(response) {
                // console.log("ID:", response.id);
                // console.log("NIC:", response.nic);
                // console.log("Full Name:", response.fullName);
                // console.log("Date of Birth:", response.dateOfBirth);
                // console.log("Gender:", response.gender);
                document.getElementById('employeeides').innerHTML = response.employeeID;
                document.getElementById('emailes').innerHTML = response.email;
                document.getElementById('phone_number').value = response.phoneNumber;
                document.getElementById('maritalstatus').value = response.maritalStatus;
                document.getElementById('reported_manager').value = response.manager;
                document.getElementById('higheducation').value = response.highestEducation;
                document.getElementById('degree').value = response.degree;
                document.getElementById('institution').value = response.institution;
                document.getElementById('graduation').value = response.graduationDate;
                document.getElementById('feildofstudy').value = response.fieldOfStudy;
                document.getElementById('jobtitle').value = response.jobTitle;
                document.getElementById('branch').value = response.branch;
                document.getElementById('department').value = response.department;
                document.getElementById('employeementtype').value = response.employmentType;
                document.getElementById('employeementstatus').value = response.employmentStatus;
                document.getElementById('employee_start_date').value = response.startDate;
                document.getElementById('social_sec_number').value = response.socialSecurityNumber;
                document.getElementById('employeehistory').value = response.employmentHistory;
                document.getElementById('workshedule').value = response.workSchedule;
                document.getElementById('bank_account_no').value = response.bankAccount;
                document.getElementById('taxfileno').value = response.taxInformation;
                document.getElementById('helthpolicyno').value = response.healthInsurance;
                document.getElementById('basic_salary').value = response.basicsalary;
                document.getElementById('otrate').value = response.otrate;
                document.getElementById('atendence_incentive').value = response.attendentsIncentive;
                document.getElementById('commition').value = response.commis;
                document.getElementById('other_insentive').value = response.otherinvsentive;
                document.getElementById('address').value = response.address;

                document.getElementById('emergency_contact_name').value = response.emergencyContactName;
                document.getElementById('emergencyRelationship').value = response.emergencyContactRelationship;
                document.getElementById('emergency_contact').value = response.emergencyContactPhone;
                document.getElementById('contactaddress').value = response.emergencyContactAddress;
                document.getElementById('employee_file_no').value = response.address;

            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    }

    function refresh() {
        location.reload();
    }

    function loadCv(candidateId) {
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



    function deleteEmployee() {
        var employeeid = document.getElementById('deleteid').innerHTML;

        $.ajax({
            url: '/deleteEmployee',
            type: 'GET',
            data: {
                employeeid: employeeid,
            },
            success: function(response) {
                location.reload();
            }
        });
    }

    function setEmployeeId(employeeid) {
        document.getElementById('deleteid').innerHTML = employeeid;
    }
</script>