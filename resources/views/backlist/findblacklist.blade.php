<x-app-layout>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Black List</h4>
                                        <p class="text-muted mb-1">Actions</p>
                                        <p class="text-muted mb-1">Important data Sets</p>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach($myblacklisters as $myblacklister)
                                            <div class="preview-list">
                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $myblacklister->full_name   }}</h6>
                                                            <p class="text-muted mb-0">{{ $myblacklister->telephone_no }}</p>
                                                            <p class="text-muted mb-0">{{ $myblacklister->nic }}</p>
                                                            <div class="row">

                                                            </div>
                                                        </div>
                                                        <div class="flex-grow">

                                                        </div>
                                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                            <p class="text-muted mt-1">Posted Date - {{ $myblacklister->reg_date }}</p>
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
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Type NIC</label>
                                            <input type="text" class="form-control" id="nic" name="nic" style="color: gray;">
                                            <button class="btn btn-primary" onclick="findblacklister()">Find</button>
                                        </div>
                                    </div>

                                    <div id="displaydetails" class="displaydetails">

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

<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>



<script>
    function findblacklister() {
        var nic = document.getElementById('nic').value;
        $.ajax({
            url: '/getblacklisterdetails',
            type: 'GET',
            data: {
                nic: nic,

            },
            success: function(response) {
                document.querySelector('.displaydetails').innerHTML = response.html;
            }
        });
    }
</script>

<script>
    function openModal(img) {
        console.log('tsd');
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        modal.style.display = "block";
        modalImg.src = img.src;
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>