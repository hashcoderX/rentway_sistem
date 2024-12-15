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
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">

                                                    <input type="date" class="form-control" id="expencestdate" name="expencestdate" style="color: gray;">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">

                                                    <input type="date" class="form-control" id="expenceenddate" name="expenceenddate" style="color: gray;">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">

                                                    <button class="btn btn-primary" onclick="searchExpenses()">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">This Month Expenses</h4>
                                        <p class="text-muted mb-1">Important data Sets</p>
                                    </div>
                                    <div id="displaydetails" class="displaydetails">
                                        <div class="row">
                                            <div class="col-12">
                                                <div id="displaydetails" class="displaydetails">
                                                    @foreach($expenses as $expense)
                                                    <div class="preview-list">
                                                        <div class="preview-item border-bottom">
                                                            <div class="preview-thumbnail">
                                                                <div class="preview-icon bg-primary">
                                                                    <i class="mdi mdi-file-document"></i>
                                                                </div>
                                                            </div>
                                                            <div class="preview-item-content d-sm-flex flex-grow">
                                                                <div class="flex-grow">
                                                                    <h6 class="preview-subject">{{ Str::ucfirst($expense->expenses_type) }}</h6>
                                                                    <p class="text-muted mb-0">{{ number_format($expense->amount, 2) }}</p>
                                                                    <p class="text-muted mb-0">{{ $expense->reference }}</p>
                                                                </div>
                                                                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                                    <p class="text-muted">{{ $expense->description }}</p>
                                                                    <button id="{{ $expense->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="add btn btn-primary" onclick="viewexpence(this.id)">View Expense</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                    <div id="totalAmount" class="text-right font-weight-bold">
                                                        Total Expense: {{ number_format($totalAmount,2) }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                        <!-- Pagination Links -->
                                        <div class="d-flex justify-content-center">
                                            {{ $expenses->links() }}
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">View Booking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="bookingindetails" id="bookingindetails">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Close</button>
                    <!-- <button type="button" class="btn btn-primary" onclick="createInvoice()">Create Invoice</button> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Modal -->

<script>
    function refresh() {
        location.reload();
    }

    function searchExpenses() {
        const startDate = document.getElementById('expencestdate').value;
        const endDate = document.getElementById('expenceenddate').value;

        if (!startDate || !endDate) {
            alert("Please select both start and end dates.");
            return;
        }

        fetch('/expenses/filter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    start_date: startDate,
                    end_date: endDate
                })
            })
            .then(response => response.json())
            .then(data => {
                const displayDetails = document.getElementById('displaydetails');
                const totalAmountDisplay = document.getElementById('totalAmount');

                let html = '';
                data.expenses.forEach(expense => {
                    html += `
                <div class="preview-list">
                    <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-primary">
                                <i class="mdi mdi-file-document"></i>
                            </div>
                        </div>
                        <div class="preview-item-content d-sm-flex flex-grow">
                            <div class="flex-grow">
                                <h6 class="preview-subject">${expense.id}</h6>
                                <p class="text-muted mb-0">${expense.expenses_type}</p>
                                <p class="text-muted mb-0">${expense.amount.toFixed(2)}</p>
                                <p class="text-muted mb-0">${expense.reference}</p>
                            </div>
                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <p class="text-muted">${expense.description}</p>
                                <button id="${expense.id}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="add btn btn-primary" onclick="viewbooking(${expense.id})">View Expense</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                });

                // Update the content and total amount
                displayDetails.innerHTML = html;
                totalAmountDisplay.textContent = `Total Expense: ${data.total_amount.toFixed(2)}`;
            })
            .catch(error => console.error('Error:', error));
    }



    function viewexpence(id) {
       
        $.ajax({
            url: '/getexpencedetails',
            type: 'GET',
            data: {
                expenceid: id,

            },
            success: function(response) {
                if (response.html) {
                    document.querySelector('.bookingindetails').innerHTML = response.html;
                }
            }
        });
    }

    function createInvoice() {
        var bookingid = document.getElementById('bookingidc').innerHTML;
        alert(bookingid);
    }
</script>