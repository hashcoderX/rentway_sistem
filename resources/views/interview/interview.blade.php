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
                                    <h4 class="card-title">Sheduled Interviews</h4>
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
                                                    <th> F/Interviwer </th>
                                                    <th> S/Interviwer </th>
                                                    <th> Start Date Time </th>
                                                    <th> Interview Status </th>
                                                    <th> Action </th>
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
                                                    <td> {{ $interview->about_interview }} </td>
                                                    <td> {{ $interview->firstInterviewer->fullName }} </td>
                                                    <td> {{ $interview->secondInterviewer->fullName }} </td>
                                                    <td> {{ $interview->interviewdate . ' ' .$interview->interviewtime }} </td>
                                                    <td>
                                                        <div class="badge badge-outline-danger">{{ $interview->interview_stage }}</div>
                                                    </td>
                                                    <td>

                                                        <button id="{{ $interview->id }}" class="badge badge-outline-primary" data-bs-toggle="modal" data-bs-target="#compleatInterview" onclick="setInterviewId(this.id)">Complete Interview</button>


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

                <div class="modal fade" id="compleatInterview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5>Complete interview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div id="success-message"></div>
                            </div>

                            <div class="modal-body">
                                <div class="massage_display" id="massage_display"></div>
                                <div id="updateForm" class="forms-sample" enctype="multipart/form-data" style="color: gray;">
                                    <div class="form-group" style="display:none;">
                                        <label for="exampleInputUsername1">Id</label>
                                        <input type="text" class="form-control" id="interviewid" name="interviewid" style="color:gray;" placeholder="Candidate full name" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Change Subject</label>
                                        <!-- <input type="date" class="form-control" id="interviewdate" name="interviewdate" style="color:gray;"> -->
                                        <select name="subject" id="subject" class="form-control" style="color:gray;" onchange="hideadditionalfields(this.value)">
                                            <option value="Complete HR interview">Complete HR interview</option>
                                            <option value="Complete 2nd interview">Complete 2nd interview</option>
                                            <option value="Complete 3rd interview">Complete 3rd interview</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Decision</label>
                                        <!-- <input type="date" class="form-control" id="interviewdate" name="interviewdate" style="color:gray;"> -->
                                        <select name="decision" id="decision" class="form-control" style="color:gray;">
                                            <option value="Selected For 2nd Interview">Selected For 2nd Interview</option>
                                            <option value="Selected For 3rd Interview">Selected For 3nd Interview</option>
                                            <option value="Selected">Selected</option>
                                            <option value="Abson">Abson</option>
                                            <option value="Postponed">Postponed</option>
                                            <option value="Reject">Rejected</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="cominication_skill_score_block">
                                        <label for="exampleInputUsername1">Communication Skill Score</label>
                                        <input type="number" class="form-control" id="comminication_score" name="comminication_score" style="color:gray;" placeholder="Communication Score">
                                    </div>
                                    <div class="form-group" id="current_salary_block">
                                        <label for="exampleInputUsername1">Current Sallary</label>
                                        <input type="number" class="form-control" id="current_salary" name="current_salary" style="color:gray;" placeholder="Current Salary">
                                    </div>
                                    <div class="form-group" id="expectation_salary_block">
                                        <label for="exampleInputUsername1">Expectation Sallary</label>
                                        <input type="number" class="form-control" id="expectation_salary" name="expectation_salary" style="color:gray;" placeholder="Expectation">
                                    </div>
                                    <div class="form-group" id="agreed_salary_block">
                                        <label for="exampleInputUsername1">Agreed Sallary</label>
                                        <input type="number" class="form-control" id="agreed_salary" name="agreed_salary" style="color:gray;" placeholder="Agreed Salary">
                                    </div>
                                    <div class="form-group" id="experiance_block">
                                        <label for="exampleInputUsername1">Experience</label>
                                        <!-- <input type="number" class="form-control" id="expectation_salary" name="expectation_salary" style="color:gray;"> -->
                                        <select name="experience" id="experience" class="form-control" style="color:gray;">
                                            <option value="No Experience">No Experience</option>
                                            <option value="One Year Of Experience">One Year Of Experience</option>
                                            <option value="Two Year Of Experience">Two Year Of Experience</option>
                                            <option value="Three Year Of Experience">Three Year Of Experience</option>
                                            <option value="Four Year Of Experience">Four Year Of Experience</option>
                                            <option value="Five Year Of Experience">Five Year Of Experience</option>
                                            <option value="5+ Year Of Experience">5+ Year Of Experience</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="notice_period_block">
                                        <label for="exampleInputUsername1">Notice Period</label>
                                        <input type="text" class="form-control" id="notice_period" name="notice_period" style="color:gray;" placeholder="Notice Period">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Score</label>
                                        <input type="number" class="form-control" id="score" name="score" style="color:gray;" placeholder="Score">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">About The Interview</label>
                                        <textarea name="aboutinterview" id="aboutinterview" class="form-control" style="color:gray;" cols="30" rows="10"></textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary mr-2" onclick="compleatinterview()">Complete Interview</button>
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
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
    function setInterviewId(id) {
        document.getElementById('interviewid').value = id;
    }

    function hideadditionalfields(value) {
        if (value == 'Complete 2nd interview' || value == 'Complete 3rd interview') {
            document.getElementById('cominication_skill_score_block').style.display = "none";
            document.getElementById('current_salary_block').style.display = "none";
            document.getElementById('expectation_salary_block').style.display = "none";
            document.getElementById('agreed_salary_block').style.display = "none";
            document.getElementById('experiance_block').style.display = "none";
            document.getElementById('notice_period_block').style.display = "none";
        } else {
            document.getElementById('cominication_skill_score_block').style.display = "block";
            document.getElementById('current_salary_block').style.display = "block";
            document.getElementById('expectation_salary_block').style.display = "block";
            document.getElementById('agreed_salary_block').style.display = "block";
            document.getElementById('experiance_block').style.display = "block";
            document.getElementById('notice_period_block').style.display = "block";
        }
    }

    function compleatinterview() {
        var interviewid = document.getElementById('interviewid').value;
        var subject = document.getElementById('subject').value;
        var decision = document.getElementById('decision').value;
        var comminication_score = document.getElementById('comminication_score').value;
        var current_salary = document.getElementById('current_salary').value;
        var expectation_salary = document.getElementById('expectation_salary').value;
        var agreed_salary = document.getElementById('agreed_salary').value;
        var experience = document.getElementById('experience').value;
        var notice_period = document.getElementById('notice_period').value;
        var score = document.getElementById('score').value;
        var aboutinterview = document.getElementById('aboutinterview').value;
        $.ajax({
            url: '/compleateInterview',
            type: 'POST',
            data: {
                interviewid: interviewid,
                subject: subject,
                decision: decision,
                comminication_score: comminication_score,
                current_salary: current_salary,
                expectation_salary: expectation_salary,
                agreed_salary: agreed_salary,
                experience: experience,
                notice_period: notice_period,
                score: score,
                aboutinterview: aboutinterview,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Populate the form fields with the retrieved data

                location.reload();

            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    }
</script>