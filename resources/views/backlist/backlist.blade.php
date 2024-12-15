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
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add Blacklister</h4>

                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <form class="forms-sample" action="/saveblacklister" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- <div class="form-group">
                                            <label for="exampleInputUsername1">Employee ID</label>
                                            <input type="text" class="form-control" id="employee_id" name="employee_id" style="color: gray;" placeholder="CA7800">
                                        </div> -->
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Backlister Full Name</label>
                                            <input type="text" class="form-control" id="customername" name="customername" style="color: gray;" placeholder="Customer full name">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">NIC</label>
                                            <input type="text" class="form-control" id="nic" name="nic" placeholder="NIC" maxlength="12" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">City</label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Telephone Number</label>
                                            <input type="text" class="form-control" id="telephone_number" name="telephone_number" placeholder="Telephone Number" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Customer Photo</label>
                                            <input type="file" class="form-control" id="customerphoto" name="customerphoto" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Driving Licen</label>
                                            <input type="file" class="form-control" id="drivinglicensephoto" name="drivinglicensephoto" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Living Verification</label>
                                            <input type="file" class="form-control" id="livingverification" name="livingverification" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Type Of Damage</label>
                                            <select name="typeofdamage" id="typeofdamage" class="form-control">
                                                <option value="Accident">Accident</option>
                                                <option value="Theft">Theft</option>
                                                <option value="Payment Issue">Payment Issue</option>
                                                <option value="Drunken Driving Case">Drunken Driving Case</option>
                                                <option value="Fake Document">Fake Document</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Damage Verification Report</label>
                                            <input type="file" class="form-control" id="damageverification" name="damageverification" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" style="color: gray;"></textarea>
                                        </div>

                                        <button class="btn btn-dark">Cancel</button>
                                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Customer</h4>
                                        <p class="text-muted mb-1">Actions</p>
                                        <p class="text-muted mb-1">Important data Sets</p>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach($myblacklisters as $myblacklister)
                                            <div class="preview-list">
                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $myblacklister->full_name   }}</h6>
                                                            <p class="text-muted mb-0">{{ $myblacklister->telephone_no }}</p>
                                                            <p class="text-muted mb-0">{{ $myblacklister->nic }}</p>
                                                            <div class="row">

                                                            </div>
                                                        </div>
                                                        <div class="flex-grow">

                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">

                                                            <p class="text-muted mt-1">Registerd Date{{ $myblacklister->reg_date }}</p>
                                                            <button class="btn btn-success" onclick="viewinquary('{{ $myblacklister->nic }}')" data-bs-toggle="modal" data-bs-target="#viewinquary">View Inquary</button>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <a href="/clientlists" class="btn btn-outline-primary btn-fw">Load all Customers</a>
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

        <!-- Modal -->
        <div class="modal fade" id="viewinquary" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">View Inquary</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="viewdetails" id="viewdetails"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>

<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>



<script>
    function viewinquary(nic) {
        $.ajax({
            url: '/getblacklisterdetails',
            type: 'GET',
            data: {
                nic: nic,
            },
            success: function(response) {
                if (response.html) {
                    document.querySelector('.viewdetails').innerHTML = response.html;
                }
            }
        });
    }

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



        if (empid === "" || phone_number === "" || address === "" || maritalstatus === "" || reported_manager === "" || highest_education === "" || social_sec_number === "" || degree === "" || institution === "" || graduation === "" || feildofstudy === "" || jobtitle === "" || branch === "" || department === "" || employeementtype === "" || employeementstatus === "" || employee_start_date === "" || employeehistory === "" || workshedule === "" || bank_account_no === "" || taxfileno === "" || helthpolicyno === "" || basic_salary === "" || atendence_incentive === "" || commition === "" || other_insentive === "" || emergency_contact === "" || emergencyRelationship === "" || contactaddress === "" || employee_file_no === "") {
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