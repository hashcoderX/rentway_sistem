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
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Register New Vehicle</h4>

                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <form class="forms-sample" action="/savevehicleinitial" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- <div class="form-group">
                                            <label for="exampleInputUsername1">Employee ID</label>
                                            <input type="text" class="form-control" id="employee_id" name="employee_id" style="color: gray;" placeholder="CA7800">
                                        </div> -->
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Vehical No</label>
                                            <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" style="color: gray;" placeholder="CDF9090">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Vehicle Type</label>
                                            <select name="vehicle_type" id="vehicle_type" class="form-control" style="color: gray;">
                                                <option value="bicycle">Bicycle</option>
                                                <option value="motorcycle">Motorcycle</option>
                                                <option value="three_wheel">Three Wheel</option>
                                                <option value="cars">Cars</option>
                                                <option value="jeep">Jeep</option>
                                                <option value="suv">SUV</option>
                                                <option value="lorries_trucks">Lorries & Trucks</option>
                                                <option value="vans">Van</option>
                                                <option value="maintain_servie_vehicle">Maintain & Service Vehicle</option>
                                                <option value="bus">Bus</option>
                                                <option value="heavy_duty">Heavy Duty</option>
                                                <option value="tractors">Tractors</option>
                                                <option value="boats_water_transport">Boats & Water Transport</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Body Type</label>
                                            <select name="body_type" id="body_type" class="form-control" style="color: gray;">
                                                <option value="foot bicycle">Foot Bicycle</option>
                                                <option value="Standard">Standard</option>
                                                <option value="Scooter">Scooter</option>
                                                <option value="Supermoto">Supermoto</option>
                                                <option value="Hatchback">Hatchback</option>
                                                <option value="Saloon">Saloon</option>
                                                <option value="SUV/4x4">SUV/4x4</option>
                                                <option value="Station Wagon">Station Wagon</option>
                                                <option value="Coupe/Sports">Lorries & Trucks</option>
                                                <option value="MPV">MPV</option>
                                                <option value="Convertible">Convertible</option>
                                                <option value="Boat">Boat</option>
                                                <option value="Speed Boat">Speed Boat</option>
                                                <option value="Yachts">Yachts</option>
                                                <option value="Ships">Ships</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Vehicle Brand</label>
                                            <select name="vehicle_brand" id="vehicle_brand" class="form-control">
                                                <option value="Toyota">Toyota</option>
                                                <option value="Nissan">Nissan</option>
                                                <option value="Suzuki">Suzuki</option>
                                                <option value="Honda">Honda</option>
                                                <option value="Mitsubishi">Mitsubishi</option>
                                                <option value="Mercedes_Benz">Mercedes Benz</option>
                                                <option value="Bmw">BMW</option>
                                                <option value="Land Rover">Land Rover</option>
                                                <option value="kia">Kia</option>
                                                <option value="Audi">Audi</option>
                                                <option value="Micro">Micro</option>
                                                <option value="Mahindra">Mahindra</option>
                                                <option value="hyundai">Hyundai</option>
                                                <option value="Daihatsu">Daihatsu</option>
                                                <option value="Peugeot">Peugeot</option>
                                                <option value="Perodua">Perodua</option>
                                                <option value="MG">MG</option>
                                                <option value="DFSK">DFSK</option>
                                                <option value="Mazda">Mazda</option>
                                                <option value="Ford">Ford</option>
                                                <option value="Maruti Suzuki">Maruti Suzuki</option>
                                                <option value="Tata">Tata</option>
                                                <option value="Volkswagen">Volkswagen</option>
                                                <option value="Jaguar">Jaguar</option>
                                                <option value="Renault">Renault</option>
                                                <option value="Porsche">Porsche</option>
                                                <option value="Mini">Mini</option>
                                                <option value="Isuzu">Isuzu</option>
                                                <option value="Morris">Morris</option>
                                                <option value="Chevrolet">Chevrolet</option>
                                                <option value="Datsun">Datsun</option>
                                                <option value="Daewoo">Daewoo</option>
                                                <option value="Proton">Proton</option>
                                                <option value="Ssang Yong">Ssang Yong</option>
                                                <option value="Austin">Austin</option>
                                                <option value="Jeep">Jeep</option>
                                                <option value="Zotye">Zotye</option>
                                                <option value="Subaru">Subaru</option>
                                                <option value="Fiat">Fiat</option>
                                                <option value="Lexus">Lexus</option>
                                                <option value="Tesla">Tesla</option>
                                                <option value="Alfa Romeo">Alfa Romeo</option>
                                                <option value="Maruti">Maruti</option>
                                                <option value="Aston Martin">Aston Martin</option>
                                                <option value="Chery">Chery</option>
                                                <option value="GMC">GMC</option>
                                                <option value="Maserati">Maserati</option>
                                                <option value="Rover">Rover</option>
                                                <option value="Volvo">Volvo</option>
                                                <option value="TVS">TVS</option>
                                                <option value="Hero">Hero</option>
                                                <option value="Bajaj">Bajaj</option>
                                                <option value="Yamaha">Yamaha</option>
                                                <option value="Kawasaki">Kawasaki</option>
                                                <option value="Ktm">KTM</option>
                                                <option value="Bayliner">Bayliner</option>
                                                <option value="Beneteau">Beneteau</option>
                                                <option value="Boston Whaler">Boston Whaler</option>
                                                <option value="Chaparral">Chaparral</option>
                                                <option value="Grady-White">Grady-White</option>
                                                <option value="Sea Ray">Sea Ray</option>
                                                <option value="Azimut">Azimut</option>
                                                <option value="Bennington">Bennington</option>
                                                <option value="Bertrams">Bertram</option>
                                                <option value="ALVA Yachts">ALVA Yachts</option>
                                                <option value="EICHER">EICHER</option>
                                                <option value="JCB">JCB</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Transmission</label>
                                            <select name="transmission" id="transmission" class="form-control" style="color: gray;">
                                                <option value="Automatic">Automatic</option>
                                                <option value="Manual">Manual</option>
                                                <option value="Tiptronic">Tiptronic</option>
                                                <option value="Other Transmission">Other Transmission</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Vehicle Model</label>
                                            <input type="text" class="form-control" id="model_vehicle" name="model_vehicle" placeholder="Wegon R 2016" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Color</label>
                                            <input type="text" class="form-control" id="color" name="color" placeholder="Color" style="color: gray;">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fual Type</label>
                                            <select name="fualtype" id="fualtype" class="form-control">
                                                <option value="petrol">Petrol</option>
                                                <option value="diesel">Diesel</option>
                                                <option value="hybrid">Hybrid</option>
                                                <option value="electric">Electric</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Meeter Reading</label>
                                            <input type="text" class="form-control" id="meeter_reading" name="meeter_reading" placeholder="12500" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">License Expiration Date</label>
                                            <input type="date" class="form-control" id="licen_expire_date" name="licen_expire_date" style="color: gray;">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Insurence Expiration Date</label>
                                            <input type="date" class="form-control" id="insurence_expire_date" name="insurence_expire_date" style="color: gray;">
                                        </div>

                                        <button class="btn btn-dark">Cancel</button>
                                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- myvehicles -->
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title mb-1">Vehicle</h4>
                                        <p class="text-muted mb-1">Actions</p>
                                        <p class="text-muted mb-1">Important data Sets</p>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach($myvehicles as $myvehicle)
                                            <div class="preview-list">
                                                <div class="preview-item border-bottom">
                                                    <div class="preview-thumbnail">
                                                        <div class="preview-icon bg-primary">
                                                            <i class="mdi mdi-file-document"></i>
                                                        </div>
                                                    </div>
                                                    <div class="preview-item-content d-sm-flex flex-grow">
                                                        <div class="flex-grow">
                                                            <h6 class="preview-subject">{{ $myvehicle->vehical_no  }}</h6>
                                                            <p class="text-muted mb-0">{{ $myvehicle->vehical_brand }}</p>
                                                            <p class="text-muted mb-0">{{ $myvehicle->vehical_model }}</p>
                                                            <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                                                <p class="text-muted mt-1">Licen Expire Date - {{ $myvehicle->licen_exp }}</p>
                                                            </div>

                                                        </div>
                                                        <div class="flex-grow">

                                                        </div>

                                                        @if ($myvehicle->per_day_rental != '')
                                                        <a class="btn btn-outline-success btn-fw" href="/vehicledetails/{{ $myvehicle->id }}">View Vehicle</a>
                                                        @else
                                                        <a href="vehicle/{{ $myvehicle->id }}" class="btn btn-warning">
                                                            Compleat Rental Information
                                                        </a>
                                                        <button href="vehicle/{{ $myvehicle->id }}" class="btn btn-outline-danger btn-fw">incompleted Profile</button>
                                                        @endif
                                                    </div>

                                                </div>

                                            </div>
                                            @endforeach
                                        </div>
                                        <a href="/vehiclelist" class="btn btn-outline-primary btn-fw">Load All Vehicle</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- end  -->




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
</x-app-layout>


<!-- Modal -->


<script>
    document.getElementById("phone_number").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>



<script>
    function refresh() {
        location.reload();
    }
</script>