<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title"></h4> -->
                <div class="media">
                    <i class="mdi mdi-flag-variant icon-md text-info d-flex align-self-center mr-3"></i>
                    <div class="media-body">
                        <p class="card-text" id="bookingidc" style="display: none;">{{ $notification->id }}</p>
                        <h4 class="card-text">{{ $notification->topic }}</h4>
                        <p class="card-text"> {{ $notification->description }} </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>