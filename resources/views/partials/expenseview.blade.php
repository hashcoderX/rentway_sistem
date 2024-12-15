<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title"></h4> -->
                <div class="media">
                    <i class="mdi mdi-flag-variant icon-md text-info d-flex align-self-center mr-3"></i>
                    <div class="media-body">
                        <p class="card-text" style="display: none;">{{ $expencedetails->id }}</p>
                        <p class="card-text">{{ $expencedetails->expenses_type }}</p>
                        <p class="card-text">Amount - {{ number_format($expencedetails->amount,2) }}</p>

                    </div>
                </div>

                <div class="media mt-2">
                    <i class="mdi mdi-account-star icon-md text-info d-flex align-self-center mr-3"></i>
                    <div class="media-body">
                        <p class="card-text mt-3">{{ $expencedetails->reference }} </p>
                        <p class="card-text mt-3">{{ $expencedetails->description }}</p>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>