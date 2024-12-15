<x-app-layout>

    <style>
        .disabled {
            opacity: 0.5;
            /* Adjust the opacity as desired */
            pointer-events: none;
            /* Prevent pointer events */
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
                                    <!-- <h4 class="card-title">Our Employees</h4> -->
                                    <div class="table-responsive">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Customer</h4>
                                                <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel owl-loaded owl-drag" id="owl-carousel-basic">
                                                    <div class="owl-stage-outer">
                                                        <div class="owl-stage" style="transform: translate3d(-1445px, 0px, 0px); transition: all 0.25s ease 0s; width: 3374px;">

                                                            <div class="owl-item cloned" style="width: 471.984px; margin-right: 10px;">
                                                                <div class="item">
                                                                    <img src="{{ asset($customer->customer_photo) }}" alt="">
                                                                </div>
                                                            </div>

                                                            <div class="owl-item cloned" style="width: 471.984px; margin-right: 10px;">
                                                                <div class="item">
                                                                    <img src="{{ asset($customer->driving_licen_photo) }}" alt="">
                                                                </div>
                                                            </div>

                                                            <div class="owl-item cloned" style="width: 471.984px; margin-right: 10px;">
                                                                <div class="item">
                                                                    <img src="{{ asset($customer->livingvarification) }}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="mdi mdi-chevron-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="mdi mdi-chevron-right"></i></button></div>
                                                    <div class="owl-dots disabled"></div>
                                                </div>
                                                <div class="preview-item border-bottom mt-4">

                                                    <div class="preview-item-content d-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                                                <h6 class="preview-subject">{{ $customer->full_name }}</h6>
                                                                <p class="text-muted text-small"> {{ $customer->nic }} </p>
                                                                <p class="text-muted text-small">{{ $customer->telephone_no }}</p>
                                                                <p class="text-muted text-small" id="registerdate">{{ $customer->reg_date }}</p>
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
                        <div class="col-md-8 grid-margin stretch-card">

                            <div class="card">
                                <div class="d-flex flex-row justify-content-between">
                                    <h4 class="card-title p-2">Billing History</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th> # id</th>
                                                <th> Date </th>
                                                <th> Amount </th>
                                                <th> Drive Distance </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices as $invoice)
                                            <tr>
                                                <td> {{ $invoice->id }} </td>
                                                <td> {{ $invoice->invoice_date }} </td>
                                                <td> {{ number_format($invoice->total_bill,2) }} </td>
                                                <td> {{ $invoice->totaldrivedistance }} </td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                    {{ $invoices->links() }}
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
</x-app-layout>

<script>
    function refresh() {
        location.reload();
    }
</script>