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
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="candidateName" placeholder="Candidate Name" style="color: gray;">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="position" placeholder="Position" style="color: gray;">
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" id="interviewStage" style="color: gray;">
                                <option value="">Select Stage</option>
                                <option value="Pending HR Meeting">Pending HR Meeting</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">CV Pool</h4>
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
                                                    <th> Possition </th>
                                                    <th> Year Of Experiance </th>
                                                    <th> Contact No </th>
                                                    <th> CV </th>
                                                    <th> Reg:Date </th>
                                                    <th> Stage </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($candidates as $candidate)
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
                                                        <span class="pl-2">{{ $candidate->name }}</span>
                                                    </td>
                                                    <td> {{ $candidate->possition }} </td>
                                                    <td> {{ $candidate->experiance }} </td>
                                                    <td> {{ $candidate->phonenumber }} </td>
                                                    <td> <button class="badge badge-outline-success" data-bs-toggle="modal" id="{{ $candidate->id }}" data-bs-target="#viewcv" onclick="loadCv(this.id)">Preview CV</button> </td>
                                                    <td> {{ $candidate->reg_date }} </td>
                                                    <td> {{ $candidate->interview_stage }} </td>

                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>

                                        {{ $candidates->links() }}
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

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</x-app-layout>


<script>
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
</script>