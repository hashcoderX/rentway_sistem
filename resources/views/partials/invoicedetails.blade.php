<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title"></h4> -->
                <div class="table-responsive">
                    <table class="table">
                        
                        

                        <tr>
                            <th> Customer Name </th>
                            <th> {{ $invoice->customername }} </th>
                        </tr> 

                        <tr>
                            <th> Vehicle No </th>
                            <th> {{ $invoice->vehicle_no }} </th>
                        </tr>

                        <tr>
                            <th> Total Drive Distance </th>
                            <th> {{ $invoice->totaldrivedistance }} Km</th>
                        </tr>

                        <tr>
                            <th> Total Bill</th>
                            <th> {{ number_format($invoice->net_total,2)}}</th>
                        </tr>

                        <tr>
                            <th> Advance Amount</th>
                            <th> {{ number_format($invoice->advance_charge,2)}}</th>
                        </tr>

                        <tr>
                            <th> Discount</th>
                            <th> {{ number_format($invoice->discount,2)}}</th>
                        </tr>

                        <tr>
                            <th> Extra</th>
                            <th> {{ number_format($invoice->extra_charges,2)}}</th>
                        </tr>

                        <tr>
                            <th> Net Total</th>
                            <th> {{ number_format($invoice->net_total,2)}}</th>
                        </tr>

                        <tr>
                            <th> Paid Amount</th>
                            <th> {{ number_format($invoice->paidamount,2)}}</th>
                        </tr>

                        <tr>
                            <th> Balance</th>
                            <th> {{ number_format($invoice->balance,2)}}</th>
                        </tr>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>