
@php
    use Carbon\Carbon;

    // Ensure Carbon instances for the passed dates
    $startDate = Carbon::parse($startDate);
    $returnDate = Carbon::parse($returnDate);

    // Calculate the number of days
    $dateCount = $startDate->diffInDays($returnDate);
@endphp





<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        @foreach ($bookings as $booking)
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="card-title"></h4> -->
                <div class="media">
                    <i class="mdi mdi-flag-variant icon-md text-info d-flex align-self-center mr-3"></i>
                    <div class="media-body">
                        <p class="card-text" id="bookingidc" style="display: none;">{{ $booking->id }}</p>
                        <p class="card-text">{{ $booking->vehicle_no }}</p>
                        <p class="card-text">Already Booking - {{ $booking->book_start_date }}  {{ $booking->pick_time }} To {{ $booking->return_date }} . {{ $booking->return_time }}</p>
                        <p class="card-text">Date Count - <button class="btn btn-success btn-rounded btn-icon ">{{ $dateCount }}</button> </p>
                       <button class="btn btn-primary">{{ $booking->status }}</button>
                    </div>
                </div>

                <div class="media mt-2">
                    <i class="mdi mdi-account-star icon-md text-info d-flex align-self-center mr-3"></i>
                    <div class="media-body">
                        <p class="card-text mt-3">{{ $booking->full_name }} ,Call {{ $booking->telephone_no }}</p>
                        <p class="card-text mt-3">NIC - {{ $booking->nic }}</p>
                       
                    </div>
                    <a href="booking/editbooking/{{ $booking->id }}" class="btn btn-primary">Edit Booking</a>
                </div>
                
            </div>
        </div>
        @endforeach
    </div>
</div>