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

                        <div class="col-md-12 col-xl-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title">Notification</h4>
                                        <p class="text-muted mb-1 small">View all</p>
                                    </div>
                                    <div class="preview-list">
                                        @foreach ($notifications as $notification)
                                        <div class="preview-item border-bottom">
                                            <div class="preview-thumbnail">
                                                <img src="assets/images/faces/face6.jpg" alt="image" class="rounded-circle" />
                                            </div>
                                            <div class="preview-item-content d-flex flex-grow">
                                                <div class="flex-grow">
                                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                        <h6 class="preview-subject">{{ $notification->topic }}</h6>
                                                    </div>
                                                    <p class="text-muted">{{ $notification->description }}</p>
                                                    <button class="btn btn-danger" onclick="removeNotification('{{ $notification->id }}')">X</button>
                                                    <button class="btn btn-success" onclick="viewnotification('{{ $notification->id }}')" data-bs-toggle="modal" data-bs-target="#viewnotificationdetails">View</button>
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

<div class="modal fade" id="viewnotificationdetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Notification</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="notificationfiger" id="notificationfiger">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>



<script>
    function refresh() {
        location.reload();
    }

    function viewnotification(notificationid) {
        $.ajax({
            url: '/getnotificationdetails',
            type: 'GET',
            data: {
                notificationid: notificationid,

            },
            success: function(response) {
                if (response.html) {
                    document.querySelector('.notificationfiger').innerHTML = response.html;
                }
            }
        });
    }

    function removeNotification(notificationid) {
        $.ajax({
            url: '/removenotification',
            type: 'GET',
            data: {
                notificationid: notificationid,
            },
            success: function(response) {
                location.reload();
            }
        });
    }
</script>