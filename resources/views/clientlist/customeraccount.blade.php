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
                                            <div class="accountbalance">
                                                <h3>Account Balance - Rs. {{ number_format($customerAccount->accountbalance, 2) }}</h3>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setcustomerid('{{ $customer->id }}')">Update Account Balance</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">

                            <div class="card">
                                <div class="d-flex flex-row justify-content-between">
                                    <h4 class="card-title p-2">Transaction History</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th> # id</th>
                                                <th> Date </th>
                                                <th> Credit </th>
                                                <th> Debit </th>
                                                <th> Balance </th>
                                                <th> Note </th>
                                                <th> Description </th>
                                            </tr>
                                            @foreach ($transactionhistorys as $transactionhistory)
                                            <tr>
                                                <td>{{ $transactionhistory->id }}</td>
                                                <td>{{ $transactionhistory->date_time }}</td>
                                                <td>{{ number_format($transactionhistory->credit, 2) }}</td>
                                                <td>{{ number_format($transactionhistory->debit, 2) }}</td>
                                                <td>{{ number_format($transactionhistory->accountbalance, 2) }}</td>
                                                <td>{{ $transactionhistory->note }}</td>
                                                <td>{{ $transactionhistory->description }}</td>
                                            </tr>
                                            @endforeach
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Our Employees</h4> -->
                                    <div class="table-responsive">
                                        <div class="card">
                                            <button class="btn btn-success" onclick="addcash()" data-bs-toggle="modal" data-bs-target="#addcash">Add Cash</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">

                            <div class="card">
                                <div class="d-flex flex-row justify-content-between">
                                    <h4 class="card-title p-2">Pending Cash</h4>
                                </div>
                                <div class="table-responsive">


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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Customer Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="/updatecustomeraccount" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Customer Id</label>
                                <input type="text" class="form-control" id="customerid" name="customerid" style="color: gray;" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Start Type</label>
                                <select name="starttype" id="starttype" class="form-control">
                                    <option value="credit">Credit</option>
                                    <option value="debit">Debit</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Starting Amount</label>
                                <input type="number" class="form-control" id="starting_amount" name="starting_amount" style="color: gray;">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>



        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Cash</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="/updatecustomerpayment" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Customer Id</label>
                                <input type="text" class="form-control" id="customerid" name="customerid" style="color: gray;" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Start Type</label>
                                <select name="starttype" id="starttype" class="form-control">
                                    <option value="advance payment">Advance Payment</option>
                                    <option value="credit payment">Credit Payment</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Starting Amount</label>
                                <input type="number" class="form-control" id="paidamount" name="paidamount" style="color: gray;">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: white;">Close</button>
                                <button type="submit" class="btn btn-primary">Add Cash</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>



        </div>
    </div>
</div>

<script>
    function refresh() {
        location.reload();
    }

    function setcustomerid(customerid) {
        document.getElementById('customerid').value = customerid;
    }
</script>