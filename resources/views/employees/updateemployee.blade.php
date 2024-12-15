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

            <!-- main-panel ends -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Genaral Informaiton
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Empolyee ID - </label>
                                        <lable id="employeeides">{{ $employee->id }}</lable> <br>
                                        <lable id="emailes" style="color: #ce6701;font-size: 13px;">{{ $employee->email }}</lable>
                                        <!-- <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"> -->
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control" id='phone_number' placeholder="Phone Number" style="color: gray;" value="{{ $employee->phoneNumber }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                        <textarea class="form-control" name="address" id='address' rows="10" style="color: gray;">{{ $employee->address }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1">Marital Status</label>
                                        <select class="form-control" id="maritalstatus" name="maritalstatus" style="color: gray;">
                                            <option value="Single" {{ $employee->maritalStatus === 'Single' ? 'selected' : '' }}>Single</option>
                                            <option value="Merried" {{ $employee->maritalStatus === 'Merried' ? 'selected' : '' }}>Merried</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    Reporting
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
                                            @foreach($staffLevels as $staffLevel)
                                            <option value="{{ $staffLevel->lvl }}">{{ $staffLevel->description }}</option>
                                            @endforeach
                                        </select>
                                        <!-- <input type="text" name="phone_number" class="form-control" id='phone_number' placeholder="Phone Number" /> -->
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
                                        <label for="exampleFormControlTextarea1" class="form-label"> Job Title - {{ $employee->jobTitle }}</label>
                                        <select class="form-control" id="jobtitle" name="jobtitle" style="color: gray;">

                                            <option {{ $employee->jobTitle === 'Chief Executive Officer' ? 'selected' : '' }}>Chief Executive Officer</option>
                                            <option {{ $employee->jobTitle === 'Managing Director' ? 'selected' : '' }}>Managing Director</option>
                                            <option {{ $employee->jobTitle === 'Manager' ? 'selected' : '' }}>Manager</option>
                                            <option {{ $employee->jobTitle === 'Marketing Manager' ? 'selected' : '' }}>Marketing Manager</option>
                                            <option {{ $employee->jobTitle === 'Marketing Coordinator' ? 'selected' : '' }}>Marketing Coordinator</option>
                                            <option {{ $employee->jobTitle === 'Finance Manager' ? 'selected' : '' }}>Finance Manager</option>
                                            <option {{ $employee->jobTitle === 'Accountant' ? 'selected' : '' }}>Accountant</option>
                                            <option {{ $employee->jobTitle === 'Office Manager' ? 'selected' : '' }}>Office Manager</option>
                                            <option {{ $employee->jobTitle === 'Business Analyst' ? 'selected' : '' }}>Business Analyst</option>
                                            <option {{ $employee->jobTitle === 'Chief Operating Officer' ? 'selected' : '' }}>Chief Operating Officer</option>
                                            <option {{ $employee->jobTitle === 'Presidentr' ? 'selected' : '' }}>President</option>
                                            <option {{ $employee->jobTitle === 'Chief Marketing Officer' ? 'selected' : '' }}>Chief Marketing Officer</option>
                                            <option {{ $employee->jobTitle === 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                            <option {{ $employee->jobTitle === 'Chief Financial Officer' ? 'selected' : '' }}>Chief Financial Officer</option>
                                            <option {{ $employee->jobTitle === 'Product Manager' ? 'selected' : '' }}>Product Manager</option>
                                            <option {{ $employee->jobTitle === 'Human Resources Manager' ? 'selected' : '' }}>Human Resources Manager</option>
                                            <option {{ $employee->jobTitle === 'Executive Assistant' ? 'selected' : '' }}>Executive Assistant</option>
                                            <option {{ $employee->jobTitle === 'Vice president' ? 'selected' : '' }}>Vice president</option>
                                            <option {{ $employee->jobTitle === 'Sales' ? 'selected' : '' }}>Sales</option>
                                            <option {{ $employee->jobTitle === 'Administrative Assistant' ? 'selected' : '' }}>Administrative Assistant</option>
                                            <option {{ $employee->jobTitle === 'Chief Technology Officer' ? 'selected' : '' }}>Chief Technology Officer</option>
                                            <option {{ $employee->jobTitle === 'Call center Supervisor' ? 'selected' : '' }}>Call center Supervisor</option>
                                            <option {{ $employee->jobTitle === 'Customer Service Representative' ? 'selected' : '' }}>Customer Service Representative</option>
                                            <option {{ $employee->jobTitle === 'Bookkeeper' ? 'selected' : '' }}>Bookkeeper</option>
                                            <option {{ $employee->jobTitle === 'Chief Information Officer' ? 'selected' : '' }}>Chief Information Officer</option>
                                            <option {{ $employee->jobTitle === 'Account Executive' ? 'selected' : '' }}>Account Executive</option>
                                            <option {{ $employee->jobTitle === 'Graphic Designer' ? 'selected' : '' }}>Graphic Designer</option>
                                            <option {{ $employee->jobTitle === 'Data Analyst' ? 'selected' : '' }}>Data Analyst</option>
                                            <option {{ $employee->jobTitle === 'Project Manager' ? 'selected' : '' }}>Project Manager</option>
                                            <option {{ $employee->jobTitle === 'Software Developer' ? 'selected' : '' }}>Software Developer</option>
                                            <option {{ $employee->jobTitle === 'Engineer' ? 'selected' : '' }}>Engineer</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Branch - {{ $employee->branch }}</label>
                                        <select class="form-control" id="branch" name="branch" style="color: gray;">
                                            @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Department - {{ $employee->department }}</label>
                                        <select class="form-control" id="department" name="department" style="color: gray;">
                                            @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputUsername1">Employement Type </label>
                                        <select class="form-control" id="employeementtype" name="employeementtype" style="color: gray;">
                                            <option {{ $employee->employmentType === 'Full-Time Employment' ? 'selected' : '' }}>Full-Time Employment</option>
                                            <option {{ $employee->employmentType === 'Part-Time Employment' ? 'selected' : '' }}>Part-Time Employment</option>
                                            <option {{ $employee->employmentType === 'Contractual Employment' ? 'selected' : '' }}>Contractual Employment</option>
                                            <option {{ $employee->employmentType === 'Temporary Employment' ? 'selected' : '' }}>Temporary Employment</option>
                                            <option {{ $employee->employmentType === 'Permanent Employment' ? 'selected' : '' }}>Permanent Employment</option>
                                            <option {{ $employee->employmentType === 'Freelance/Self-Employment' ? 'selected' : '' }}>Freelance/Self-Employment</option>
                                            <option {{ $employee->employmentType === 'Internship/Apprenticeship' ? 'selected' : '' }}>Internship/Apprenticeship</option>
                                            <option {{ $employee->employmentType === 'Remote/Telecommuting Employment' ? 'selected' : '' }}>Remote/Telecommuting Employment</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputUsername1">Employement Status - {{ $employee->employmentStatus }}</label>
                                        <select class="form-control" id="employeementstatus" name="employeementstatus" style="color: gray;">
                                            <option {{ $employee->employmentStatus === 'Active' ? 'selected' : '' }}>Active</option>
                                            <option {{ $employee->employmentStatus === 'On Leave' ? 'selected' : '' }}>On Leave</option>
                                            <option {{ $employee->employmentStatus === 'Terminated' ? 'selected' : '' }}>Terminated</option>
                                            <option {{ $employee->employmentStatus === 'Retired' ? 'selected' : '' }}>Retired</option>
                                            <option {{ $employee->employmentStatus === 'On Probation' ? 'selected' : '' }}>On Probation</option>
                                            <option {{ $employee->employmentStatus === 'Contract/Temporary' ? 'selected' : '' }}>Contract/Temporary</option>
                                            <option {{ $employee->employmentStatus === 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                            <option {{ $employee->employmentStatus === 'Part-time/Full-time' ? 'selected' : '' }}>Part-time/Full-time</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Employement Start Date</label>
                                        <input type="date" class="form-control" name="employee_start_date" id="employee_start_date" style="color: gray;" value="{{ $employee->startDate }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Social Security Number</label>
                                        <input type="text" class="form-control" name="social_sec_number" id="social_sec_number" style="color: gray;" value="{{ $employee->socialSecurityNumber }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Employement History</label>
                                        <textarea name="employeehistory" class="form-control" id="employeehistory" cols="30" rows="5" style="color: gray;">{{ $employee->employmentHistory }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputUsername1">Work Shedule - {{ $employee->workSchedule }}</label>
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
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Emergency Contacts
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Emergency Contact Name</label>
                                        <input type="text" class="form-control" name="emergency_contact_name" id="emergency_contact_name" style="color: gray;" value="{{ $employee->emergencyContactName }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Emergency Contact Relationship - {{ $employee->emergencyContactRelationship }}</label>
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
                                        <input type="number" class="form-control" name="emergency_contact" id="emergency_contact" style="color: gray;" value="{{ $employee->emergencyContactPhone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Contact Address</label>
                                        <textarea name="contactaddress" id="contactaddress" cols="30" rows="4" class="form-control" style="color: gray;">{{ $employee->emergencyContactAddress }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Employee File No</label>
                                        <input type="text" class="form-control" name="employee_file_no" id="employee_file_no" style="color: gray;" value="{{ $employee->emp_file_no }}">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Bank Details
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Bank Account No</label>
                                        <input type="text" class="form-control" name="bank_account_no" id="bank_account_no" style="color: gray;" value="{{ $employee->bankAccount }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Tax Identification No</label>
                                        <input type="text" class="form-control" name="taxfileno" id="taxfileno" style="color: gray;" value="{{ $employee->taxInformation }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputUsername1">Helth Insurence (Policy No)</label>
                                        <input type="text" class="form-control" name="helthpolicyno" id="helthpolicyno" style="color: gray;" value="{{ $employee->healthInsurance }}">
                                    </div>
                                </div>
                            </div>

                            <div class="button-container">
                                <button class="btn btn-primary">Back</button>
                                <button class="btn btn-success" onclick="updatemidlevelforemployee()">Next</button>
                            </div>


                        </div>
                    </div>

                </div>
                <!-- page-body-wrapper ends -->


            </div>



</x-app-layout>


<!-- Modal -->


<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>



<script>
    function updatemidlevelforemployee() {
        var empid = $('#employeeides').html();
        var phone_number = $('#phone_number').val();
        var address = $('#address').val();
        var maritalstatus = $('#maritalstatus').val();
        var reported_manager = $('#reported_manager').val();

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

        var emergency_contact_name = $('#emergency_contact_name').val();
        var emergency_contact = $('#emergency_contact').val();
        var emergencyRelationship = $('#emergencyRelationship').val();
        var contactaddress = $('#contactaddress').val();
        var employee_file_no = $('#employee_file_no').val();

        var data = {
            empid: empid,
            phone_number: phone_number,
            address: address,
            maritalstatus: maritalstatus,
            reported_manager: reported_manager,
            social_sec_number:social_sec_number,

            jobtitle: jobtitle,
            branch: branch,
            department: department,

            employeementtype: employeementtype,
            employeementstatus: employeementstatus,
            employee_start_date: employee_start_date,
            employeehistory: employeehistory,
            workshedule: workshedule,

            emergency_contact: emergency_contact,
            emergencyRelationship: emergencyRelationship,
            contactaddress: contactaddress,
            employee_file_no: employee_file_no,
            emergency_contact_name: emergency_contact_name,

            bank_account_no: bank_account_no,
            taxfileno: taxfileno,
            helthpolicyno: helthpolicyno,

        };


        var variables = [
            empid,
            phone_number,
            address,
            maritalstatus,
            reported_manager,
            jobtitle,
            branch,
            department,
            employeementtype,
            social_sec_number,
            employeementstatus,
            employee_start_date,
            employeehistory,
            workshedule,
            bank_account_no,
            taxfileno,
            helthpolicyno,
            emergency_contact_name,
            emergency_contact,
            emergencyRelationship,
            contactaddress,
            employee_file_no
        ];

        // Variable to track if any variable is empty
        var isEmpty = false;

        // Loop through the variables array
        for (var i = 0; i < variables.length; i++) {
            // Check if the current variable is empty
            if (variables[i] === "") {
                isEmpty = true;
                // If any variable is empty, break out of the loop
                break;
            }
        }

        // Check if any variable is empty
        if (isEmpty) {
            alert("Please fill in all the required fields.");
        } else {
            $.ajax({
                url: '/firstupdateEmployee',
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var empid = response.data.id;
                    window.location.href = '/secoundemployeeupdate/' + empid;
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);
                    // Optionally, you can display an error message to the user
                }
            });
        }


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

    function deleteCv() {
        var candidateId = document.getElementById('deleteid').innerHTML;

        $.ajax({
            url: '/deleteCandidate',
            type: 'GET',
            data: {
                candidateId: candidateId,
            },
            success: function(response) {
                location.reload();
            }
        });
    }

    function setCandidateId(candidateId) {
        document.getElementById('deleteid').innerHTML = candidateId;
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

    function updateCandidate() {
        var formData = new FormData($('#updateForm')[0]);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: '/updateCandidate',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                console.log(response);
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
</script>