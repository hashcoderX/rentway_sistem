<div class="col-12">
    @foreach($bookings as $booking)
        <div class="preview-list">
            <div class="preview-item border-bottom">
                <div class="preview-thumbnail">
                    <div class="preview-icon bg-primary">
                        <i class="mdi mdi-file-document"></i>
                    </div>
                </div>
                <div class="preview-item-content d-sm-flex flex-grow">
                    <div class="flex-grow">
                        <h6 class="preview-subject">{{ $booking->vehicle_no }}</h6>
                        <p class="text-muted mb-0">{{ $booking->book_start_date }} To {{ $booking->return_date }}</p>
                        <p class="text-muted mb-0">Pick Location - {{ $booking->pick_location }} & Pick Time {{ $booking->pick_time }}</p>
                        <p class="text-muted mb-0">Customer - {{ $booking->full_name }} ,Call {{ $booking->telephone_no }}</p>
                    </div>
                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">Travel To - {{ $booking->wheretogo }}</p>
                        @if($booking->isdriver == 'with_driver')
                            <p class="text-muted mb-0">Booking with driver</p>
                        @else
                            <p class="text-muted mb-0">Booking Without driver</p>
                        @endif
                        <button  id="{{ $booking->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="add btn btn-primary">View Booking</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>