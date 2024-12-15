<?php

namespace App\Http\Controllers;

use App\Models\Billalignment;
use App\Models\Booking;
use App\Models\Cashflote;
use App\Models\Company;
use App\Models\Companyaccount;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Pnl;
use App\Models\Vehical;
use App\Models\Vehicle_has_booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class InvoiceController extends Controller
{

    public function index()
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $userid = Auth::user()->id;
            $companyid = Auth::user()->company_id;

            $avalibleVehicles = Vehical::where('avalibility', 'yes')->where('company_id', $companyid)->get();

            $bookings = Vehicle_has_booking::join('customers', 'vehicle_has_bookings.customer_id', '=', 'customers.id')
                ->where('vehicle_has_bookings.status', 'pending') // Adjust column name as per your table schema
                ->where('vehicle_has_bookings.company_id', $companyid)
                ->select('vehicle_has_bookings.*', 'customers.full_name', 'customers.telephone_no', 'customers.nic')
                ->get();

            $invoicereqbookings = Vehicle_has_booking::join('customers', 'vehicle_has_bookings.customer_id', '=', 'customers.id')
                ->where('vehicle_has_bookings.status', 'Invoice Request') // Adjust column name as per your table schema
                ->where('vehicle_has_bookings.company_id', $companyid)
                ->select('vehicle_has_bookings.*', 'customers.full_name', 'customers.telephone_no', 'customers.nic')
                ->get();

            return view('invoice.newinvoice', compact('bookings', 'avalibleVehicles', 'invoicereqbookings'));
        }
    }

    public function saveinvoice(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;
        $booking_record = $request->booking_record;
        // Validate the request data
        $request->validate([
            'nic' => 'required|string|max:255',
            'drivinglicenseno' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'contactno' => 'required|string|max:20',
            'issue_date' => 'required|date',
            'issue_time' => 'required|string|max:10',
            'wheretogo' => 'required|string|max:255',
            'booking_return_date' => 'required|date',
            'booking_return_time' => 'required|string|max:10',
            'booking_return_location' => 'required|string|max:255',
            'hiretypr' => 'required|string|max:50',
            'note' => 'nullable|string|max:1000'
        ]);

        $isbookingRecord = $request->booking_record;

        if ($isbookingRecord == '0') {
            $customer = new Customer();

            $customer->user_id = $userid;
            $customer->company_id = $companyid;
            $customer->full_name = $request->customer_name;
            $customer->reg_date = $date;
            $customer->nic = $request->nic;
            $customer->drivinglicenseno = $request->drivinglicenseno;
            $customer->telephone_no = $request->contactno;
            $customer->p_address = $request->paddress;
            $customer->t_address = $request->taddress;
            // $customer->address_line_one = $request->addresslinetwo;
            // $customer->city = $request->city;

            $customer->save();
            $customer_id = $customer->id;

            $booking = new Booking();
            $booking->user_id = $userid;
            $booking->company_id = $companyid;
            $booking->vehicle_no = $request->vehicleNo;
            $booking->book_date = $request->issue_date;
            $booking->pick_time = $request->picktime;
            $booking->booked_date = $date;
            $booking->booked_time = $date;
            $booking->customer_name = $request->customer_name;
            $booking->customer_id  = $customer_id;
            $booking->save();

            $customerAccount = new CustomerAccount();
            $customerAccount->company_id = $companyid;
            $customerAccount->user_id = $userid;
            $customerAccount->customer_id = $customer_id;
            $customerAccount->accountbalance = 0;

            $customerAccount->save();

            $vehiclehasBooking = new Vehicle_has_booking();
            $vehiclehasBooking->user_id = $userid;
            $vehiclehasBooking->company_id = $companyid;

            $vehiclehasBooking->vehicle_no = $request->vehicleNo;
            $vehiclehasBooking->book_start_date = $request->issue_date;
            $vehiclehasBooking->pick_time = $request->issue_time;
            $vehiclehasBooking->pick_location = 'Office';
            $vehiclehasBooking->wheretogo = $request->wheretogo;
            $vehiclehasBooking->return_date = $request->booking_return_date;
            $vehiclehasBooking->return_time = $request->booking_return_time;
            $vehiclehasBooking->return_location = $request->booking_return_location;
            $vehiclehasBooking->book_time = $date;
            $vehiclehasBooking->isdriver = $request->hiretypr;
            $vehiclehasBooking->hire_location = $request->wheretogo;
            $vehiclehasBooking->status = 'Invoice Request';
            $vehiclehasBooking->note = $request->note;
            $vehiclehasBooking->customer_id = $customer_id;
            $vehiclehasBooking->witnessname = $request->witnessname;
            $vehiclehasBooking->witness_p_address = $request->witness_p_address;
            $vehiclehasBooking->witnessnic = $request->witnessnic;
            $vehiclehasBooking->witnesstelephone = $request->witnesstelephone;

            $vehiclehasBooking->save();
            return response()->json(['message' => 'update successfully!'], 201);
        } else {
            $id = $booking_record;

            $vehiclebooking = Vehicle_has_booking::find($id);
            if ($vehiclebooking) {
                $vehiclebooking->status = 'Invoice Request';
                $vehiclebooking->save();

                $customer = Customer::where('id', $vehiclebooking->customer_id)->first();
                // $customer->street = $request->street;
                // $customer->address_line_one = $request->addresslinetwo;
                // $customer->city = $request->city;

                $customer->save();

                return response()->json(['message' => 'update successfully!'], 201);
            }
        }
        // Return a success response

    }

    public function saveadvanceinvoice(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');
        $month = Carbon::now()->format('Y-m');
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;
        $datetime = Carbon::now()->format('Y-m-d H:i:s');



        // comapny details 
        $comapnyDetails = Company::where('id', $companyid)->get();
        foreach ($comapnyDetails as $companyDetail) {
            $companyName = $companyDetail->name;
            $address = $companyDetail->address;
            $mobile_whatsapp = $companyDetail->mobile_number;
            $contactno = $companyDetail->contact_no;
            $website = $companyDetail->website;
            $email = $companyDetail->email;
            $companylogo = $companyDetail->logo;
        }
        // End 

        $html = '';

        $company = $comapnyDetails;

        $vehicle_no = '';
        $customer_id = '';
        $renttype = '';
        $customername = '';
        $addtionalmilecharges = '';

        $advancepayment = $request->advance;
        $deposittype = $request->deposittype;
        $outmeeter = $request->outmeeterreading;
        $description = $request->description;
        $bookingid = $request->bookingid;
        $id = $bookingid;
        $issutype = $request->issutype;
        $firstpayment = $request->firstpayment;
        $expected_discount = $request->expected_discount;
        $deliverycharges = $request->deliverycharges;
        $fual_level = $request->fual_level;
        $datecount = $request->datecount;
        $allc_price = $request->allc_price;
        $amountoftotal = $request->amountoftotal;
        $freeissueduration = $request->freeissueduration;
        $firstpaid = $request->firstpaid;
        $deliverypaid = $request->deliverypaid;

        $firstpaymentbalance = $firstpayment - $firstpaid - $expected_discount;
        $deliverybalance = $deliverycharges - $deliverypaid;

        // get booking details 
        $bookingDetails = Vehicle_has_booking::where('id', $id)->get();
        foreach ($bookingDetails as $booking) {
            $vehicle_no = $booking->vehicle_no;
            $customer_id = $booking->customer_id;
            $renttype = $booking->isdriver;
        }
        // End 

        // customer details 
        $customerDetails  = Customer::where('id', $customer_id)->get();
        foreach ($customerDetails as $customerdetail) {
            $customername = $customerdetail->full_name;
            $driving_licen_photo = $customerdetail->driving_licen_photo;
            $livingvarification = $customerdetail->livingvarification;
            $customer_photo = $customerdetail->customer_photo;
        }
        // End 

        if ($driving_licen_photo != '' && $livingvarification != '' && $customer_photo != '') {
            $customerc = Customer::where('id', $customer_id)->first();

            // get vehicle details 
            $vehicleDetails  = Vehical::where('vehical_no', $vehicle_no)->get();

            foreach ($vehicleDetails as $vehicledetail) {
                $addtionalmilecharges = $vehicledetail->addtional_per_mile_cost;
            }
            // End 

            $invoice = new Invoice();

            $invoice->user_id = $userid;
            $invoice->company_id = $companyid;
            $invoice->customer_id = $customer_id;
            $invoice->guarantor_id = 0;
            $invoice->bookingid = $bookingid;
            $invoice->customername = $customername;
            $invoice->starting_meeter = $outmeeter;
            $invoice->endmeeter = '';
            $invoice->type_of_rent = $renttype;
            $invoice->addtional_mile_chargers = $addtionalmilecharges;
            $invoice->vehicle_no = $vehicle_no;
            $invoice->extra_charges = 0;
            $invoice->extra_for_description = '';
            $invoice->description = $description;
            $invoice->advance_charge = $advancepayment;
            $invoice->total_bill = 0;
            $invoice->discount = $expected_discount;
            $invoice->net_total = 0;
            $invoice->invoice_date = $date;
            $invoice->invoice_status = 'ongoing';
            $invoice->invoice_compleat_date = '';
            $invoice->issue_type = $issutype;
            $invoice->expected_discount = $expected_discount;
            $invoice->deliverycharges = $deliverycharges;
            $invoice->firstpayment = $firstpayment;
            $invoice->fual_level = $fual_level;
            $invoice->date_count = $datecount;
            $invoice->rate = $allc_price;
            $invoice->deside_total = $amountoftotal;
            $invoice->free_issued_duration = $freeissueduration;
            $invoice->first_payment_balance = $firstpaymentbalance;
            $invoice->delivery_payment_balance = $deliverybalance;

            $invoice->save();

            $invoiceid = $invoice->id;

            $vehicle = Vehical::where('vehical_no', $vehicle_no)->first();
            $vehicle->avalibility = 'no';
            $vehicle->save();

            $advance_account = Companyaccount::where('company_id', $companyid)->where('account_type', 'advance_account')->first();
            $advance_account->amount = $advance_account->amount + $advancepayment;
            $advance_account->save();

            $mainaccount = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
            $mainaccount->amount = $mainaccount->amount + $firstpayment + $deliverycharges;
            $mainaccount->save();

            $payment = new Payment();
            $payment->company_id = $companyid;
            $payment->user_id = $userid;
            $payment->amount = 0;
            $payment->description = 'Advance Payment for Agreement No ' . $invoiceid . ' ' . 'Created For ' . $customername;
            $payment->payamount = $advancepayment;
            $payment->balance = 0;
            $payment->paytype = $deposittype;
            $payment->date_time = $date;
            $payment->payment_type = 'Advance payment';
            $payment->month = $month;
            $payment->invoiceid = $invoiceid;
            $payment->paystatus = 'compleat';

            if ($firstpaid != 0) {

                $lastBalance = Pnl::where('company_id', $companyid)
                    ->orderBy('id', 'desc')
                    ->value('balance');

                $newbalance = $lastBalance + $firstpaid;

                $pnlfirstpayment = new Pnl();
                $pnlfirstpayment->description = 'First Payment.Agreement No - ' . $invoiceid;
                $pnlfirstpayment->credit = $firstpaid;
                $pnlfirstpayment->debit = 0;
                $pnlfirstpayment->date_time = $date;
                $pnlfirstpayment->balance = $newbalance;
                $pnlfirstpayment->company_id = $companyid;
                $pnlfirstpayment->type = 'Income';

                $pnlfirstpayment->save();

                $paymentfirst = new Payment();
                $paymentfirst->company_id = $companyid;
                $paymentfirst->user_id = $userid;
                $paymentfirst->amount = 0;
                $paymentfirst->description = 'First Payment for Agreement No ' . $invoiceid . ' ' . ' Created For' . $customername;
                $paymentfirst->payamount = $firstpaid;
                $paymentfirst->balance = 0;
                $paymentfirst->paytype = 'First Payment';
                $paymentfirst->date_time = $date;
                $paymentfirst->payment_type = 'First pay';
                $paymentfirst->month = $month;
                $paymentfirst->invoiceid = $invoiceid;
                $paymentfirst->paystatus = 'compleat';
                $paymentfirst->save();
            }

            if ($deliverypaid != 0) {
                $lastBalance = Pnl::where('company_id', $companyid)
                    ->orderBy('id', 'desc')
                    ->value('balance');

                $newbalance = $lastBalance + $deliverypaid;

                $pnlfirstpayment = new Pnl();
                $pnlfirstpayment->description = 'Delivery Charges.Agreement No - ' . $invoiceid;
                $pnlfirstpayment->credit = $deliverypaid;
                $pnlfirstpayment->debit = 0;
                $pnlfirstpayment->date_time = $date;
                $pnlfirstpayment->balance = $newbalance;
                $pnlfirstpayment->company_id = $companyid;
                $pnlfirstpayment->type = 'Income';

                $pnlfirstpayment->save();

                $paymentdelivery = new Payment();
                $paymentdelivery->company_id = $companyid;
                $paymentdelivery->user_id = $userid;
                $paymentdelivery->amount = 0;
                $paymentdelivery->description = 'Delivery Payment for Agreement No ' . $invoiceid . ' ' . ' Created For' . $customername;
                $paymentdelivery->payamount = $deliverypaid;
                $paymentdelivery->balance = 0;
                $paymentdelivery->paytype = 'Delivery Payment';
                $paymentdelivery->date_time = $date;
                $paymentdelivery->payment_type = 'Delivery pay';
                $paymentdelivery->month = $month;
                $paymentdelivery->invoiceid = $invoiceid;
                $paymentdelivery->paystatus = 'compleat';
                $paymentdelivery->save();
            }


            // $payment->save();

            if ($advancepayment == '0') {
            } else {

                $customeraccount = CustomerAccount::where('customer_id', $customer_id)->first();
                $accountbalancenow = $customeraccount->accountbalance;

                if (is_null($accountbalancenow)) {
                    $accountbalancenow = 0;
                }

                $cashflote = new Cashflote();
                $starttype = 'credit';
                if ($starttype == 'credit') {
                    $accountbalance  = $accountbalancenow;
                    $crediamount =  $advancepayment;
                    $debitamount = 0;
                    $balance = $advancepayment;
                }
                if ($starttype == 'debit') {
                    $accountbalance  = $accountbalance + $advancepayment;
                    $crediamount =  0;
                    $debitamount = $advancepayment;
                    $balance = $accountbalancenow + $advancepayment;
                }

                $customeraccount->accountbalance = $accountbalancenow + $advancepayment;
                $customeraccount->save();

                $cashflote = new cashflote();

                $topic = 'Advance Payment';

                $cashflote->company_id = $companyid;
                $cashflote->user_id = $userid;
                $cashflote->customer_id = $customer_id;
                $cashflote->accountbalance = $balance;
                $cashflote->date_time = $datetime;
                $cashflote->credit = $crediamount;
                $cashflote->debit = $debitamount;
                $cashflote->note = $topic;
                $cashflote->description = 'Advance Payment for Agreement No ' . $invoiceid . ' ' . 'Created For ' . $customername;
                $cashflote->ref = $invoiceid;

                $cashflote->save();

                $advance_account = Companyaccount::where('company_id', $companyid)->where('account_type', 'advance_account')->first();
                $advance_account->amount = $advance_account->amount + $advancepayment;
                $advance_account->save();

                $mainaccount = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
                $mainaccount->amount = $mainaccount->amount + $firstpaid + $deliverycharges;
                $mainaccount->save();
            }


            if ($invoice) {
                $booking = Vehicle_has_booking::find($id);
                $booking->status = "invoiced";
                $booking->save();

                // return view('invoice.viewagreement', compact('invoice', 'company'));

                return response()->json(['message' => 'Invoice save successfull', 'invoice' => $invoice], 201);
            }
        } else {
            $uploadPath = "uploads/";
            $customerfilepath = '';
            $drivinglicenfilepath = '';
            $verificationfilepath = '';

            if ($request->hasFile('customerphoto')) {
                $file = $request->file('customerphoto');
                $fileName = $file->getClientOriginalName();
                $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
                $fileType = $file->getClientOriginalExtension();


                // Allow certain file formats
                $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
                if (in_array($fileType, $allowTypes)) {
                    $customercompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($customercompressedImage) {
                        $customerfilepath = $customercompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compress failed!";
                    }
                } else {
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                }
            }

            if ($request->hasFile('drivinglicensephoto')) {
                $file = $request->file('drivinglicensephoto');
                $fileName = $file->getClientOriginalName();
                $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
                $fileType = $file->getClientOriginalExtension();

                // Allow certain file formats
                $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
                if (in_array($fileType, $allowTypes)) {
                    $drivinglicencompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($drivinglicencompressedImage) {
                        $drivinglicenfilepath = $drivinglicencompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compress failed!";
                    }
                } else {
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                }
            }

            if ($request->hasFile('livingverification')) {
                $file = $request->file('livingverification');
                $fileName = $file->getClientOriginalName();
                $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
                $fileType = $file->getClientOriginalExtension();

                // Allow certain file formats
                $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
                if (in_array($fileType, $allowTypes)) {
                    $livingverificationcompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($livingverificationcompressedImage) {
                        $verificationfilepath = $livingverificationcompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compress failed!";
                    }
                } else {
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                }
            }

            $customerc = Customer::where('id', $customer_id)->first();

            // get vehicle details 
            $vehicleDetails  = Vehical::where('vehical_no', $vehicle_no)->get();

            foreach ($vehicleDetails as $vehicledetail) {
                $addtionalmilecharges = $vehicledetail->addtional_per_mile_cost;
            }
            // End 

            $invoice = new Invoice();

            $invoice->user_id = $userid;
            $invoice->company_id = $companyid;
            $invoice->customer_id = $customer_id;
            $invoice->guarantor_id = 0;
            $invoice->bookingid = $bookingid;
            $invoice->customername = $customername;
            $invoice->starting_meeter = $outmeeter;
            $invoice->endmeeter = '';
            $invoice->type_of_rent = $renttype;
            $invoice->addtional_mile_chargers = $addtionalmilecharges;
            $invoice->vehicle_no = $vehicle_no;
            $invoice->extra_charges = 0;
            $invoice->extra_for_description = '';
            $invoice->description = $description;
            $invoice->advance_charge = $advancepayment;
            $invoice->total_bill = 0;
            $invoice->discount = 0;
            $invoice->net_total = 0;
            $invoice->invoice_date = $date;
            $invoice->invoice_status = 'ongoing';
            $invoice->invoice_compleat_date = '';
            $invoice->issue_type = $issutype;
            $invoice->expected_discount = $expected_discount;
            $invoice->deliverycharges = $deliverycharges;
            $invoice->firstpayment = $firstpayment;
            $invoice->fual_level = $fual_level;
            $invoice->date_count = $datecount;
            $invoice->rate = $allc_price;
            $invoice->deside_total = $amountoftotal;
            $invoice->free_issued_duration = $freeissueduration;
            $invoice->first_payment_balance = $firstpaymentbalance;
            $invoice->delivery_payment_balance = $deliverybalance;

            $invoice->save();

            $invoiceid = $invoice->id;

            $vehicle = Vehical::where('vehical_no', $vehicle_no)->first();
            $vehicle->avalibility = 'no';
            $vehicle->save();

            $payment = new Payment();
            $payment->company_id = $companyid;
            $payment->user_id = $userid;
            $payment->amount = 0;
            $payment->description = 'Advance Payment for Agreement No ' . $invoiceid . ' ' . 'Created For ' . $customername;
            $payment->payamount = $advancepayment;
            $payment->balance = 0;
            $payment->paytype = 'Refundable Deposit';
            $payment->date_time = $date;
            $payment->payment_type = 'Advance pay';
            $payment->month = $month;
            $payment->invoiceid = $invoiceid;
            $payment->paystatus = 'compleat';
            $payment->save();

            $advance_account = Companyaccount::where('company_id', $companyid)->where('account_type', 'advance_account')->first();
            $advance_account->amount = $advance_account->amount + $advancepayment;
            $advance_account->save();

            $mainaccount = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
            $mainaccount->amount = $mainaccount->amount + $firstpaid + $deliverycharges;
            $mainaccount->save();

            $customerc->driving_licen_photo = $drivinglicenfilepath;
            $customerc->livingvarification = $verificationfilepath;
            $customerc->customer_photo =  $customerfilepath;

            $customerc->save();

            if ($firstpaid != 0) {

                $lastBalance = Pnl::where('company_id', $companyid)
                    ->orderBy('id', 'desc')
                    ->value('balance');

                $newbalance = $lastBalance + $firstpaid;

                $pnlfirstpayment = new Pnl();
                $pnlfirstpayment->description = 'First Payment.Agreement No -' . $invoiceid;
                $pnlfirstpayment->credit = $firstpaid;
                $pnlfirstpayment->debit = 0;
                $pnlfirstpayment->date_time = $date;
                $pnlfirstpayment->balance = $newbalance;
                $pnlfirstpayment->company_id = $companyid;
                $pnlfirstpayment->type = 'Income';

                $pnlfirstpayment->save();

                $paymentfirst = new Payment();
                $paymentfirst->company_id = $companyid;
                $paymentfirst->user_id = $userid;
                $paymentfirst->amount = 0;
                $paymentfirst->description = 'First Payment for Agreement No ' . $invoiceid . ' ' . ' Created For ' . $customername;
                $paymentfirst->payamount = $firstpaid;
                $paymentfirst->balance = 0;
                $paymentfirst->paytype = 'First Payment';
                $paymentfirst->date_time = $date;
                $paymentfirst->payment_type = 'First pay';
                $paymentfirst->month = $month;
                $paymentfirst->invoiceid = $invoiceid;
                $paymentfirst->paystatus = 'compleat';
                $paymentfirst->save();
            }

            if ($deliverypaid != 0) {
                $lastBalance = Pnl::where('company_id', $companyid)
                    ->orderBy('id', 'desc')
                    ->value('balance');

                $newbalance = $lastBalance + $deliverypaid;

                $pnlfirstpayment = new Pnl();
                $pnlfirstpayment->description = 'Delivery Charges.Agreement No -' . $invoiceid;
                $pnlfirstpayment->credit = $deliverypaid;
                $pnlfirstpayment->debit = 0;
                $pnlfirstpayment->date_time = $date;
                $pnlfirstpayment->balance = $newbalance;
                $pnlfirstpayment->company_id = $companyid;
                $pnlfirstpayment->type = 'Income';

                $pnlfirstpayment->save();

                $paymentdelivery = new Payment();
                $paymentdelivery->company_id = $companyid;
                $paymentdelivery->user_id = $userid;
                $paymentdelivery->amount = 0;
                $paymentdelivery->description = 'Delivery Payment for Agreement No ' . $invoiceid . ' ' . ' Created For ' . $customername;
                $paymentdelivery->payamount = $deliverypaid;
                $paymentdelivery->balance = 0;
                $paymentdelivery->paytype = 'Delivery Pay';
                $paymentdelivery->date_time = $date;
                $paymentdelivery->payment_type = 'Delivery pay';
                $paymentdelivery->month = $month;
                $paymentdelivery->invoiceid = $invoiceid;
                $paymentdelivery->paystatus = 'compleat';
                $paymentdelivery->save();
            }

            if ($invoice) {
                $booking = Vehicle_has_booking::find($id);
                $booking->status = "invoiced";
                $booking->save();

                return response()->json(['message' => 'Invoice create successfully', 'invoice' => $invoice], 201);
                // return response($html)->header('Content-Type', 'text/html');
            }
        }
    }

    function viewAgreement(Request $request)
    {
        $invoiceid = $request->id;
        $companyid = Auth::user()->company_id;

        $company = Company::where('id', $companyid)->first();
        $invoice = Invoice::where('id', $invoiceid)->first();
        $alignments = Billalignment::where('company_id', $companyid)->get();

        $currency = $company->currency;

        $customerid = $invoice->customer_id;
        $vehicleRegno = $invoice->vehicle_no;
        $bookingid = $invoice->bookingid;

        $customer = Customer::where('id', $customerid)->first();
        $vehical = Vehical::where('vehical_no', $vehicleRegno)->first();
        $bookingDetails = Vehicle_has_booking::where('id', $bookingid)->first();

        return view('invoice.viewagreement', compact('company', 'invoice', 'alignments', 'customer', 'vehical', 'bookingDetails', 'currency'));
    }

    public function viewInvoiceReport(Request $request)
    {
        $invoiceid = $request->id;
        $companyid = Auth::user()->company_id;
        $invoice = Invoice::where('id', $invoiceid)->first();
        $company = Company::where('id', $companyid)->first();

        return view('invoice.viewinvoicereport', compact('company', 'invoice'));
    }

    function convert_filesize($bytes, $decimals = 2)
    {
        $size = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    function compressImage($source, $destination, $quality)
    {
        // Get image info
        $imgInfo = getimagesize($source);
        $mime = $imgInfo['mime'];

        // Create a new image from file
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
            default:
                return false; // Unsupported image type
        }

        // Save image
        imagejpeg($image, $destination, $quality);

        // Free up memory
        imagedestroy($image);

        // Return compressed image
        return $destination;
    }

    public function cancelInvoice(Request $request)
    {
        $id = $request->invoiceId;

        $invoice = Invoice::find($id);
        $vehicalNo = $invoice->vehicle_no;
        if ($invoice) {
            $invoicestate = $invoice->invoice_status;
            $bookingid = $invoice->bookingid;

            $payment = Payment::where('invoiceid', $id)->first();
            // $vehicle = Vehical::where('vehical_no', $vehicalNo)->first();
            $booking = Vehicle_has_booking::where('id', $bookingid)->first();

            if ($invoicestate == 'ongoing') {
                if ($payment) {
                    $payment->paystatus = 'cancel';
                    $payment->save();
                }
                $invoice->invoice_status = 'cancel';
                $invoice->save();
                $booking->status = 'Invoice Request';
                $booking->save();
                return response()->json(['message' => 'Invoice Cancelation successfully', 'paymentdetails' => $payment], 201);
            }
            if ($invoicestate == 'invoice complete') {
                if ($payment) {
                    $payment->paystatus = 'cancel';
                    $payment->save();

                    $cashflote = Cashflote::where('ref', $id)->first();
                    $cashflote->description = 'cancel';
                    $cashflote->save();
                }
                $invoice->invoice_status = 'cancel';
                $invoice->save();
            }
        }
    }


    public function viewPendingInvoice()
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $date = Carbon::now()->format('Y-m-d');
            $userid = Auth::user()->id;
            $companyid = Auth::user()->company_id;

            $pendingInvoices = Invoice::where('invoice_status', 'ongoing')
                ->where('company_id', $companyid)
                ->get();

            return view('invoice.ongoinginvoice', compact('pendingInvoices'));
        }
    }

    public function getPreinvoiceDetails(Request $request)
    {
        $id = $request->invoiceid;
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;

        $invoiceDetails = Invoice::find($id);

        $vehicleNo = $invoiceDetails->vehicle_no;
        $bookingId = $invoiceDetails->bookingid;
        $vehicleDetails = Vehical::where('vehical_no', $vehicleNo)->first();
        $bookingDetails = Vehicle_has_booking::where('id', $bookingId)->first();
        $payments = Payment::where('invoiceid', $id)->where('company_id', $companyid)->get();

        $paidtotal = 0;



        return response()->json(['invoiceDetails' => $invoiceDetails, 'vehicleDetails' => $vehicleDetails, 'bookingDetails' => $bookingDetails, 'payments' => $payments], 201);
    }

    public function completinvoicefinal(Request $request)
    {

        $date = Carbon::now()->format('Y-m-d');
        $datetime = Carbon::now()->format('Y-m-d H:i:s');
        $month = Carbon::now()->format('Y-m');
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;

        // comapny details 
        $comapnyDetails = Company::where('id', $companyid)->first();
        // foreach ($comapnyDetails as $companyDetail) {
        //     $companyName = $companyDetail->name;
        //     $address = $companyDetail->address;
        //     $mobile_whatsapp = $companyDetail->mobile_number;
        //     $contactno = $companyDetail->contact_no;
        //     $website = $companyDetail->website;
        //     $email = $companyDetail->email;
        //     $companylogo = $companyDetail->logo;
        // }
        // End 

        $invoiceid = $request->invoiceid;
        $outmeeter = $request->outmeeter;
        $inmeeter = $request->inmeeter;
        $freedistance = $request->freedistance;
        $totaldrivedistance = $request->totaldrivedistance;
        $date_count = $request->date_count;
        $extramillege = $request->extramillege;
        $extra_drive_amount = $request->extra_drive_amount;
        $first_payment_balance = $request->firstpaybalance;
        $first_delivery_charges_balance = $request->deliverychargesbalance;
        $sec_deliverycharges = $request->deliverycharges;
        $extra = $request->extra;
        $sec_discount = $request->discount;
        $net_total = $request->net_total;
        $repairdeduction = $request->repairdeduction;
        $paid_advance_amount = $request->paidadvance;
        $billtotal = $request->total_amount;            //  $first_payment_balance + $first_delivery_charges_balance + $sec_deliverycharges + $extra_drive_amount + $extra_drive_amount
        $paytype = $request->paytype;
        $payamount = $request->payamount;
        $balance = $request->balance;
        $printertype = $request->printertype;

        $id = $invoiceid;

        $invoice = Invoice::find($id);
        $customerid = $invoice->customer_id;

        $customer = Customer::where('id', $customerid)->first();
        $customerName = $customer->full_name;


        $desaidTotal = $invoice->deside_total;
        $desidfirstPayment = $invoice->firstpayment;
        $desidfirstDelivery = $invoice->deliverycharges;
        $desideDiscount = $invoice->expected_discount;
        $firstDelivery = $invoice->deliverycharges;
        $fs_firstpaymentBalance = $invoice->first_payment_balance;   //1st agreement payment 
        $fs_firstdeliveryBalance = $invoice->delivery_payment_balance;   //1st agreement payment 

        if ($first_payment_balance == 0 && $first_delivery_charges_balance == 0) {
            // echo 'ck1';
            $finaltotalamount = $billtotal;
            $invoiceTotal = $desaidTotal + $billtotal;
        }
        if ($desidfirstPayment == $first_payment_balance && $desidfirstDelivery == $first_delivery_charges_balance) {
            // echo 'ck2';
            $finaltotalamount = $billtotal;
            $invoiceTotal = $billtotal;
        }
        if ($fs_firstpaymentBalance == $first_payment_balance && $fs_firstdeliveryBalance == $first_delivery_charges_balance) {
            // echo 'ck3';
            $finaltotalamount = $billtotal;
            $invoiceTotal = $billtotal;
        }



        $allDiscount = $desideDiscount + $sec_discount;
        $allDelivery = $firstDelivery + $sec_deliverycharges;

        $invoice->endmeeter = $inmeeter;
        $invoice->extra_charges = $extra;
        $invoice->total_bill = $invoiceTotal;
        $invoice->discount = $allDiscount;
        $invoice->repair_deduction = $repairdeduction;
        $invoice->net_total = $invoiceTotal;
        $invoice->paidamount = $payamount;
        $invoice->balance = $balance;
        $invoice->extra_drive_amount = $extra_drive_amount;
        $invoice->extramillege = $extramillege;
        $invoice->totaldrivedistance = $totaldrivedistance;
        $invoice->deliverycharges = $allDelivery;
        $invoice->invoice_compleat_date = $date;
        $invoice->invoice_status = 'Invoice complete';
        $invoice->first_payment_balance = 0;
        $invoice->delivery_payment_balance = 0;

        $invoice->save();

        $bookingid = $invoice->bookingid;
        $vehicleNo = $invoice->vehicle_no;
        $booking = Vehicle_has_booking::where('id', $bookingid)->first();


        $vehicle = Vehical::where('vehical_no', $vehicleNo)->first();
        $vehicle->meeter = $inmeeter;
        $vehicle->avalibility = 'yes';
        $vehicle->save();

        if ($booking) {
            $booking->status = 'invoice complete';
            $booking->save();
        }

        // Handle payment logic
        if ($paytype == 'pay from paid amount') { // Pay using advance
            if ($paid_advance_amount >= $billtotal) {
                // Advance covers the bill
                // return response()->json(['status' => 'success', 'message' => 'Advance payment is sufficient']);
                // add payments refund deposit note 
                $paymentadvancerefund = new Payment();
                $paymentadvancerefund->company_id = $companyid;
                $paymentadvancerefund->user_id = $userid;
                $paymentadvancerefund->amount = $paid_advance_amount;
                $paymentadvancerefund->company_id = $companyid;
                $paymentadvancerefund->description = 'Refund Deposit for Agreement No ' . $invoiceid . ' Created for ' . $customerName;
                $paymentadvancerefund->payamount = $paid_advance_amount;
                $paymentadvancerefund->balance = 0;
                $paymentadvancerefund->paytype = $paytype;
                $paymentadvancerefund->date_time = $date;
                $paymentadvancerefund->payment_type = 'Deposit Refund';
                $paymentadvancerefund->month = $month;
                $paymentadvancerefund->invoiceid = $id;
                $paymentadvancerefund->paystatus = 'compleat';
                $paymentadvancerefund->save();

                $companyAccountAdvance = Companyaccount::where('company_id', $companyid)->where('account_type', 'advance_account')->first();
                $companyAccountAdvance->amount = $companyAccountAdvance->amount - $paid_advance_amount;
                $companyAccountAdvance->save();

                $paymentfinal = new Payment();
                $paymentfinal->company_id = $companyid;
                $paymentfinal->user_id = $userid;
                $paymentfinal->amount = $finaltotalamount;
                $paymentfinal->company_id = $companyid;
                $paymentfinal->description = 'Paid Agreement No ' . $invoiceid . ' Created for ' . $customerName;
                $paymentfinal->payamount = $finaltotalamount;
                $paymentfinal->balance = 0;
                $paymentfinal->paytype = $paytype;
                $paymentfinal->date_time = $date;
                $paymentfinal->payment_type = 'Invoice Payment';
                $paymentfinal->month = $month;
                $paymentfinal->invoiceid = $id;
                $paymentfinal->paystatus = 'compleat';
                $paymentfinal->save();

                $companyAccountmain = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
                $companyAccountmain->amount = $companyAccountmain->amount + $finaltotalamount;
                $companyAccountmain->save();

                $lastBalance = Pnl::where('company_id', $companyid)
                    ->orderBy('id', 'desc')
                    ->value('balance');

                $newbalance = $lastBalance + ($finaltotalamount);

                // add pnl save
                $pnlfirstpayment = new Pnl();
                $pnlfirstpayment->description = 'Invoice Payment.Agreement No -' . $invoiceid;
                $pnlfirstpayment->credit = $finaltotalamount;
                $pnlfirstpayment->debit = 0;
                $pnlfirstpayment->date_time = $datetime;
                $pnlfirstpayment->balance = $newbalance;
                $pnlfirstpayment->company_id = $companyid;
                $pnlfirstpayment->type = 'Income';

                $pnlfirstpayment->save();

                $paidId = $paymentfinal->id; // Ensure variable names use consistent casing.
                $fnlPaidDetails = Payment::where('id', $paidId)->first();



                return response()->json([
                    'message' => 'Invoice created successfully',
                    'invoice' => $invoice,
                    'fnl_paid_details' => $fnlPaidDetails
                ], 201);
            } else {
                // Advance does not cover the bill
                // return response()->json(['status' => 'error', 'message' => 'Advance payment is insufficient']);

                if ($balance < 0) {
                    // echo 'miness';
                    $payamount_tc = $paid_advance_amount + $payamount;

                    $paymentadvancerefund = new Payment();
                    $paymentadvancerefund->company_id = $companyid;
                    $paymentadvancerefund->user_id = $userid;
                    $paymentadvancerefund->amount = $paid_advance_amount;
                    $paymentadvancerefund->company_id = $companyid;
                    $paymentadvancerefund->description = 'Refund Deposit for Agreement No ' . $invoiceid . ' Created for ' . $customerName;
                    $paymentadvancerefund->payamount = $paid_advance_amount;
                    $paymentadvancerefund->balance = 0;
                    $paymentadvancerefund->paytype = $paytype;
                    $paymentadvancerefund->date_time = $date;
                    $paymentadvancerefund->payment_type = 'Deposit Refund';
                    $paymentadvancerefund->month = $month;
                    $paymentadvancerefund->invoiceid = $id;
                    $paymentadvancerefund->paystatus = 'compleat';
                    $paymentadvancerefund->save();

                    $companyAccountAdvance = Companyaccount::where('company_id', $companyid)->where('account_type', 'advance_account')->first();
                    $companyAccountAdvance->amount = $companyAccountAdvance->amount - $paid_advance_amount;
                    $companyAccountAdvance->save();

                    $paymentfinal = new Payment();
                    $paymentfinal->company_id = $companyid;
                    $paymentfinal->user_id = $userid;
                    $paymentfinal->amount = $payamount_tc;
                    $paymentfinal->company_id = $companyid;
                    $paymentfinal->description = 'Paid Agreement No ' . $invoiceid . ' Created for ' . $customerName;
                    $paymentfinal->payamount = $payamount_tc;
                    $paymentfinal->balance = 0;
                    $paymentfinal->paytype = $paytype;
                    $paymentfinal->date_time = $date;
                    $paymentfinal->payment_type = 'Invoice Payment';
                    $paymentfinal->month = $month;
                    $paymentfinal->invoiceid = $id;
                    $paymentfinal->paystatus = 'compleat';
                    $paymentfinal->save();

                    $companyAccountmain = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
                    $companyAccountmain->amount = $companyAccountmain->amount + $payamount_tc;
                    $companyAccountmain->save();

                    $lastBalance = Pnl::where('company_id', $companyid)
                        ->orderBy('id', 'desc')
                        ->value('balance');

                    $newbalance = $lastBalance + ($payamount_tc);

                    // add pnl save
                    $pnlfirstpayment = new Pnl();
                    $pnlfirstpayment->description = 'Invoice Payment.Agreement No -' . $invoiceid;
                    $pnlfirstpayment->credit = $payamount_tc;
                    $pnlfirstpayment->debit = 0;
                    $pnlfirstpayment->date_time = $datetime;
                    $pnlfirstpayment->balance = $newbalance;
                    $pnlfirstpayment->company_id = $companyid;
                    $pnlfirstpayment->type = 'Income';

                    $pnlfirstpayment->save();

                    $paidId = $paymentfinal->id; // Ensure variable names use consistent casing.
                    $fnlPaidDetails = Payment::where('id', $paidId)->first();

                    return response()->json([
                        'message' => 'Invoice created successfully',
                        'invoice' => $invoice,
                        'fnl_paid_details' => $fnlPaidDetails
                    ], 201);
                    //naya et karanna oni
                } else {
                    $payamount_tc = $paid_advance_amount + $payamount;

                    $paymentadvancerefund = new Payment();
                    $paymentadvancerefund->company_id = $companyid;
                    $paymentadvancerefund->user_id = $userid;
                    $paymentadvancerefund->amount = $paid_advance_amount;
                    $paymentadvancerefund->company_id = $companyid;
                    $paymentadvancerefund->description = 'Refund Deposit for Agreement No ' . $invoiceid . ' Created for ' . $customerName;
                    $paymentadvancerefund->payamount = $paid_advance_amount;
                    $paymentadvancerefund->balance = 0;
                    $paymentadvancerefund->paytype = $paytype;
                    $paymentadvancerefund->date_time = $date;
                    $paymentadvancerefund->payment_type = 'Deposit Refund';
                    $paymentadvancerefund->month = $month;
                    $paymentadvancerefund->invoiceid = $id;
                    $paymentadvancerefund->paystatus = 'compleat';
                    $paymentadvancerefund->save();

                    $companyAccountAdvance = Companyaccount::where('company_id', $companyid)->where('account_type', 'advance_account')->first();
                    $companyAccountAdvance->amount = $companyAccountAdvance->amount - $paid_advance_amount;
                    $companyAccountAdvance->save();

                    $paymentfinal = new Payment();
                    $paymentfinal->company_id = $companyid;
                    $paymentfinal->user_id = $userid;
                    $paymentfinal->amount = $payamount_tc;
                    $paymentfinal->company_id = $companyid;
                    $paymentfinal->description = 'Paid Agreement No ' . $invoiceid . ' Created for ' . $customerName;
                    $paymentfinal->payamount = $payamount_tc;
                    $paymentfinal->balance = 0;
                    $paymentfinal->paytype = $paytype;
                    $paymentfinal->date_time = $date;
                    $paymentfinal->payment_type = 'Invoice Payment';
                    $paymentfinal->month = $month;
                    $paymentfinal->invoiceid = $id;
                    $paymentfinal->paystatus = 'compleat';
                    $paymentfinal->save();

                    $companyAccountmain = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
                    $companyAccountmain->amount = $companyAccountmain->amount + $payamount_tc;
                    $companyAccountmain->save();

                    $lastBalance = Pnl::where('company_id', $companyid)
                        ->orderBy('id', 'desc')
                        ->value('balance');

                    $newbalance = $lastBalance + ($payamount_tc);

                    // add pnl save
                    $pnlfirstpayment = new Pnl();
                    $pnlfirstpayment->description = 'Invoice Payment.Agreement No -' . $invoiceid;
                    $pnlfirstpayment->credit = $payamount_tc;
                    $pnlfirstpayment->debit = 0;
                    $pnlfirstpayment->date_time = $datetime;
                    $pnlfirstpayment->balance = $newbalance;
                    $pnlfirstpayment->company_id = $companyid;
                    $pnlfirstpayment->type = 'Income';

                    $pnlfirstpayment->save();

                    $paidId = $paymentfinal->id; // Ensure variable names use consistent casing.
                    $fnlPaidDetails = Payment::where('id', $paidId)->first();

                    return response()->json([
                        'message' => 'Invoice created successfully',
                        'invoice' => $invoice,
                        'fnl_paid_details' => $fnlPaidDetails
                    ], 201);
                }
            }
        } else { // Pay using cash/bank/etc.
            // Logic for other payment methods
            // return response()->json(['status' => 'info', 'message' => 'Payment using other methods']);
            if ($balance < 0) {
                $payamount_tc = $payamount;

                $paymentadvancerefund = new Payment();
                $paymentadvancerefund->company_id = $companyid;
                $paymentadvancerefund->user_id = $userid;
                $paymentadvancerefund->amount = $paid_advance_amount;
                $paymentadvancerefund->company_id = $companyid;
                $paymentadvancerefund->description = 'Refund Deposit for Agreement No ' . $invoiceid . ' Created for ' . $customerName;
                $paymentadvancerefund->payamount = $paid_advance_amount;
                $paymentadvancerefund->balance = 0;
                $paymentadvancerefund->paytype = $paytype;
                $paymentadvancerefund->date_time = $date;
                $paymentadvancerefund->payment_type = 'Deposit Refund';
                $paymentadvancerefund->month = $month;
                $paymentadvancerefund->invoiceid = $id;
                $paymentadvancerefund->paystatus = 'compleat';
                $paymentadvancerefund->save();

                $companyAccountAdvance = Companyaccount::where('company_id', $companyid)->where('account_type', 'advance_account')->first();
                $companyAccountAdvance->amount = $companyAccountAdvance->amount - $paid_advance_amount;
                $companyAccountAdvance->save();

                $paymentfinal = new Payment();
                $paymentfinal->company_id = $companyid;
                $paymentfinal->user_id = $userid;
                $paymentfinal->amount = $payamount_tc;
                $paymentfinal->company_id = $companyid;
                $paymentfinal->description = 'Paid Agreement No ' . $invoiceid . ' Created for ' . $customerName;
                $paymentfinal->payamount = $payamount_tc;
                $paymentfinal->balance = 0;
                $paymentfinal->paytype = $paytype;
                $paymentfinal->date_time = $date;
                $paymentfinal->payment_type = 'Invoice Payment';
                $paymentfinal->month = $month;
                $paymentfinal->invoiceid = $id;
                $paymentfinal->paystatus = 'compleat';
                $paymentfinal->save();

                $companyAccountmain = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
                $companyAccountmain->amount = $companyAccountmain->amount + $payamount_tc;
                $companyAccountmain->save();

                $lastBalance = Pnl::where('company_id', $companyid)
                    ->orderBy('id', 'desc')
                    ->value('balance');

                $newbalance = $lastBalance + ($payamount_tc);

                // add pnl save
                $pnlfirstpayment = new Pnl();
                $pnlfirstpayment->description = 'Invoice Payment.Agreement No -' . $invoiceid;
                $pnlfirstpayment->credit = $payamount_tc;
                $pnlfirstpayment->debit = 0;
                $pnlfirstpayment->date_time = $datetime;
                $pnlfirstpayment->balance = $newbalance;
                $pnlfirstpayment->company_id = $companyid;
                $pnlfirstpayment->type = 'Income';

                $pnlfirstpayment->save();

                $paidId = $paymentfinal->id; // Ensure variable names use consistent casing.
                $fnlPaidDetails = Payment::where('id', $paidId)->first();

                return response()->json([
                    'message' => 'Invoice created successfully',
                    'invoice' => $invoice,
                    'fnl_paid_details' => $fnlPaidDetails
                ], 201);
            } else {
                $payamount_tc = $payamount - $balance;

                $paymentadvancerefund = new Payment();
                $paymentadvancerefund->company_id = $companyid;
                $paymentadvancerefund->user_id = $userid;
                $paymentadvancerefund->amount = $paid_advance_amount;
                $paymentadvancerefund->company_id = $companyid;
                $paymentadvancerefund->description = 'Refund Deposit for Agreement No ' . $invoiceid . ' Created for ' . $customerName;
                $paymentadvancerefund->payamount = $paid_advance_amount;
                $paymentadvancerefund->balance = 0;
                $paymentadvancerefund->paytype = $paytype;
                $paymentadvancerefund->date_time = $date;
                $paymentadvancerefund->payment_type = 'Deposit Refund';
                $paymentadvancerefund->month = $month;
                $paymentadvancerefund->invoiceid = $id;
                $paymentadvancerefund->paystatus = 'compleat';
                $paymentadvancerefund->save();

                $companyAccountAdvance = Companyaccount::where('company_id', $companyid)->where('account_type', 'advance_account')->first();
                $companyAccountAdvance->amount = $companyAccountAdvance->amount - $paid_advance_amount;
                $companyAccountAdvance->save();

                $paymentfinal = new Payment();
                $paymentfinal->company_id = $companyid;
                $paymentfinal->user_id = $userid;
                $paymentfinal->amount = $payamount_tc;
                $paymentfinal->company_id = $companyid;
                $paymentfinal->description = 'Paid Agreement No ' . $invoiceid . ' Created for ' . $customerName;
                $paymentfinal->payamount = $payamount_tc;
                $paymentfinal->balance = 0;
                $paymentfinal->paytype = $paytype;
                $paymentfinal->date_time = $date;
                $paymentfinal->payment_type = 'Invoice Payment';
                $paymentfinal->month = $month;
                $paymentfinal->invoiceid = $id;
                $paymentfinal->paystatus = 'compleat';
                $paymentfinal->save();

                $companyAccountmain = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
                $companyAccountmain->amount = $companyAccountmain->amount + $payamount_tc;
                $companyAccountmain->save();

                $lastBalance = Pnl::where('company_id', $companyid)
                    ->orderBy('id', 'desc')
                    ->value('balance');

                $newbalance = $lastBalance + ($payamount_tc);

                // add pnl save
                $pnlfirstpayment = new Pnl();
                $pnlfirstpayment->description = 'Invoice Payment.Agreement No -' . $invoiceid;
                $pnlfirstpayment->credit = $payamount_tc;
                $pnlfirstpayment->debit = 0;
                $pnlfirstpayment->date_time = $datetime;
                $pnlfirstpayment->balance = $newbalance;
                $pnlfirstpayment->company_id = $companyid;
                $pnlfirstpayment->type = 'Income';

                $pnlfirstpayment->save();

                $paidId = $paymentfinal->id; // Ensure variable names use consistent casing.
                $fnlPaidDetails = Payment::where('id', $paidId)->first(); // Use `find` for simpler syntax when fetching by ID.

                return response()->json([
                    'message' => 'Invoice created successfully',
                    'invoice' => $invoice,
                    'fnl_paid_details' => $fnlPaidDetails
                ], 201);
            }
        }
    }



    public function completedInvoice()
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $date = Carbon::now()->format('Y-m-d');
            $userid = Auth::user()->id;
            $companyid = Auth::user()->company_id;

            $completeInvoices = Invoice::where('invoice_status', 'invoice complete')
                ->where('company_id', $companyid)
                ->paginate(10);

            return view('invoice.completedInvoice', compact('completeInvoices'));
        }
    }

    public function viewinvoice(Request $request)
    {
        $id = $request->invoiceid;
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;


        $invoice = Invoice::where('id', $id)->where('company_id', $companyid)->first();

        $htmlContent = view('partials.invoicedetails', compact('invoice'))->render();
        return response()->json(['html' => $htmlContent]);
    }
}
