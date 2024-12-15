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
                                    <h4 class="card-title">Create New Employee</h4>

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

                                    <form class="forms-sample" action="/saveemployee" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- <div class="form-group">
                                            <label for="exampleInputUsername1">Employee ID</label>
                                            <input type="text" class="form-control" id="employee_id" name="employee_id" style="color: gray;" placeholder="CA7800">
                                        </div> -->
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Employee Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name" style="color: gray;" placeholder="Employee full name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Date Of Birth</label>
                                            <input type="date" class="form-control" id="dob" name="dob">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">NIC</label>
                                            <input type="text" class="form-control" id="nic" name="nic" placeholder="NIC" maxlength="12" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Gender</label>
                                            <select class="form-control" id="gender" name="gender" style="color: gray;">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nationality</label>
                                            <select class="form-control" id="nationality" name="nationality" style="color: gray;">
                                                <option>Select a nationality</option>
                                                <option>Sri Lankan</option>
                                                <option>Afghan</option>
                                                <option>Albanian</option>
                                                <option>Algerian</option>
                                                <option>American</option>
                                                <option>Andorran</option>
                                                <option>Angolan</option>
                                                <option>Antiguans</option>
                                                <option>Argentinean</option>
                                                <option>Armenian</option>
                                                <option>Australian</option>
                                                <option>Austrian</option>
                                                <option>Azerbaijani</option>
                                                <option>Bahamian</option>
                                                <option>Bahraini</option>
                                                <option>Bangladeshi</option>
                                                <option>Barbadian</option>
                                                <option>Barbudans</option>
                                                <option>Batswana</option>
                                                <option>Belarusian</option>
                                                <option>Belgian</option>
                                                <option>Belizean</option>
                                                <option>Beninese</option>
                                                <option>Bhutanese</option>
                                                <option>Bolivian</option>
                                                <option>Bosnian</option>
                                                <option>Brazilian</option>
                                                <option>British</option>
                                                <option>Bruneian</option>
                                                <option>Bulgarian</option>
                                                <option>Burkinabe</option>
                                                <option>Burmese</option>
                                                <option>Burundian</option>
                                                <option>Cambodian</option>
                                                <option>Cameroonian</option>
                                                <option>Canadian</option>
                                                <option>Cape Verdean</option>
                                                <option>Central African</option>
                                                <option>Chadian</option>
                                                <option>Chilean</option>
                                                <option>Chinese</option>
                                                <option>Colombian</option>
                                                <option>Comoran</option>
                                                <option>Congolese</option>
                                                <option>Costa Rican</option>
                                                <option>Croatian</option>
                                                <option>Cuban</option>
                                                <option>Cypriot</option>
                                                <option>Czech</option>
                                                <option>Danish</option>
                                                <option>Djibouti</option>
                                                <option>Dominican</option>
                                                <option>Dutch</option>
                                                <option>East Timorese</option>
                                                <option>Ecuadorean</option>
                                                <option>Egyptian</option>
                                                <option>Emirian</option>
                                                <option>Equatorial Guinean</option>
                                                <option>Eritrean</option>
                                                <option>Estonian</option>
                                                <option>Ethiopian</option>
                                                <option>Fijian</option>
                                                <option>Filipino</option>
                                                <option>Finnish</option>
                                                <option>French</option>
                                                <option>Gabonese</option>
                                                <option>Gambian</option>
                                                <option>Georgian</option>
                                                <option>German</option>
                                                <option>Ghanaian</option>
                                                <option>Greek</option>
                                                <option>Grenadian</option>
                                                <option>Guatemalan</option>
                                                <option>Guinea-Bissauan</option>
                                                <option>Guinean</option>
                                                <option>Guyanese</option>
                                                <option>Haitian</option>
                                                <option>Honduran</option>
                                                <option>Hungarian</option>
                                                <option>I-Kiribati</option>
                                                <option>Icelander</option>
                                                <option>Indian</option>
                                                <option>Indonesian</option>
                                                <option>Iranian</option>
                                                <option>Iraqi</option>
                                                <option>Irish</option>
                                                <option>Israeli</option>
                                                <option>Italian</option>
                                                <option>Ivorian</option>
                                                <option>Jamaican</option>
                                                <option>Japanese</option>
                                                <option>Jordanian</option>
                                                <option>Kazakhstani</option>
                                                <option>Kenyan</option>
                                                <option>Kittian and Nevisian</option>
                                                <option>Kuwaiti</option>
                                                <option>Kyrgyz</option>
                                                <option>Laotian</option>
                                                <option>Latvian</option>
                                                <option>Lebanese</option>
                                                <option>Liberian</option>
                                                <option>Libyan</option>
                                                <option>Liechtensteiner</option>
                                                <option>Lithuanian</option>
                                                <option>Luxembourger</option>
                                                <option>Macedonian</option>
                                                <option>Malagasy</option>
                                                <option>Malawian</option>
                                                <option>Malaysian</option>
                                                <option>Maldivan</option>
                                                <option>Malian</option>
                                                <option>Maltese</option>
                                                <option>Marshallese</option>
                                                <option>Mauritanian</option>
                                                <option>Mauritian</option>
                                                <option>Mexican</option>
                                                <option>Micronesian</option>
                                                <option>Moldovan</option>
                                                <option>Monacan</option>
                                                <option>Mongolian</option>
                                                <option>Montenegrin</option>
                                                <option>Moroccan</option>
                                                <option>Mosotho</option>
                                                <option>Motswana</option>
                                                <option>Mozambican</option>
                                                <option>Namibian</option>
                                                <option>Nauruan</option>
                                                <option>Nepalese</option>
                                                <option>New Zealander</option>
                                                <option>Nicaraguan</option>
                                                <option>Nigerian</option>
                                                <option>Nigerien</option>
                                                <option>North Korean</option>
                                                <option>Northern Irish</option>
                                                <option>Norwegian</option>
                                                <option>Omani</option>
                                                <option>Pakistani</option>
                                                <option>Palauan</option>
                                                <option>Panamanian</option>
                                                <option>Papua New Guinean</option>
                                                <option>Paraguayan</option>
                                                <option>Peruvian</option>
                                                <option>Polish</option>
                                                <option>Portuguese</option>
                                                <option>Qatari</option>
                                                <option>Romanian</option>
                                                <option>Russian</option>
                                                <option>Rwandan</option>
                                                <option>Saint Lucian</option>
                                                <option>Salvadoran</option>
                                                <option>Samoan</option>
                                                <option>San Marinese</option>
                                                <option>Sao Tomean</option>
                                                <option>Saudi</option>
                                                <option>Scottish</option>
                                                <option>Senegalese</option>
                                                <option>Serbian</option>
                                                <option>Seychellois</option>
                                                <option>Sierra Leonean</option>
                                                <option>Singaporean</option>
                                                <option>Slovakian</option>
                                                <option>Slovenian</option>
                                                <option>Solomon Islander</option>
                                                <option>Somali</option>
                                                <option>South African</option>
                                                <option>South Korean</option>
                                                <option>Spanish</option>
                                                <option>Sudanese</option>
                                                <option>Surinamer</option>
                                                <option>Swazi</option>
                                                <option>Swedish</option>
                                                <option>Swiss</option>
                                                <option>Syrian</option>
                                                <option>Taiwanese</option>
                                                <option>Tajik</option>
                                                <option>Tanzanian</option>
                                                <option>Thai</option>
                                                <option>Togolese</option>
                                                <option>Tongan</option>
                                                <option>Trinidadian or Tobagonian</option>
                                                <option>Tunisian</option>
                                                <option>Turkish</option>
                                                <option>Tuvaluan</option>
                                                <option>Ugandan</option>
                                                <option>Ukrainian</option>
                                                <option>Uruguayan</option>
                                                <option>Uzbekistani</option>
                                                <option>Vanuatuan</option>
                                                <option>Venezuelan</option>
                                                <option>Vietnamese</option>
                                                <option>Welsh</option>
                                                <option>Yemenite</option>
                                                <option>Zambian</option>
                                                <option>Zimbabwean</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">User Name</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="User Name" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" style="color: gray;">
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
                                        <h4 class="card-title mb-1">Employee</h4>
                                        <p class="text-muted mb-1">Actions</p>
                                        <p class="text-muted mb-1">Important data Sets</p>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach($employees as $employee)
                                            <div class="preview-list">
                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $employee->fullName ." ". $employee->employeeID  }}</h6>
                                                            <p class="text-muted mb-0">{{ $employee->email }}</p>
                                                            <p class="text-muted mb-0">{{ $employee->phoneNumber }}</p>
                                                            <div class="row">
                                                                <!-- <button type="button" class="btn btn-inverse-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deletecv" id="{{ $employee->id }}" onclick="setCandidateId(this.id)">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button> -->
                                                                <a href="employee/{{ $employee->id }}" class="btn btn-inverse-primary btn-icon">
                                                                    <i class="mdi mdi-update"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow">

                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <!-- <p class="text-muted"> Year of Expeiance -{{ $employee->experiance }}</p> -->
                                                            <p class="text-muted mt-1">Employeement Start Date{{ $employee->startDate }}</p>
                                                            <!-- <button class="btn btn-outline-info btn-fw">Shedule Interview</button> -->
                                                            @if ($employee->profile_status == 'completed')
                                                            <a  class="btn btn-outline-success btn-fw">View Profile</a>
                                                            @else
                                                            <a href="employee/{{ $employee->id }}" class="btn btn-outline-danger btn-fw">incompleted Profile</a>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <a href="/employeelist" class="btn btn-outline-primary btn-fw">Load All Employee</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Late Deduction (Per hr)</label>
                                    <input type="number" class="form-control" name="late_deduction" id="late_deduction" style="color: gray;">
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
                                    <textarea name="contactaddress" id="contactaddress" cols="30" rows="4" class="form-control" style="color: gray;"></textarea>
                                </div>
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

<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>



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