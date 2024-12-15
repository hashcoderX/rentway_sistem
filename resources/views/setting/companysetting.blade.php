<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
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
                    <!-- <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card corona-gradient-card">
                            <div class="card-body py-0 px-0 px-sm-3">
                                <div class="row align-items-center">
                                    <div class="col-4 col-sm-3 col-xl-2">
                                        <img src="assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                                    </div>
                                    <div class="col-5 col-sm-7 col-xl-8 p-0">
                                        <h4 class="mb-1 mb-sm-0">Want even more features?</h4>
                                        <p class="mb-0 font-weight-normal d-none d-sm-block">Check out our Pro version with 5 unique layouts!</p>
                                    </div>
                                    <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                                        <span>
                                            <a href="https://www.bootstrapdash.com/product/corona-admin-template/" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Upgrade to PRO</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                    <div class="row">
                        @if (Auth::user()->usertype == 'Admin')
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center align-self-start">
                                                <a class="btn btn-success create-new-button" href="">Change User Name & Password</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New Company</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div id="success-message"></div>

                                    </div>
                                    <div class="modal-body">
                                        <div class="forms-sample">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Company Name</label>
                                                <input type="text" class="form-control" id="companyname" placeholder="Company Name" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Reg No</label>
                                                <input type="text" class="form-control" id="regno" placeholder="Reg No" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Company Code</label>
                                                <input type="text" class="form-control" id="company_code" placeholder="Company Code" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Address</label>
                                                <!-- <input type="text" class="form-control" id="company_code" placeholder="Company Code"> -->
                                                <textarea name="address" id="address" class="form-control" cols="30" rows="5" style="color: gray;"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Company Email address</label>
                                                <input type="email" class="form-control" id="email" placeholder="Email" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <input type="password" class="form-control" id="password" placeholder="Password" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Owner</label>
                                                <input type="text" class="form-control" id="ownername" placeholder="Owner Name" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone</label>
                                                <input type="number" class="form-control" id="phone_number" placeholder="Phone Number" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mobile Number</label>
                                                <input type="number" class="form-control" id="mobile_number" placeholder="Mobile Number" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Pay By</label>
                                                <select name="payby" id="payby" class="form-control" style="color: gray;">
                                                    <option value="fullcash">Full Payment</option>
                                                    <option value="monthly">Monthly Payment</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="createNewCompany()">Save</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="createuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div id="success-message"></div>

                                    </div>
                                    <div class="modal-body">
                                        <div class="forms-sample">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Name</label>
                                                <input type="text" class="form-control" id="name" placeholder="User Name" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Email</label>
                                                <input type="email" class="form-control" id="email_user" placeholder="Email" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <input type="password" class="form-control" id="userpassword" placeholder="Password" style="color: gray;">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="createNewUser()">Save</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Company Details</h4>
                                    <form action="/updatecompnydetails" class="forms-sample" method="POST" enctype="multipart/form-data">
                                        <div style="display:none;" class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            @csrf
                                            <div class="text-md-center text-xl-left">
                                                <h6 class="mb-1">Company Id</h6>
                                                <input type="text" class="form-control" id="companyid" name="companyid" placeholder="Id" style="color: gray;" value="{{ $company->id }}">
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h6 class="mb-1">Company Name</h6>
                                                <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name" style="color: gray;" value="{{ $company->name }}">
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h6 class="mb-1">Address</h6>
                                                <textarea name="companyaddress" id="companyaddress" cols="30" rows="5" class="form-control">{{ $company->address }}</textarea>
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h6 class="mb-1">Contact No</h6>
                                                <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact No" style="color: gray;" value="{{ $company->contact_no }}">
                                                <input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="Mobile No" style="color: gray;" value="{{ $company->mobile_number }}">
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h6 class="mb-1">Web Site</h6>
                                                <input type="text" class="form-control" id="website" name="website" placeholder="Company Name" style="color: gray;" value="{{ $company->website }}">
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <select name="currency" id="currency" class="form-control" style="color: gray;">
                                                    <option value="USD">United States Dollar (USD)</option>
                                                    <option value="EUR">Euro (EUR)</option>
                                                    <option value="GBP">British Pound Sterling (GBP)</option>
                                                    <option value="AUD">Australian Dollar (AUD)</option>
                                                    <option value="CAD">Canadian Dollar (CAD)</option>
                                                    <option value="JPY">Japanese Yen (JPY)</option>
                                                    <option value="CNY">Chinese Yuan (CNY)</option>
                                                    <option value="INR">Indian Rupee (INR)</option>
                                                    <option value="LKR">Sri Lankan Rupee (LKR)</option>
                                                    <option value="CHF">Swiss Franc (CHF)</option>
                                                    <option value="NZD">New Zealand Dollar (NZD)</option>
                                                    <option value="SGD">Singapore Dollar (SGD)</option>
                                                    <option value="HKD">Hong Kong Dollar (HKD)</option>
                                                    <option value="ZAR">South African Rand (ZAR)</option>
                                                    <option value="SEK">Swedish Krona (SEK)</option>
                                                    <option value="NOK">Norwegian Krone (NOK)</option>
                                                    <option value="DKK">Danish Krone (DKK)</option>
                                                    <option value="RUB">Russian Ruble (RUB)</option>
                                                    <option value="BRL">Brazilian Real (BRL)</option>
                                                    <option value="MXN">Mexican Peso (MXN)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h6 class="mb-1">Logo</h6>
                                                <input type="file" class="form-control" id="logo" name="logo" placeholder="Company Logo" style="color: gray;">
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h6 class="mb-1">Header</h6>
                                                <input type="file" class="form-control" id="header" name="header" placeholder="Company Name" style="color: gray;">
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h6 class="mb-1">Footer</h6>
                                                <input type="file" class="form-control" id="footer" name="footer" placeholder="Company Name" style="color: gray;">
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h6 class="mb-1">Agreement Image One</h6>
                                                <input type="file" class="form-control" id="agreementimgone" name="agreementimgone" style="color: gray;">
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <h6 class="mb-1">Agreement Image Two</h6>
                                                <input type="file" class="form-control" id="agreementimgtwo" name="agreementimgtwo" style="color: gray;">
                                            </div>
                                        </div>

                                        <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                            <div class="text-md-center text-xl-left">
                                                <input type="submit" class="btn btn-success" id="submitbtn" value="Update Company Details">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">


                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Agreement Code</h4>
                                        <p class="text-muted mb-1"></p>
                                        <p class="text-muted mb-1">Your data status</p>
                                    </div>
                                    <div class="row">

                                        <img class="img-fluid" src="{{ asset( $company->agreementsideone) }}" alt="">
                                        <a href="setting/alignbill" class="btn btn-success">Align Bill</a>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h4 class="card-title mb-1">Header</h4>

                                </div>
                                <div class="row">

                                    <img class="img-fluid" src="{{ asset( $company->header) }}" alt="">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-between">
                                    <h4 class="card-title mb-1">Footer</h4>

                                </div>
                                <div class="row">

                                    <img class="img-fluid" src="{{ asset( $company->footer) }}" alt="">

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
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>

    <!-- modal section  -->
    <!-- Modal -->

</x-app-layout>


<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>

<script>
    // Initialize CodeMirror
    var editor = CodeMirror.fromTextArea(document.getElementById('texteditor'), {
        lineNumbers: true, // Adds line numbers
        mode: "javascript", // Set the language mode
        theme: "default", // Choose a theme or load additional themes
        tabSize: 2, // Set the tab size
    });
    editor.setSize("100%", "auto");
</script>

<script>
    function executecode() {
        var editor = CodeMirror.fromTextArea(document.getElementById('texteditor'));
        var code = editor.getValue();

        // Get the iframe and write the code to its document
        var iframe = document.getElementById('previewFrame');
        var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
        iframeDoc.open();
        iframeDoc.write(code);
        iframeDoc.close();
    }

    function createNewCompany() {
        var companyname = $('#companyname').val();
        var regno = $('#regno').val();
        var company_code = $('#company_code').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var password = $('#password').val();
        var ownername = $('#ownername').val();
        var phone_number = $('#phone_number').val();
        var mobile_number = $('#mobile_number').val();
        var payby = $('#payby').val();


        // Check if any of the input fields are empty
        if (!companyname || !company_code || !email || !password || !ownername || !mobile_number || !payby) {
            // Display error message if any input field is empty
            $('#success-message').html('<div class="alert alert-danger">Please fill in all required fields.</div>');
            return; // Exit function if any input field is empty
        }

        $.ajax({
            url: '/registercompany',
            type: 'POST',
            data: {
                companyname: companyname,
                regno: regno,
                company_code: company_code,
                email: email,
                address: address,
                password: password,
                ownername: ownername,
                phone_number: phone_number,
                mobile_number: mobile_number,
                payby: payby,
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                // $('#success-message').html('<div class="alert alert-success">' + response.success + '</div>');
                if (response.status === 200) {
                    // Display success message
                    $('#success-message').html('<div class="alert alert-success">' + response.message + '</div>');
                    // alert(response.message);
                    setTimeout(pagereload, 1000);
                } else {
                    // Display error message
                    $('#success-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    // alert(response.message);
                }

            }, // /success function
            error: function(xhr, status, error) {
                // Handle error if AJAX request fails
                console.error(xhr.responseText);
            }
        });

    }

    function createNewUser() {
        var name = $('#name').val();
        var email_user = $('#email_user').val();
        var userpassword = $('#userpassword').val();

        $.ajax({
            url: '/registeruser',
            type: 'POST',
            data: {
                name: name,
                email_user: email_user,
                userpassword: userpassword,
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                // $('#success-message').html('<div class="alert alert-success">' + response.success + '</div>');
                if (response.status === 200) {
                    // Display success message
                    $('#success-message').html('<div class="alert alert-success">' + response.message + '</div>');
                    // alert(response.message);
                    setTimeout(pagereload, 1000);
                } else {
                    // Display error message
                    $('#success-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    // alert(response.message);
                }

            }, // /success function
            error: function(xhr, status, error) {
                // Handle error if AJAX request fails
                console.error(xhr.responseText);
            }
        });
    }

    function createUserroll() {
        $.ajax({
            url: '/createUserRoll',
            type: 'GET',
            data: {
                starts: 'yes',

            },

            success: function(response) {
                // $('#success-message').html('<div class="alert alert-success">' + response.success + '</div>');


            }, // /success function
            error: function(xhr, status, error) {
                // Handle error if AJAX request fails
                console.error(xhr.responseText);
            }
        });
    }


    function createLevel() {
        var lvl = $('#lvl').val();
        var leveldescrition = $('#leveldescrition').val();
        var jdmarketing = $('#jdmarketing').val();
        var jdoperation = $('#jdoperation').val();
        var categoarylvl = $('#categoarylvl').val();

        // Check if any of the input fields are empty
        if (!lvl || !leveldescrition || !jdmarketing || !jdoperation || !categoarylvl) {
            // Display error message if any input field is empty
            $('#success-message').html('<div class="alert alert-danger">Please fill in all required fields.</div>');
            return; // Exit function if any input field is empty
        }

        $.ajax({
            url: '/createstafflevel',
            type: 'POST',
            data: {
                lvl: lvl,
                leveldescrition: leveldescrition,
                jdmarketing: jdmarketing,
                jdoperation: jdoperation,
                categoarylvl: categoarylvl,
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                // $('#success-message').html('<div class="alert alert-success">' + response.success + '</div>');
                if (response.status === 200) {
                    // Display success message
                    location.reload();
                    $('#success-message').html('<div class="alert alert-success">' + response.message + '</div>');
                    // alert(response.message);
                } else {
                    // Display error message
                    $('#success-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    // alert(response.message);
                }

            }, // /success function
            error: function(xhr, status, error) {
                // Handle error if AJAX request fails
                console.error(xhr.responseText);
            }
        });
    }

    function pagereload() {
        location.reload();
    }
</script>