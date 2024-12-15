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
                                    <h4 class="card-title">Create New Branch</h4>
                                    <form class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Branch Code</label>
                                            <input type="text" class="form-control" id="branch_code" placeholder="Branch Code">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Branch Name</label>
                                            <input type="text" class="form-control" id="candidatename" placeholder="Full Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Branch Admin Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Branch Phone Number</label>
                                            <input type="number" class="form-control" id="phone_number" placeholder="Phone Number">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Started Date</label>
                                            <input type="date" class="form-control" id="dateofbirth" placeholder="Date Of Birth">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea class="form-control" id="description" name="description" cols="30" rows="10"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <button class="btn btn-dark">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Our Branches</h4>
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
                                                            <h6 class="preview-subject">H.W.S Hewavitharana</h6>
                                                            <p class="text-muted mb-0">Software Engineer</p>
                                                        </div>
                                                        <div class="flex-grow">
                                                            <button class="btn btn-outline-primary btn-fw">View CV</button>
                                                            <p class="text-muted mt-1">Interview Pending</p>
                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <p class="text-muted">3 Years Experiance</p>
                                                            <p class="text-muted mt-1">30 Old, 0713370393 </p>
                                                            <button class="btn btn-outline-info btn-fw">Shedule Interview</button>
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