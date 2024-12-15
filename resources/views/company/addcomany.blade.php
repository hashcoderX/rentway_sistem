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
                                    <h4 class="card-title">New Company</h4>

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

                                    <form class="forms-sample" action="/registercompany" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- <div class="form-group">
                                            <label for="exampleInputUsername1">Employee ID</label>
                                            <input type="text" class="form-control" id="employee_id" name="employee_id" style="color: gray;" placeholder="CA7800">
                                        </div> -->
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Company Name</label>
                                            <input type="text" class="form-control" id="companyname" name="companyname" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Company Code</label>
                                            <input type="text" class="form-control" id="company_code" name="company_code" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Register No</label>
                                            <input type="text" class="form-control" id="regno" name="regno" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address</label>
                                            <textarea class="form-control" name="address" id="address" cols="30" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Ownername</label>
                                            <input type="text" class="form-control" id="ownername" name="ownername" placeholder="Mr Rasika" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Land Line</label>
                                            <input type="number" class="form-control" id="phone_number" name="phone_number" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Mobile Number</label>
                                            <input type="number" class="form-control" id="mobile_number" name="mobile_number" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Logo (.svg)</label>
                                            <input type="file" class="form-control" id="logo" name="logo" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Letter Head</label>
                                            <input type="file" class="form-control" id="letterhead" name="letterhead" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Footer</label>
                                            <input type="file" class="form-control" id="footer" name="footer" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Website</label>
                                            <input type="text" class="form-control" id="website" name="website" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Currency</label>
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

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Pay By</label>
                                            <select name="payby" id="payby" class="form-control">
                                                <option value="cash_per_month">Cash Pay Every Month</option>
                                                <option value="cash_per_year">Cash Pay Every Year</option>
                                                <option value="standing_order">Standing Order</option>
                                                <option value="cheque">Cheque</option>
                                                <option value="bank_transfer">Bank Transfer</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-dark">Cancel</button>
                                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- myvehicles -->
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Company</h4>
                                        <p class="text-muted mb-1">Actions</p>
                                        <p class="text-muted mb-1">Important data Sets</p>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="preview-list">
                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject"></h6>
                                                            <p class="text-muted mb-0"></p>
                                                            <p class="text-muted mb-0"></p>
                                                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                                <p class="text-muted mt-1">Licen Expire Date - </p>
                                                            </div>
                                                            <div class="row">
                                                                <button type="button" class="btn btn-inverse-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deletecv" id="" onclick="setCandidateId(this.id)">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>

                                                            </div>
                                                        </div>
                                                        <div class="flex-grow">

                                                        </div>


                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                        <a href="/vehiclelist" class="btn btn-outline-primary btn-fw">Load All Vehicle</a>
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


<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    function refresh() {
        location.reload();
    }
</script>





</script>