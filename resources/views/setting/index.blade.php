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

                        <div class="col-xl-12 col-sm-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex align-items-center align-self-start">
                                                <button class="btn btn-success create-new-button" data-bs-toggle="modal"
                                                    data-bs-target="#startingbalance">Starting +</button>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex align-items-center align-self-start">
                                                <button class="btn btn-warning create-new-button" data-bs-toggle="modal"
                                                    data-bs-target="#depositemodel">Deposit</button>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex align-items-center align-self-start">
                                                <button class="btn btn-danger create-new-button" data-bs-toggle="modal"
                                                    data-bs-target="#withdrawmodel">Withdraw</button>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex align-items-center align-self-start">
                                                <button class="btn btn-danger create-new-button" data-bs-toggle="modal"
                                                    data-bs-target="#donationmodel">Donation</button>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mt-2">Add Starting Balance</h6>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="startingbalance" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Account Setting</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div id="success-message"></div>

                                    </div>
                                    <div class="modal-body">
                                        <div class="forms-sample">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Starting Amount</label>
                                                <input type="number" class="form-control" id="startingamount"
                                                    placeholder="Starting Amount" style="color: gray;">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="updatestartingamount()">Update</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="depositemodel" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Deposit Account Setting</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div id="success-message-deposit"></div>

                                    </div>
                                    <div class="modal-body">
                                        <div class="forms-sample">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Deposit Amount</label>
                                                <input type="number" class="form-control" id="depositamount"
                                                    placeholder="Deposit Amount" style="color: gray;">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Description</label>
                                                <textarea name="deposit_description" id="deposit_description" style="color: gray;" class="form-control"></textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="updatedepositamount()">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="withdrawmodel" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Withdrawal Setting</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div id="success-message-withdrawal"></div>

                                    </div>
                                    <div class="modal-body">
                                        <div class="forms-sample">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">withdrawal Amount</label>
                                                <input type="number" class="form-control" id="withdrawelamount"
                                                    placeholder="Withdraw Amount" style="color: gray;">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Description</label>
                                                <textarea name="withdrawel_description" id="withdrawel_description" style="color: gray;" class="form-control"></textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="updatewithdrawel()">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="donationmodel" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Donations</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div id="success-message-donation"></div>

                                    </div>
                                    <div class="modal-body">
                                        <div class="forms-sample">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Donate Amount</label>
                                                <input type="number" class="form-control" id="donateamount"
                                                    placeholder="Donate Amount" style="color: gray;">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Description</label>
                                                <textarea name="donation_description" id="donation_description" style="color: gray;" class="form-control"></textarea>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="updatedonation()">Update</button>
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
                                    <h4 class="card-title">Transaction History</h4>
                                    <canvas id="transaction-history" class="transaction-chart"></canvas>
                                    <div
                                        class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                        <div class="text-md-center text-xl-left">
                                            <h6 class="mb-1">Transfer to Paypal</h6>
                                            <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
                                        </div>
                                        <div
                                            class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                            <h6 class="font-weight-bold mb-0">$236</h6>
                                        </div>
                                    </div>
                                    <div
                                        class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                        <div class="text-md-center text-xl-left">
                                            <h6 class="mb-1">Tranfer to Stripe</h6>
                                            <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
                                        </div>
                                        <div
                                            class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                            <h6 class="font-weight-bold mb-0">$593</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Company List</h4>
                                        <p class="text-muted mb-1"></p>
                                        <p class="text-muted mb-1">Your data status</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="preview-list">
                                                @foreach($companys as $company)
                                                <div class="preview-item">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-warning">
                                                            <i class="mdi mdi-biohazard"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $company->name }}</h6>
                                                            <p>{{ $company->contact_no }} /
                                                                {{ $company->mobile_number }}
                                                            </p>
                                                            <p class="text-muted mb-0">{{ $company->email }}</p>
                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <a type="button" class="btn btn-outline-info btn-fw"
                                                                href="/department/{{ $company->id }}">Info</a>
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

<script>
    function updatestartingamount() {
        var startingamount = $('#startingamount').val();

        $.ajax({
            url: '/uploadcompanyaccountbalance',
            type: 'POST',
            data: {
                startingamount: startingamount,
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                $('#success-message').html('<div class="alert alert-success">' + response.success + '</div>');
                $('#startingamount').val('');

            }, // /success function

        });
    }

    function updatedepositamount() {
        var depositamount = $('#depositamount').val();
        var deposit_description = $('#deposit_description').val();

        $.ajax({
            url: '/updatedepositamount',
            type: 'POST',
            data: {
                depositamount: depositamount,
                deposit_description: deposit_description,
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                $('#success-message-deposit').html('<div class="alert alert-success">' + response.success + '</div>');
                $('#depositamount').val('');
                $('#deposit_description').val('');

            }, // /success function

        });
    }

    function updatewithdrawelamount() {
        var withdrawelamount = $('#withdrawelamount').val();
        var withdraw_description = $('#withdrawel_description').val();

        $.ajax({
            url: '/updatewithdrawamount',
            type: 'POST',
            data: {
                withdrawelamount: withdrawelamount,
                withdraw_description: withdraw_description,
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                $('#success-message-withdrawal').html('<div class="alert alert-success">' + response.success + '</div>');
                $('#withdrawelamount').val('');
                $('#withdrawel_description').val('');

            }, // /success function

        });
    }

    function updatedonation() {
        var donateamount = $('#donateamount').val();
        var donation_description = $('#donation_description').val();

        $.ajax({
            url: '/updatedonations',
            type: 'POST',
            data: {
                donateamount: donateamount,
                donation_description: donation_description,
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                $('#success-message-donation').html('<div class="alert alert-success">' + response.success + '</div>');
                $('#donateamount').val('');
                $('#donation_description').val('')

            }, // /success function

        });
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
                    $('#success-message').html('<div class="alert alert-success">' + response.message +
                        '</div>');
                    // alert(response.message);
                    setTimeout(pagereload, 1000);
                } else {
                    // Display error message
                    $('#success-message').html('<div class="alert alert-danger">' + response.message +
                        '</div>');
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
                    $('#success-message').html('<div class="alert alert-success">' + response.message +
                        '</div>');
                    // alert(response.message);
                    setTimeout(pagereload, 1000);
                } else {
                    // Display error message
                    $('#success-message').html('<div class="alert alert-danger">' + response.message +
                        '</div>');
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




    function pagereload() {
        location.reload();
    }
</script>