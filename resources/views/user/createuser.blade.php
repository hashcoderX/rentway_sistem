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
                                    <h4 class="card-title">Create User</h4>
                                    <div class="notificationdisplay" id="notificationdisplay"></div>
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">User Full Name</label>
                                            <input type="text" class="form-control" id="username" name="username" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">E mail</label>
                                            <input type="email" class="form-control" id="email" name="email" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Re-Password</label>
                                            <input type="password" class="form-control" id="repassword" name="repassword" style="color: gray;">
                                        </div>
                                    </div>

                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">User Type</label>
                                            <select name="usertype" id="usertype" class="form-control">
                                                <option value="manager">Manager</option>
                                                <option value="cashier">Cashier</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button class="btn btn-dark">Cancel</button>
                                    <button type="button" class="btn btn-primary mr-2" onclick="saveuser()">Register User</button>
                                </div>
                            </div>
                        </div>

                        <!-- myvehicles -->
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">User List</h4>
                                        <p class="text-muted mb-1"></p>
                                        <p class="text-muted mb-1"></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach($users as $user)
                                            <div class="preview-list">
                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $user->name }}</h6>
                                                            <p class="text-muted mb-0">{{ $user->email }} </p>
                                                            <p class="text-muted mb-0">User Type - {{ $user->usertype }}</p>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            @endforeach
                                        </div>
                                        <!-- <a href="/vehiclelist" class="btn btn-outline-primary btn-fw">Load All Vehicle</a> -->
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
    </div>
</x-app-layout>


<!-- Modal -->


<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

<script>
    function saveuser() {
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        var usertype = $('#usertype').val();

        if (username === "" || email === "" || password === "" || repassword === "" || usertype === "") {
            alert("Please fill in all the required fields.");
            return;
        } else {
            if (password == repassword) {
                var data = {
                    username: username,
                    email: email,
                    password: repassword,
                    usertype: usertype,
                };

                $.ajax({
                    url: '/addsubusers',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (response.code == '203') {
                            alert('Already Registerd');
                        } else {
                            refresh();
                        }
                        // alert('Booking saved successfully!');
                        // Optionally, you can perform further actions like redirecting the user or clearing the form

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('An error occurred while saving the user. Please try again.');
                    }
                });
            } else {
                document.getElementById('password').style.border = '3px solid red';
                document.getElementById('repassword').style.border = '3px solid red';
            }

        }
    }

    


    
    function refresh() {
        location.reload();
    }

    
</script>