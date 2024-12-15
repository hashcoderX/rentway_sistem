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
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Completed Interviews (Qulified Candidates)</h4>
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
                                                    <th> Candidate Name </th>
                                                    <th> Interview No </th>
                                                    <th> Subject </th>
                                                    <th> Decision </th>
                                                    <th> F/Interviewer </th>
                                                    <th> S/Interviwer </th>
                                                    <th> Start Date Time </th>
                                                    <th> Interview Status </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($interviews as $interview)
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-muted m-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input">
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <!-- <img src="assets/images/faces/face1.jpg" alt="image"> -->
                                                        <span class="pl-2">{{ $interview->candidate->name }}</span>
                                                    </td>
                                                    <td> {{ $interview->id }} </td>
                                                    <td> {{ $interview->candidate->interview_stage }} </td>
                                                    <th> {{ $interview->remark }} </th>
                                                    <td> {{ $interview->firstInterviewer->fullName }} </td>
                                                    <td> {{ $interview->secondInterviewer->fullName }} </td>
                                                    <td> {{ $interview->interviewdate . ' ' .$interview->interviewtime }} </td>
                                                    <td>
                                                        <div class="badge badge-outline-success">{{ $interview->interview_stage }}</div>
                                                        <button class="badge badge-outline-primary" id="{{ $interview->candidate->id }}" onclick="setcandidateid(this.id)" data-bs-toggle="modal" data-bs-target="#sheduleinterview">Shedule New Interview</button>
                                                        <button class="badge badge-outline-primary" id="{{ $interview->candidate->id }}" onclick="turntoemployee(this.id)">Turn To Employee</button>
                                                    </td>

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

                <!-- compleat Interview  -->


                <!-- End  -->

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>



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
                            <input type="text" class="form-control" id="interviewtopic" name="interviewtopic" style="color:gray;" placeholder="Interview Topic">
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
</x-app-layout>

<script>
    function getInterviewDetails(interviewid) {

    }

    function setcandidateid(candidateid) {
        $('#candidateidbyinterview').val(candidateid);
    }


    function turntoemployee(id) {
        var formData = {
            candidateId: id,
        };

        $.ajax({
            url: '/turntoemployee',
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




            },
            error: function(xhr, status, error) {
                // Handle error response
                // console.error("Error scheduling interview:", error);
                // Optionally, you can display an error message or perform other actions here
            }
        });

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

    function setInterviewId(id) {
        document.getElementById('interviewid').value = id;
    }
</script>