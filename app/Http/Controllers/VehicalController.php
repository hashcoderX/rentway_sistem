<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Vehical;
use App\Models\Vehicle_has_booking;
use App\Models\Vehicle_has_image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicalController extends Controller
{
    public function index()
    {

        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $companyid = Auth::user()->company_id;
            $myvehicles = Vehical::where('company_id', $companyid)->get();
            return view('vehicle.index', compact('myvehicles'));
        }
    }

    public function savevehicle(Request $request)
    {
        // Define validation rules
        $rules = [
            'vehicle_no' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:255',
            'body_type' => 'required|string|max:255',
            'vehicle_brand' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'model_vehicle' => 'required|string|max:255',
            'meeter_reading' => 'required|numeric|min:0',
            'licen_expire_date' => 'required|date|after:today',
            'insurence_expire_date' => 'required|date|after:today',
        ];

        // Validate the request data
        $request->validate($rules);

        // Retrieve validated data
        $vehicle_no = $request->vehicle_no;
        $vehicle_type = $request->vehicle_type;
        $body_type = $request->body_type;
        $vehicle_brand = $request->vehicle_brand;

        $color = $request->color;
        $fualtype = $request->fualtype;

        $transmission = $request->transmission;
        $model_vehicle = $request->model_vehicle;
        $meeter_reading = $request->meeter_reading;
        $licen_expire_date = $request->licen_expire_date;
        $insurence_expire_date = $request->insurence_expire_date;

        // Get authenticated user details
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;

        // Create new vehicle
        $vehicle = new Vehical();
        $vehicle->vehical_no = $vehicle_no;
        $vehicle->user_id = $userid;
        $vehicle->company_id = $companyid;
        $vehicle->vehical_type = $vehicle_type;
        $vehicle->vehical_brand = $vehicle_brand;
        $vehicle->vehicle_color = $color;
        $vehicle->fualtype  = $fualtype;
        $vehicle->body_type = $body_type;
        $vehicle->vehical_model = $model_vehicle;
        $vehicle->meeter = $meeter_reading;
        $vehicle->licen_exp = $licen_expire_date;
        $vehicle->insurence_exp = $insurence_expire_date;

        // Create notifications for license and insurance expiration
        $licenexpDescription = "The Vehicle $vehicle_no License Expiration is $licen_expire_date";
        $insuranceexpDescription = "The Vehicle $vehicle_no insurance Expiration is $insurence_expire_date";

        $notification = new Notification();
        $lxnoti = Carbon::parse($licen_expire_date)->subDays(7);
        $notificationStartDay = $lxnoti->format('Y-m-d');
        $lxnotix = Carbon::parse($licen_expire_date)->addDays(7);
        $notificationEndDay = $lxnotix->format('Y-m-d');
        $notification->type = 'License Expiration';
        $notification->notification_level = 'All';
        $notification->read_state = 'None';
        $notification->topic = "License Expiration $vehicle_no";
        $notification->notifiaction_date_start = $notificationStartDay;
        $notification->notification_date_end = $notificationEndDay;
        $notification->time = '';
        $notification->description = $licenexpDescription;
        $notification->state = 'pending';
        $notification->company_id = $companyid;

        $insurencenotification = new Notification();
        $lxnotiinsurence = Carbon::parse($insurence_expire_date)->subDays(7);
        $notificationStartDayinsurence = $lxnotiinsurence->format('Y-m-d');
        $lxnotixti = Carbon::parse($insurence_expire_date)->addDays(7);
        $notificationEndDayinsurence = $lxnotixti->format('Y-m-d');
        $insurencenotification->type = 'insurance Expiration';
        $insurencenotification->notification_level = 'All';
        $insurencenotification->read_state = 'None';
        $insurencenotification->topic = "insurance Expiration $vehicle_no";
        $insurencenotification->notifiaction_date_start = $notificationStartDayinsurence;
        $insurencenotification->notification_date_end = $notificationEndDayinsurence;
        $insurencenotification->time = '';
        $insurencenotification->description = $insuranceexpDescription;
        $insurencenotification->state = 'pending';
        $insurencenotification->company_id = $companyid;


        // Save vehicle and notifications
        $success = $vehicle->save();
        $savelicennotification = $notification->save();
        $saveinsurencenotification = $insurencenotification->save();

        return redirect()->back()->with('success', 'Vehicle Registered successfully!');
    }

    public function rentalDetails(Request $request){
       $userid = Auth::user()->id;
       $companyid = Auth::user()->company_id;

       $rentaltype = $request->value;
       $bookingid = $request->bookingid;

       $bookingDetails  = Vehicle_has_booking::where('id',$bookingid)->first();
       $vehicleNo = $bookingDetails->vehicle_no;

       $rentalDetails = Vehical::where('vehical_no', $vehicleNo)->where('company_id',$companyid)->first();
       return response()->json(['rentaldetails' => $rentalDetails], 201);
    }

    public function getVehicleDetails(Request $request)
    {
        $bookingid = $request->bookingid;

        $bookingDetails = Vehicle_has_booking::where('id', $bookingid)->first();
        $vehicleNo = $bookingDetails->vehicle_no;

        $vehicle = Vehical::where('vehical_no', $vehicleNo)->first();

        return response()->json(['vehicle' => $vehicle, 'booking' => $bookingDetails], 201);
    }

    public function veiwvehicle(Request $request)
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $vehicleid = $request->id;
            $vehicleDetails = Vehical::where('id', $vehicleid)->first();
            $vehicleImages  = Vehicle_has_image::where('vehicle_id', $vehicleid)->get();
            return view('vehicle.vehicleupdate', compact('vehicleDetails', 'vehicleImages'));
        }
    }

    public function vehicleAccessoriesupdate(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check() || Auth::user()->id == '') {
            return redirect()->route('index');
        }

        // Validate the request
        $request->validate([
            'vehicleid' => 'required|exists:vehicals,id',
            'revenuelicence' => 'nullable|string|max:255',
            'insurance_card' => 'nullable|string|max:255',
            'emission_certificate' => 'nullable|string|max:255',
            'spare_wheel' => 'nullable|string|max:255',
            'jack' => 'nullable|string|max:255',
            'wheel_brush' => 'nullable|string|max:255',
        ]);

        // Retrieve and update the vehicle details
        $vehicleDetails = Vehical::findOrFail($request->vehicleid);
        $vehicleDetails->revenuelicence = $request->revenuelicence;
        $vehicleDetails->insurance_card = $request->insurance_card;
        $vehicleDetails->emission_certificate = $request->emission_certificate;
        $vehicleDetails->spare_wheel = $request->spare_wheel;
        $vehicleDetails->jack = $request->jack;
        $vehicleDetails->wheel_brush = $request->wheel_brush;

        $vehicleDetails->save();

        return response()->json(['success' => true, 'message' => 'Update successful!']);
    }

    public function updatemeeter(Request $request)
    {
        $vehicleId = $request->vehicleId;
        $meeter = $request->meeter;

        $vehicle = Vehical::where('id', $vehicleId)->first();
        if ($vehicle) {
            $vehicle->meeter = $meeter;
            $vehicle->save();
        }
        
        return redirect()->back();
    }


    public function updatevehicleduration(Request $request)
    {
        $vehicleid = $request->vehicleid;
        $per_day_free_duration = $request->per_day_free_duration;
        $per_week_free_duration = $request->per_week_free_duration;
        $per_month_free_duration = $request->per_month_free_duration;
        $per_year_free_duration = $request->per_year_free_duration;

        $vehicle = Vehical::where('id',  $vehicleid)->first();

        $vehicle->per_day_free_duration = $per_day_free_duration;
        $vehicle->per_week_free_duration = $per_week_free_duration;
        $vehicle->per_month_free_duration = $per_month_free_duration;
        $vehicle->per_year_free_duration = $per_year_free_duration;

        $vehicle->avalibility = 'yes';

        $vehicle->save();

        return redirect()->back()->with('success', 'Update successfully!');
    }
    public function updatevehiclerentel(Request $request)
    {
        $vehicleid = $request->vehicleid;
        $per_day_rentel = $request->per_day_rentel;
        $per_week_rental = $request->per_week_rental;
        $per_month_rental = $request->per_month_rental;
        $per_year_rental = $request->per_year_rental;
        $addtional_per_mile_cost = $request->addtional_per_mile_cost;
        $required_deposit = $request->required_deposit;

        $vehicle = Vehical::where('id',  $vehicleid)->first();

        if ($vehicle) {
            $vehicle->per_day_rental = $per_day_rentel;
            $vehicle->per_week_rental = $per_week_rental;
            $vehicle->per_month_rental = $per_month_rental;
            $vehicle->per_year_rental = $per_year_rental;
            $vehicle->addtional_per_mile_cost = $addtional_per_mile_cost;
            $vehicle->deposit_amount = $required_deposit;

            $vehicle->save();

            return redirect()->back()->with('success', 'Update successfully!');
        } else {
            $vehicle->per_day_rental = $per_day_rentel;
            $vehicle->per_week_rental = $per_week_rental;
            $vehicle->per_month_rental = $per_month_rental;
            $vehicle->per_year_rental = $per_year_rental;
            $vehicle->addtional_per_mile_cost = $addtional_per_mile_cost;
            $vehicle->deposit_amount = $required_deposit;

            $vehicle->save();

            return redirect()->back()->with('success', 'Update successfully!');
        }
    }

    public function uploadphoto(Request $request)
    {
        $vehicleid  = $request->vehicleidforiameg;
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;

        $uploadPath = "vehicle/";

        // $image = time() . rand(1, 100) . '.' . $request->image->extension();
        // $request->image->move(public_path('vehicle'), $image);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();


            // Allow certain file formats
            $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
            if (in_array($fileType, $allowTypes)) {
                $compressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                if ($compressedImage) {
                    $filepath = $compressedImage;
                    $status = 'success';
                    $statusMsg = "Image compressed successfully.";
                } else {
                    $statusMsg = "Image compress failed!";
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            }
        }


        $vehicleImage = new Vehicle_has_image();
        $vehicleImage->vehicle_id = $vehicleid;
        $vehicleImage->company_id = $companyid;
        $vehicleImage->image_url = $filepath;

        $vehicleImage->save();
        return redirect()->back();
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

    public function viewvehiclelist()
    {

        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $companyid = Auth::user()->company_id;
            $vehicles = Vehical::where('company_id', $companyid)->get();
            return view('vehicle.vehiclelist', compact('vehicles'));
        }
    }

    public function viewvehiclefulldetails(Request $request)
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $vehicleid = $request->id;
            $vehicle = Vehical::where('id', $vehicleid)->first();
            $vehicleImages = Vehicle_has_image::where('vehicle_id', $vehicleid)->get();
            return view('vehicle.vehicleprofile', compact('vehicle', 'vehicleImages'));
        }
    }
}
