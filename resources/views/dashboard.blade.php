@php
use App\Models\Notification;
use App\Models\Vehical;
use App\Models\Vehicle_has_booking;
use Carbon\Carbon;

$date = Carbon::now()->format('Y-m-d');
$userid = Auth::user()->id;
$companyid = Auth::user()->company_id;



$notifications = Notification::where(function($query) use ($date, $companyid) {
$query->where('notifiaction_date_start', '<=', $date)
    ->where('notification_date_end', '>=', $date)
    ->where('company_id', $companyid);
    })->paginate(5);

    $vehicleLists = Vehical::where('company_id', $companyid)->get();

    // pending Bookings
    $bookings = Vehicle_has_booking::join('customers', 'vehicle_has_bookings.customer_id', '=', 'customers.id')
    ->where('vehicle_has_bookings.company_id', $companyid)
    ->where('vehicle_has_bookings.status', 'pending')
    ->select('vehicle_has_bookings.*', 'customers.full_name', 'customers.telephone_no')->get();
    // End
    $issuedbookings = Vehicle_has_booking::join('customers', 'vehicle_has_bookings.customer_id', '=', 'customers.id')
    ->where('vehicle_has_bookings.company_id', $companyid)
    ->where('vehicle_has_bookings.status', 'Invoice Request')
    ->select('vehicle_has_bookings.*', 'customers.full_name', 'customers.telephone_no')->get();
    @endphp


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
                                               
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                        <!-- <div class="row">
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h3 class="mb-0">5</h3>
                                                <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-success ">
                                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-muted font-weight-normal">Booking Count</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h3 class="mb-0">$17.34</h3>
                                                <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-success">
                                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-muted font-weight-normal">Revenue current</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h3 class="mb-0">$12.34</h3>
                                                <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-danger">
                                                <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-muted font-weight-normal">Daily Income</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="d-flex align-items-center align-self-start">
                                                <h3 class="mb-0">$31.53</h3>
                                                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-success ">
                                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="text-muted font-weight-normal">Expense current</h6>
                                </div>
                            </div>
                        </div>
                    </div> -->


                        <div class="row ">
                            <div class="col-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Pending Bookings</h4>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th> Client Name </th>
                                                        <th> Booking No </th>
                                                        <th> Vehicle No </th>
                                                        <th> Booking Date Time</th>
                                                        <th> Return Date Time </th>
                                                        <th> Pick Location </th>
                                                        <th> Return Location </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bookings as $booking)
                                                    <tr>
                                                        <td>{{ $booking->full_name }}</td>
                                                        <td>{{ $booking->id }}</td>
                                                        <td>{{ $booking->vehicle_no }}</td>
                                                        <td>{{ $booking->book_start_date }} - {{ $booking->pick_time }}</td>
                                                        <td>{{ $booking->return_date }} - {{ $booking->return_time }}</td>
                                                        <td>{{ $booking->pick_location }}</td>
                                                        <td>{{ $booking->return_location }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Issed Vehicle Details</h4>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th> Client Name </th>
                                                        <th> Booking No </th>
                                                        <th> Vehicle No </th>
                                                        <th> Booking Date Time</th>
                                                        <th> Return Date Time </th>
                                                        <th> Pick Location </th>
                                                        <th> Return Location </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($issuedbookings as $issuedbooking)
                                                    <tr>
                                                        <td>{{ $issuedbooking->full_name }}</td>
                                                        <td>{{ $issuedbooking->id }}</td>
                                                        <td>{{ $issuedbooking->vehicle_no }}</td>
                                                        <td>{{ $issuedbooking->book_start_date }} - {{ $issuedbooking->pick_time }}</td>
                                                        <td>{{ $issuedbooking->return_date }} - {{ $issuedbooking->return_time }}</td>
                                                        <td>{{ $issuedbooking->pick_location }}</td>
                                                        <td>{{ $issuedbooking->return_location }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                <div class="preview-icon bg-primary">
                                                    <i class="mdi mdi-file-document"></i>
                                                </div>
                                                <div class="preview-item-content d-flex flex-grow">
                                                    <div class="flex-grow">
                                                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                            <h6 class="preview-subject">{{ $notification->topic }}</h6>
                                                        </div>
                                                        <p class="text-muted">{{ $notification->description }}</p>
                                                        <button class="btn btn-danger" onclick="removeNotification('{{ $notification->id }}')">X</button>
                                                        <button class="btn btn-success">View</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <!-- Pagination Links -->
                                        <div class="mt-3">
                                            {{ $notifications->links() }}
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