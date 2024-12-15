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

        <label id="agreementid" style="position: absolute;  top: 75px; left: 750px;">
            $agreementid
        </label>

        <label id="name" style="position: absolute;  top: 100px; left: 750px;">
            $name
        </label>
        <label id="address" style=" position: absolute;  top: 125px; left: 750px;">
            $per_address
        </label>
        <label id="tempaddress" style=" position: absolute;  top: 150px; left: 750px;">
            $tempaddress
        </label>
        <label id="mobileno" style=" position: absolute;  top: 175px; left: 750px;">
            $mobileno
        </label>
        <label id="fixcontact" style=" position: absolute;  top: 200px; left: 750px;">
            $fixnumber
        </label>
        <label id="drivinglicen" style=" position: absolute;  top: 225px; left: 750px;">
            $driving_licen
        </label>
        <label id="nic" style=" position: absolute;  top: 250px; left: 750px;">
            $nic
        </label>

        <label id="witnessname" style=" position: absolute;  top: 300px; left: 750px;">
            $witnessname
        </label>
        <label id="witnessnic" style=" position: absolute;  top: 325px; left: 750px;">
            $witnessnic
        </label>
        <label id="witnessaddress" style=" position: absolute;  top: 350px; left: 750px;">
            $witnessaddress
        </label>
        <label id="witnesscontact" style=" position: absolute;  top: 375px; left: 750px;">
            $witnescontactno
        </label>

        <label id="vehicleregno" style=" position: absolute;  top: 425px; left: 750px;">
            $vehicleregisterno
        </label>
        <label id="vehiclemodel" style=" position: absolute;  top: 450px; left: 750px;">
            $vehiclemodel
        </label>
        <label id="vehiclebrand" style=" position: absolute;  top: 475px; left: 750px;">
            $vehiclebrand
        </label>
        <label id="vehiclecolor" style=" position: absolute;  top: 500px; left: 750px;">
            $vehiclecolor
        </label>
        <label id="vehiclefulatype" style=" position: absolute;  top: 525px; left: 750px;">
            $vehiclefualtype
        </label>

        <label id="rl" style=" position: absolute;  top: 575px; left: 750px;">
            $RL
        </label>
        <label id="ic" style=" position: absolute;  top: 600px; left: 750px;">
            $IC
        </label>
        <label id="em" style=" position: absolute;  top: 625px; left: 750px;">
            $EM
        </label>
        <label id="sw" style=" position: absolute;  top: 650px; left: 750px;">
            $SW
        </label>
        <label id="jk" style=" position: absolute;  top: 675px; left: 750px;">
            $JK
        </label>
        <label id="wb" style=" position: absolute;  top: 700px; left: 750px;">
            $WB
        </label>

        <label id="checkoutmeeter" style=" position: absolute;  top: 750px; left: 750px;">
            $Checkout Meeter Reading
        </label>
        <label id="fuallevel" style=" position: absolute;  top: 775px; left: 750px;">
            $Fual Level
        </label>

        <label id="totaldaycount" style="position: absolute;  top: 100px; left: 1250px;">
            $Total Days Count
        </label>
        <label id="perdayprice" style="position: absolute;  top: 125px; left: 1250px;">
            $Price Per Day
        </label>
        <label id="depositpay" style="position: absolute;  top: 150px; left: 1250px;">
            $Deposit pay or details
        </label>
        <label id="totaldue" style="position: absolute;  top: 175px; left: 1250px;">
            $Total Due
        </label>
        <label id="unlimited" style="position: absolute;  top: 200px; left: 1250px;">
            $unlimited
        </label>
        <label id="free_per_day" style="position: absolute;  top: 225px; left: 1250px;">
            $free per day
        </label>
        <label id="addtionel_price" style="position: absolute;  top: 250px; left: 1250px;">
            $price for addtional
        </label>
        <label id="pickdateandtime" style="position: absolute;  top: 275px; left: 1250px;">
            $pick date and time
        </label>
        <label id="returndateandtime" style="position: absolute;  top: 300px; left: 1250px;">
            $return date and time
        </label>

        <button class="btn btn-primary" onclick="savePositions()" style="position: absolute;  top: 350px; left: 1250px;">Get Possitions</button>
        <button onclick="printbill()" class="btn btn-primary" style="position: absolute;  top: 350px; left: 1450px;">Print</button>


    </div>



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
    function makeDraggable(elementId) {
        const element = document.getElementById(elementId);
        const topline = document.getElementById('topline');
        let offsetX = 0;
        let offsetY = 0;
        let isDragging = false;

        // Function to get position relative to 'topline'
        function logRelativePosition() {
            const toplineRect = topline.getBoundingClientRect();
            const elementRect = element.getBoundingClientRect();

            const relativeLeft = elementRect.left - toplineRect.left;
            const relativeTop = elementRect.top - toplineRect.top;
            const relativeRight = toplineRect.right - elementRect.right;
            const relativeBottom = toplineRect.bottom - elementRect.bottom;

            console.log(`Position of ${elementId} relative to 'topline': 
            Left: ${relativeLeft}px, 
            Top: ${relativeTop}px, 
            Right: ${relativeRight}px, 
            Bottom: ${relativeBottom}px`);

            // Optional: Store the relative position in the element's data attributes
            element.dataset.relativeLeft = relativeLeft;
            element.dataset.relativeTop = relativeTop;
        }

        // Start dragging
        element.addEventListener('mousedown', (e) => {
            isDragging = true;
            offsetX = e.clientX - element.getBoundingClientRect().left;
            offsetY = e.clientY - element.getBoundingClientRect().top;
            element.style.cursor = 'grabbing';
        });

        // Drag the element
        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                element.style.left = `${e.clientX - offsetX}px`;
                element.style.top = `${e.clientY - offsetY}px`;
            }
        });

        // Stop dragging and log position
        document.addEventListener('mouseup', () => {
            if (isDragging) {
                isDragging = false;
                element.style.cursor = 'grab';
                logRelativePosition();
            }
        });
    }

    // List of all draggable element IDs
    const elementIds = [
        'agreementid','name', 'address', 'tempaddress', 'mobileno', 'fixcontact', 'drivinglicen', 'nic',
        'witnessname', 'witnessnic', 'witnessaddress', 'witnesscontact', 'vehicleregno',
        'vehiclemodel', 'vehiclebrand', 'vehiclecolor', 'vehiclefulatype', 'rl', 'ic',
        'em', 'sw', 'jk', 'wb', 'checkoutmeeter', 'fuallevel', 'totaldaycount',
        'perdayprice', 'depositpay', 'totaldue', 'unlimited', 'free_per_day',
        'addtionel_price', 'pickdateandtime', 'returndateandtime'
    ];

    // Initialize makeDraggable for each element
    elementIds.forEach(makeDraggable);
</script>

<script>
    function savePositions() {
        // Get the topline element's position
        const topline = document.getElementById('topline');
        if (!topline) {
            console.error("Topline element not found.");
            return;
        }



        const toplineRect = topline.getBoundingClientRect();

        // List of IDs for elements you want to capture
        const elementIds = [
            'agreementid','name', 'address', 'tempaddress', 'mobileno', 'fixcontact',
            'drivinglicen', 'nic', 'witnessname', 'witnessnic',
            'witnessaddress', 'witnesscontact', 'vehicleregno',
            'vehiclemodel', 'vehiclebrand', 'vehiclecolor', 'vehiclefulatype',
            'rl', 'ic', 'em', 'sw', 'jk', 'wb', 'checkoutmeeter',
            'fuallevel', 'totaldaycount', 'perdayprice', 'depositpay',
            'totaldue', 'unlimited', 'free_per_day', 'addtionel_price',
            'pickdateandtime', 'returndateandtime'
        ];

        // Object to store relative positions
        const positions = {};

        // Iterate through each element ID
        elementIds.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                const elementRect = element.getBoundingClientRect();
                // Calculate relative top and left positions
                const relativeTop = elementRect.top - toplineRect.top;
                const relativeLeft = elementRect.left - toplineRect.left;

                // Store positions
                positions[id] = {
                    top: relativeTop,
                    left: relativeLeft
                };



            } else {
                console.warn(`Element with ID ${id} not found.`);
            }
        });



        // AJAX request to send data to the backend
        $.ajax({
            url: '/saveagreementpossition', // Replace with your actual endpoint
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(positions),
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') // CSRF protection for Laravel
            },
            success: function(response) {
                console.log('Positions saved successfully:', response);
                alert('Positions have been saved successfully!');
            },

        });

    }

    function printbill() {
        // Get the content of the invoicedisplay div
        var content = document.getElementById('bill').innerHTML;

        // Create a new window or iframe to hold the content
        var restorePage = document.body.innerHTML;
        var printWindow = window.open('', '_blank', 'width=219.21259843px,height=auto');
        printWindow.document.open();
        printWindow.document.write(`
            <html>
                <head>
                    <title>Invoice</title>
                </head>
                <body>
                    
                    <div class="invoice-body">
                        ${content} <!-- Insert the invoicedisplay content -->
                    </div>
                   
                </body>
            </html>
        `);


        printWindow.print();

        document.body.innerHTML = restorePage;
    }
</script>


<!-- Add this to your HTML file to include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>