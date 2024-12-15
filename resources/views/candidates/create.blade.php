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
                                    <h4 class="card-title">Create New Candidate</h4>

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

                                    <form class="forms-sample" action="/savecandidates" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Candidate Name</label>
                                            <input type="text" class="form-control" id="candidatename" name="candidatename" placeholder="Candidate full name" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">NIC</label>
                                            <input type="text" class="form-control" id="nic" name="nic" placeholder="NIC" maxlength="12" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date Of Birth</label>
                                            <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" placeholder="Date Of Birth" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Req Possition</label>
                                            <input type="text" class="form-control" id="possition" name="possition" placeholder="Possition" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">How many years experience do have</label>
                                            <input type="number" class="form-control" id="experiance" name="experiance" placeholder="Experiance years" style="color:gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">CV</label>
                                            <input type="file" class="form-control" id="cv" name="cv" placeholder="Uploade CV">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea class="form-control" id="description" name="description" cols="30" rows="10" style="color:gray;"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                                        <button class="btn btn-dark">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Our Candidates</h4>
                                        <p class="text-muted mb-1">Actions</p>
                                        <p class="text-muted mb-1">Important data Sets</p>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach($candidates as $candidate)
                                            <div class="preview-list">
                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $candidate->name }}</h6>
                                                            <p class="text-muted mb-0">{{ $candidate->possition }}</p>
                                                            <div class="row">
                                                                <button type="button" class="btn btn-inverse-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deletecv" id="{{ $candidate->id }}" onclick="setCandidateId(this.id)">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-inverse-primary btn-icon" id="{{ $candidate->id }}" onclick="getCandidateDetails(this.id)" data-bs-toggle="modal" data-bs-target="#candateupdate">
                                                                    <i class="mdi mdi-update"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow">
                                                            <button class="btn btn-outline-primary btn-fw" data-bs-toggle="modal" id="{{ $candidate->id }}" data-bs-target="#viewcv" onclick="loadCv(this.id)">View CV</button>
                                                            <p class="text-muted mt-1">{{ $candidate->interview_stage }}</p>
                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <p class="text-muted"> Year of Expeiance -{{ $candidate->experiance }}</p>
                                                            <p class="text-muted mt-1">{{ $candidate->phonenumber }}</p>
                                                            <button id="{{ $candidate->id }}" class="btn btn-outline-info btn-fw" data-bs-toggle="modal" data-bs-target="#sheduleinterview" onclick="setcandidateId(this.id)">Shedule Interview</button>
                                                        </div>
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

                    <!-- shedule interview  -->
                    <div class="modal fade" id="sheduleinterview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5>Shedule Interview</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div id="success-message"></div>
                                </div>

                                <div class="modal-body">
                                    <div class="massage_display" id="massage_display"></div>
                                    <div id="updateForm" class="forms-sample" enctype="multipart/form-data" style="color: gray;">
                                        <div class="form-group" style="display: none;">
                                            <label for="exampleInputUsername1">Id</label>
                                            <input type="text" class="form-control" id="candidateidbyinterview" name="candidateidbyinterview" style="color:gray;" placeholder="Candidate full name" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Interview Topic</label>
                                            <select name="interviewtopic" id="interviewtopic" class="form-control">
                                                <option value="HR Interview">HR Interview</option>
                                                <option value="2nd Interview">2nd Interview</option>
                                                <option value="3nd Interview">3rd Interview</option>
                                            </select>
                                            <!-- <input type="text" class="form-control" id="interviewtopic" name="interviewtopic" style="color:gray;" placeholder="Interview Topic"> -->
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date</label>
                                            <input type="date" class="form-control" id="interviewdate" name="interviewdate" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Time</label>
                                            <input type="time" class="form-control" id="interviewtime" name="interviewtime" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">First Interviewer</label>

                                            <select name="first_interviewer" id="first_interviewer" class="form-control">
                                                <option value="na">N/A</option>
                                                @foreach ($interviewEmployees as $interviewer)
                                                <option value="{{ $interviewer->id }}">{{ $interviewer->fullName }} - {{ $interviewer->jobTitle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Secound Interviewer</label>
                                            <select name="secound_interviwer" id="secound_interviwer" class="form-control">
                                                <option value="na">N/A</option>
                                                @foreach ($interviewEmployees as $interviewer)
                                                <option value="{{ $interviewer->id }}">{{ $interviewer->fullName }} - {{ $interviewer->jobTitle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Third Interviewer</label>
                                            <select name="third_interviwer" id="third_interviwer" class="form-control">
                                                <option value="na">N/A</option>
                                                @foreach ($interviewEmployees as $interviewer)
                                                <option value="{{ $interviewer->id }}">{{ $interviewer->fullName }} - {{ $interviewer->jobTitle }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meeting Link</label>
                                            <textarea name="meeting_link" id="meeting_link" cols="30" rows="10" class="form-control"></textarea>
                                        </div>

                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary mr-2" onclick="shedulInterview()">Shedul Interview</button>
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end  -->

                    <!-- view Cv  -->
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
                                    <p>Are you sure you want to delete this Candidate?</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="deleteCv()">Delete</button>
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end  -->

                    <div class="modal fade" id="candateupdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div id="success-message"></div>

                                </div>
                                <div class="modal-body">
                                    <form id="updateForm" class="forms-sample" enctype="multipart/form-data" style="color: gray;">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Id</label>
                                            <input type="text" class="form-control" id="candidateided" name="candidateided" style="color:gray;" placeholder="Candidate full name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Candidate Name</label>
                                            <input type="text" class="form-control" id="candidatenameed" name="candidatenameed" style="color:gray;" placeholder="Candidate full name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="emailed" name="emailed" placeholder="Email" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">NIC</label>
                                            <input type="text" class="form-control" id="niced" name="niced" placeholder="NIC" maxlength="12" style="color:gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_numbered" name="phone_numbered" style="color:gray;" placeholder="Phone Number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date Of Birth</label>
                                            <input type="date" class="form-control" id="dateofbirthed" name="dateofbirthed" style="color:gray;" placeholder="Date Of Birth">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Req Possition</label>
                                            <input type="text" class="form-control" id="possitioned" name="possitioned" style="color:gray;" placeholder="Position">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">How many years experience do you have</label>
                                            <input type="number" class="form-control" id="experianceed" name="experianceed" style="color:gray;" placeholder="Experience years">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">CV</label>
                                            <input type="file" class="form-control" id="cved" name="cved">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea class="form-control" id="descriptioned" name="descriptioned" style="color:gray;" cols="30" rows="10"></textarea>
                                        </div>
                                        <button type="button" class="btn btn-primary mr-2" onclick="updateCandidate()">Update</button>
                                        <button type="button" class="btn btn-dark" onclick="refresh()">Cancel</button>
                                    </form>
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
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

<script>
    function setcandidateId(id) {
        document.getElementById('candidateidbyinterview').value = id;
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

    function getCandidateDetails(candidateId) {
        $.ajax({
            url: '/getCandidateDetails',
            type: 'GET',
            data: {
                candidateId: candidateId,
            },
            success: function(response) {
                // Populate the form fields with the retrieved data
                $('#candidatenameed').val(response.name);
                $('#emailed').val(response.email);
                $('#niced').val(response.nic);
                $('#phone_numbered').val(response.phonenumber);
                $('#dateofbirthed').val(response.dob);
                $('#possitioned').val(response.possition);
                $('#experianceed').val(response.experiance);
                $('#descriptioned').val(response.description);
                $('#candidateided').val(response.id);
                // You can continue populating other fields similarly

                // Show the form after populating the data
                $('#updateForm').show();
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


    function shedulInterview() {
        var candidateidbyinterview = $('#candidateidbyinterview').val();
        var interviewtopic = $('#interviewtopic').val();
        var interviewdate = $('#interviewdate').val();
        var interviewtime = $('#interviewtime').val();
        var first_interviewer = $('#first_interviewer').val();
        var secound_interviwer = $('#secound_interviwer').val();
        var third_interviwer = $('#third_interviwer').val();
        var meeting_link = $('#meeting_link').val();

        if (!candidateidbyinterview || !interviewtopic || !interviewdate || !interviewtime || !first_interviewer || !secound_interviwer || !third_interviwer) {
            // At least one of the variables is empty
            // console.log("One or more fields are empty.");
        } else {
            // All variables have values
            // console.log("All fields have values.");
            var formData = {
                candidateId: candidateidbyinterview,
                topic: interviewtopic,
                date: interviewdate,
                time: interviewtime,
                first_interviewer: first_interviewer,
                secound_interviwer: secound_interviwer,
                third_interviwer: third_interviwer,
                meeting_link: meeting_link,
            };

            // Send an AJAX request
            $.ajax({
                url: '/scheduleInterview',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success response
                    // console.log("Interview scheduled successfully.");
                    // Optionally, you can redirect or perform other actions here
                    // var code = parseInt(response.code);
                    // console.log(code);

                    var notificationElement = document.getElementById('massage_display');


                    if (response.status == "200") {
                        var alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-success';
                        alertDiv.id = 'successalert';
                        alertDiv.innerText = response.message;
                        notificationElement.appendChild(alertDiv);

                        var interviewid = response.meetingid;

                        // window.location.href = '/sheduledinterview/' + interviewid;  
                        window.location.href = '/interviews'; 
                    }

                    if (response.status == '201') {
                        var alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-danger';
                        alertDiv.id = 'successalert';
                        alertDiv.innerText = response.message;

                        notificationElement.appendChild(alertDiv);
                    }


                },
                error: function(xhr, status, error) {
                    // Handle error response
                    // console.error("Error scheduling interview:", error);
                    // Optionally, you can display an error message or perform other actions here
                }
            });

        }
    }
</script>