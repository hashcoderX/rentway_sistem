

<div class="col-12">
    <div class="preview-list">
        <div class="preview-item border-bottom">
            <div class="preview-thumbnail">
                <div class="preview-icon bg-primary">
                    <i class="mdi mdi-file-document"></i>
                </div>
            </div>
            <div class="preview-item-content d-sm-flex flex-grow">
                <div class="flex-grow">
                    <h6 class="preview-subject">{{ $blacklisterdetails->full_name }}</h6>
                    <p class="text-muted mb-0">Posted Date - {{ $blacklisterdetails->reg_date }}</p>
                    <p class="text-muted mb-0">NIC - {{ $blacklisterdetails->nic }}</p>
                    <p class="text-muted mb-0">Mobile No - {{ $blacklisterdetails->telephone_no }} </p>
                </div>
                <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                    <p class="text-muted">Damage Type - {{ $blacklisterdetails->type_of_damage }}</p>
                    <p class="text-muted">Inquary - {{ $blacklisterdetails->resone_describe }}</p>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <img src="{{ asset($blacklisterdetails->driving_licen_photo) }}" alt="" width="300px" height="auto" onclick="openModal(this)">
        </div>
        <div class="col">
            <img src="{{ asset($blacklisterdetails->customer_photo) }}" alt="" width="300px" height="auto" onclick="openModal(this)">
        </div>
        <div class="col">
            <img src="{{ asset($blacklisterdetails->livingvarification) }}" alt="" width="300px" height="auto" onclick="openModal(this)">
        </div>
        <div class="col">
            <img src="{{ asset($blacklisterdetails->damageverification) }}" alt="" width="300px" height="auto" onclick="openModal(this)">
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <button class="btn btn-danger" onclick="closeModal()">X</button>
        <!-- <span class="close" onclick="closeModal()">&times;</span> -->
        <img class="modal-content" id="img01">
    </div>


</div>

