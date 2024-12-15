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

                        <!-- myvehicles -->
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="forms-sample">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Report Start Date</label>
                                                    <input type="date" class="form-control" id="report_start_date" name="report_start_date" style="color: gray;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="forms-sample">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Report End Date</label>
                                                    <input type="date" class="form-control" id="report_end_date" name="report_end_date" style="color: gray;" onchange="genarateReport()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 grid-margin stretch-card">
                                            <div class="card displaydetails">
                                                <h5>Today Earning - {{ number_format($todayearning,2) }}</h5>
                                                <h5>Month Earning - {{ number_format($monthearning,2) }}</h5>
                                                <!-- <canvas id="myChart" width="400" height="200"></canvas> -->
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


<!-- Modal -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Users Registered',
                data: [5, 10, 20, 15, 30, 100],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>



<script>
    function genarateReport() {
        var startdate = document.getElementById('report_start_date').value;
        var enddate = document.getElementById('report_end_date').value;
        var data = {
            startdate: startdate,
            enddate: enddate,
        };

        $.ajax({
            url: '/genarateearningreport',
            type: 'GET',
            data: data,
            success: function(response) {
                document.querySelector('.displaydetails').innerHTML = response.html;
            },

        });
    }


    function refresh() {
        location.reload();
    }
</script>