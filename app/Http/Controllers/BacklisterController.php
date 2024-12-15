<?php

namespace App\Http\Controllers;

use App\Models\Backlister;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BacklisterController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $userid = Auth::user()->id;
            $companyid = Auth::user()->company_id;
            $date = Carbon::now()->format('Y-m-d');
            $myblacklisters = Backlister::where('company_id', $companyid)->get();
            return view('backlist.backlist', compact('myblacklisters'));
        }
    }

    public function addblacklister(Request $request)
    {
        $rules = [
            'customername' => 'required|string|max:400',
            'nic' => 'required|string|max:12',
            'city' => 'required|string|max:255',
            'telephone_number' => 'required|string|max:10',
            'description' => 'required|string',
        ];

        $uploadPath = "uploads/blacklistimage/";

        $request->validate($rules);

        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;
        $date = Carbon::now()->format('Y-m-d');

        $customername = $request->customername;
        $nic = $request->nic;
        $city = $request->city;
        $telephone_number = $request->telephone_number;
        $typeofdamage = $request->typeofdamage;
        $damagedescription = $request->description;

        // Get company details
        $company = Company::find($companyid);
        $companyName = $company->name ?? '';
        $companyAddress = $company->address ?? '';
        $companyContactno = $company->contact_no ?? '';
        $companyMobileNo = $company->mobile_number ?? '';

        // Initialize file paths as empty strings
        $customerfilepath = '';
        $drivinglicenfilepath = '';
        $verificationfilepath = '';
        $damageverificationfilepath = '';

        // Compress and save customer photo if it exists
        if ($request->hasFile('customerphoto')) {
            $file = $request->file('customerphoto');
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();

            if (in_array($file->getClientOriginalExtension(), ['jpg', 'png', 'jpeg', 'gif'])) {
                $customercompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                if ($customercompressedImage) {
                    $customerfilepath = $customercompressedImage;
                }
            }
        }

        // Compress and save driving license photo if it exists
        if ($request->hasFile('drivinglicensephoto')) {
            $file = $request->file('drivinglicensephoto');
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();

            if (in_array($file->getClientOriginalExtension(), ['jpg', 'png', 'jpeg', 'gif'])) {
                $drivinglicencompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                if ($drivinglicencompressedImage) {
                    $drivinglicenfilepath = $drivinglicencompressedImage;
                }
            }
        }

        // Compress and save living verification photo if it exists
        if ($request->hasFile('livingverification')) {
            $file = $request->file('livingverification');
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();

            if (in_array($file->getClientOriginalExtension(), ['jpg', 'png', 'jpeg', 'gif'])) {
                $livingverificationcompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                if ($livingverificationcompressedImage) {
                    $verificationfilepath = $livingverificationcompressedImage;
                }
            }
        }

        // Compress and save damage verification photo if it exists
        if ($request->hasFile('damageverification')) {
            $file = $request->file('damageverification');
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();

            if (in_array($file->getClientOriginalExtension(), ['jpg', 'png', 'jpeg', 'gif'])) {
                $damageverificationcompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                if ($damageverificationcompressedImage) {
                    $damageverificationfilepath = $damageverificationcompressedImage;
                }
            }
        }

        // Save to the database
        $addbacklist = new Backlister();
        $addbacklist->user_id = $userid;
        $addbacklist->company_id = $companyid;
        $addbacklist->full_name = $customername;
        $addbacklist->reg_date = $date;
        $addbacklist->nic = $nic;
        $addbacklist->telephone_no = $telephone_number;
        $addbacklist->effected_company_name = $companyName;
        $addbacklist->company_address = $companyAddress;
        $addbacklist->company_contact_no = $companyContactno;
        $addbacklist->type_of_damage = $typeofdamage;
        $addbacklist->resone_describe = $damagedescription;

        // Assign file paths, empty if no file was uploaded
        $addbacklist->driving_licen_photo = $drivinglicenfilepath;
        $addbacklist->livingvarification = $verificationfilepath;
        $addbacklist->customer_photo = $customerfilepath;
        $addbacklist->damageverification = $damageverificationfilepath;

        $addbacklist->save();

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

    public function findblacklisterindex()
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $userid = Auth::user()->id;
            $companyid = Auth::user()->company_id;
            $date = Carbon::now()->format('Y-m-d');
            $myblacklisters = Backlister::all();
            return view('backlist.findblacklist', compact('myblacklisters'));
        }
    }


    public function getblacklisterdetails(Request $request)
    {
        $nic = $request->nic;

        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $userid = Auth::user()->id;
            $companyid = Auth::user()->company_id;

            // Retrieve the list of vehicles for the company

            $blacklisterdetails = Backlister::where('nic', $nic)->first();

            $htmlContent = view('partials.blacklistdetails', compact('blacklisterdetails'))->render();
            return response()->json(['html' => $htmlContent]);
        }
    }
}
