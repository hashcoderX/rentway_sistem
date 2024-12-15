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
                                    <div class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Find Invoice Date</label>
                                            <input onchange="findBookings(this.value)" type="date" class="form-control" id="find_booking_date" name="find_booking_date" style="color: gray;">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Invoice List</h4>
                                        <p class="text-muted mb-1">Invoice Start Date</p>
                                        <p class="text-muted mb-1">Important data Sets</p>
                                    </div>
                                    <div id="displaydetails" class="displaydetails">
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach($completeInvoices as $invoice)
                                                <div class="preview-list">
                                                    <div class="preview-item border-bottom">
                                                        <div class="preview-thumbnail">
                                                            <div class="preview-icon bg-primary">
                                                                <i class="mdi mdi-file-document"></i>
                                                            </div>
                                                        </div>
                                                        <div class="preview-item-content d-sm-flex flex-grow">
                                                            <div class="flex-grow">
                                                                <h6 class="preview-subject">{{ $invoice->vehicle_no }}</h6>
                                                                <p class="text-muted mb-0">Invoice Date - {{ $invoice->invoice_date }} </p>
                                                                <p class="text-muted mb-0">Customer Name - {{ $invoice->customername }} </p>

                                                            </div>
                                                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                                <p class="text-muted">Bill Amount - {{ number_format($invoice->total_bill,2) }}</p>
                                                                <button id="{{ $invoice->id }}" data-bs-toggle="modal" data-bs-target="#viewinvoicemodel" class="add btn btn-primary" onclick="viewInvoice(this.id)">View Invoice</button>
                                                                <button id="{{ $invoice->id }}" data-bs-toggle="modal" data-bs-target="#cancelinvoiceModal" class="add btn btn-danger" onclick="cancelInvoicesetid(this.id)">Cancel Invoice</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach

                                                <div class="pagination-links">
                                                    {{ $completeInvoices->links() }}
                                                </div>
                                            </div>
                                            <!-- <a href="/vehiclelist" class="btn btn-outline-primary btn-fw">Load All Vehicle</a> -->

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

    <div class="modal fade" id="cancelinvoiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel Invoice</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="invoiceidforcancel" id="invoiceidforcancel">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                    <button type="button" class="btn btn-primary" onclick="cancelBooking()">Cancel Invoice</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewinvoicemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Invoice Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="invoicedisplay" id="invoicedisplay">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


<!-- Modal -->


<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });


    function cancelInvoicesetid(value) {
        document.getElementById('invoiceidforcancel').innerHTML = value;
    }

    function cancelBooking() {
        var invoiceid = document.getElementById('invoiceidforcancel').innerHTML;

        $.ajax({
            url: '/cancelinvoicesource',
            type: 'GET',
            data: {
                invoiceid: invoiceid,

            },
            success: function(response) {
                refresh();
            }
        });
    }

    function viewInvoice(invoiceid){
        $.ajax({
            url: '/getinvoicedetail',
            type: 'GET',
            data: {
                invoiceid: invoiceid,

            },
            success: function(response) {
                if (response.html) {
                    document.querySelector('.invoicedisplay').innerHTML = response.html;
                }
            }
        });
    }
</script>