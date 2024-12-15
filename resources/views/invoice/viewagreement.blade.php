<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div id="topline" style="margin-top: 100px; position: relative;"></div>

    <div class="bill" id="bill">

        <img src="{{ asset( $company->agreementsideone) }}" class="img-fluid" alt=""
            style="position: absolute; z-index: -1; top: 0; left: 0; width: 720px; height: auto;">

        @foreach ($alignments as $alignment)
        <label
            id="{{ $alignment->elementid }}"
            style="position: absolute; 
           top: {{ $alignment->element_top_possition !== null ? intval($alignment->element_top_possition) + 100 : 100 }}px; 
           left: {{ $alignment->element_left_possition }}px; 
           color: darkgray;font-size:12px;font-weight:bold;
           display: {{ $alignment->display }}; 
           ">
            {{ $alignment->elementid }}
        </label>
        @endforeach

        <img src="{{ asset( $company->agreementsidetwo) }}" class="img-fluid" alt=""
            style="position: relative; margin-top: 1000px; width: 720px; height: auto;">
    </div>

    <button class="btn btn-primary" onclick="printagreement()" style="position: absolute;  top: 350px; left: 1250px;">Print Agreement</button>


</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

<!-- Add this to your HTML file to include jQuery -->

<script>
    // Pass PHP data to a JavaScript variable
    const invoiceData = @json($invoice);
    const customerData = @json($customer);
    const vehicalData = @json($vehical);
    const bookingData = @json($bookingDetails);
    const companyData = @json($company);

    console.log(invoiceData);
    console.log(customerData);
    console.log(vehicalData);
    console.log(bookingData);
    console.log(companyData);

    document.getElementById('agreementid').innerHTML = invoiceData.id;
    document.getElementById('name').innerHTML = invoiceData.customername;
    document.getElementById('address').innerHTML = customerData.p_address;
    document.getElementById('tempaddress').innerHTML = customerData.t_address;
    document.getElementById('mobileno').innerHTML = customerData.telephone_no;
    // document.getElementById('fixcontact').innerHTML = customerData.telephone_no;
    document.getElementById('drivinglicen').innerHTML = customerData.drivinglicenseno;
    document.getElementById('nic').innerHTML = customerData.nic;
    document.getElementById('vehicleregno').innerHTML = invoiceData.vehicle_no;
    document.getElementById('vehiclemodel').innerHTML = vehicalData.vehical_model;
    document.getElementById('vehiclebrand').innerHTML = vehicalData.vehical_brand;
    document.getElementById('vehiclecolor').innerHTML = vehicalData.vehicle_color;
    document.getElementById('vehiclefulatype').innerHTML = vehicalData.fualtype;

    document.getElementById('witnessname').innerHTML = bookingData.witnessname;
    document.getElementById('witnessaddress').innerHTML = bookingData.witness_p_address;
    document.getElementById('witnessnic').innerHTML = bookingData.witnessnic;
    document.getElementById('witnesscontact').innerHTML = bookingData.witnesstelephone;

    document.getElementById('rl').innerHTML = vehicalData.revenuelicence;
    document.getElementById('ic').innerHTML = vehicalData.insurance_card;
    document.getElementById('em').innerHTML = vehicalData.emission_certificate;
    document.getElementById('sw').innerHTML = vehicalData.spare_wheel;
    document.getElementById('jk').innerHTML = vehicalData.jack;
    document.getElementById('wb').innerHTML = vehicalData.wheel_brush;

    document.getElementById('checkoutmeeter').innerHTML = invoiceData.starting_meeter + 'Km';
    document.getElementById('fuallevel').innerHTML = invoiceData.fual_level;

    var startdate = bookingData.book_start_date;
    var enddate = bookingData.return_date;


    var startdate = bookingData.book_start_date; // Example: "2024-11-01"
    var enddate = bookingData.return_date; // Example: "2024-11-05"

    // Convert to Date objects
    var start = new Date(startdate);
    var end = new Date(enddate);

    // Calculate the difference in time (milliseconds)
    var differenceInTime = end.getTime() - start.getTime();

    // Calculate the difference in days
    var differenceInDays = differenceInTime / (1000 * 3600 * 24);

    var bookedDateCount = differenceInDays;


    document.getElementById('totaldaycount').innerHTML = bookedDateCount;

    document.getElementById('perdayprice').innerHTML = companyData.currency+ ' '+invoiceData.rate ;

    var totaldue = bookedDateCount * invoiceData.rate;

    document.getElementById('depositpay').innerHTML = companyData.currency+ ' '+invoiceData.advance_charge ;
    document.getElementById('totaldue').innerHTML = companyData.currency+ ' '+totaldue;
    document.getElementById('free_per_day').innerHTML = vehicalData.per_day_free_duration + 'km';
    document.getElementById('addtionel_price').innerHTML = companyData.currency+ ' '+vehicalData.addtional_per_mile_cost ;

    document.getElementById('pickdateandtime').innerHTML = bookingData.book_start_date + ' ' + bookingData.pick_time;
    document.getElementById('returndateandtime').innerHTML = bookingData.return_date + ' ' + bookingData.return_time;
    // You can now use invoiceData in your JavaScript code
</script>

<script>
    function printagreement() {
        var content = document.getElementById('bill').innerHTML;

        // Open a new window
        var printWindow = window.open('', '_blank', 'width=720,height=auto');
        printWindow.document.open();
        printWindow.document.write(`
        <html>
            <head>
                <title>Print Agreement</title>
                <style>
                    /* Add custom styles for printing */
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .img-fluid {
                        position: absolute;
                        z-index: -1;
                        top: 0;
                        left: 0;
                        width: 720px;
                        height: auto;
                    }
                    .bill {
                        position: relative;
                        width: 720px;
                        height: auto;
                    }
                </style>
            </head>
            <body>
                <div class="bill">
                    ${content} 
                </div>
                
            </body>
        </html>
    `);

        // Wait for the content to load before printing
        printWindow.document.close();
        printWindow.onload = function() {
            printWindow.print();
            printWindow.close();
        };
    }
</script>



<!-- Add this to your HTML file to include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>