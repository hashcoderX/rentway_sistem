<?php

namespace App\Http\Controllers;

use App\Models\Billalignment;
use App\Models\Company;
use App\Models\Companyaccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    //
    public function index()
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            return view('company.addcomany');
        }
    }

    public function register(Request $request)
    {
        $now = Carbon::now();
        $today = $now->toDateString();

        $company = new Company();
        $user = new User();

        $uploadPath = "companylogo/";

        $companylogofilepath = '';
        $footerfilepath = '';
        $companyheaderfilepath = '';


        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $companylogofilepath = '';


            // Allow certain file formats including SVG
            $allowTypes = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            if (in_array($fileType, $allowTypes)) {
                if ($fileType === 'svg') {
                    // No compression for SVG, just move the file
                    $companylogofilepath = $file->move($uploadPath, $imageUploadPath);
                    $status = 'success';
                    $statusMsg = "SVG file uploaded successfully.";
                } else {
                    // Compress non-SVG images
                    $customercompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($customercompressedImage) {
                        $companylogofilepath = $customercompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compression failed!";
                    }
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, and SVG files are allowed to upload.';
            }
        }

        if ($request->hasFile('letterhead')) {
            $file = $request->file('letterhead');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $companyheaderfilepath = '';

            // Allow certain file formats including SVG
            $allowTypes = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            if (in_array($fileType, $allowTypes)) {
                if ($fileType === 'svg') {
                    // No compression for SVG, just move the file
                    $companyheaderfilepath = $file->move($uploadPath, $imageUploadPath);
                    $status = 'success';
                    $statusMsg = "SVG file uploaded successfully.";
                } else {
                    // Compress non-SVG images
                    $letterheadcompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($letterheadcompressedImage) {
                        $companyheaderfilepath = $letterheadcompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compression failed!";
                    }
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, and SVG files are allowed to upload.';
            }
        }

        if ($request->hasFile('footer')) {
            $file = $request->file('footer');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $footerfilepath = '';

            // Allow certain file formats including SVG
            $allowTypes = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            if (in_array($fileType, $allowTypes)) {
                if ($fileType === 'svg') {
                    // No compression for SVG, just move the file
                    $footerfilepath = $file->move($uploadPath, $imageUploadPath);
                    $status = 'success';
                    $statusMsg = "SVG file uploaded successfully.";
                } else {
                    // Compress non-SVG images
                    $footercompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($footercompressedImage) {
                        $footerfilepath = $footercompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compression failed!";
                    }
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, and SVG files are allowed to upload.';
            }
        }

        $company->name    = $request->companyname;
        $company->company_code    = $request->company_code;
        $company->reg_no = $request->regno;
        $company->address = $request->address;
        $company->owner_name = $request->ownername;
        $company->contact_no = $request->phone_number;
        $company->mobile_number = $request->mobile_number;
        $company->website = $request->website;
        $company->logo = $companylogofilepath;
        $company->description = '';
        $company->register_date = $today;
        $company->email = $request->email;
        $company->password = Hash::make($request->password);
        $company->payby = $request->payby;
        $company->header = $companyheaderfilepath;
        $company->footer = $footerfilepath;
        $company->currency = $request->currency;

        $success = $company->save();

        if ($success) {
            $companyid = $company->id;
            $user->name = $request->companyname;
            $user->email  = $request->email;
            $user->usertype = 'Admin';
            $user->password = Hash::make($request->password);
            $user->company_id = $companyid;

            $user->save();

            $companyAccount = new Companyaccount();
            $companyAccount->account_type = 'main';
            $companyAccount->amount = 0;
            $companyAccount->company_id = $companyid;

            $companyAccount->save();

            $companyAccount2 = new Companyaccount();
            $companyAccount2->account_type = 'advance_account';
            $companyAccount2->amount = 0;
            $companyAccount2->company_id = $companyid;

            $companyAccount2->save();
        }

        return response()->json([
            "status" => 200,
            "message" => 'Registration Compleated'
        ]);
    }

    public function updateCompany(Request $request)
    {

        $uploadPath = "companylogo/";

        $companyId = $request->companyid;
        $companyName = $request->companyname;
        $companyaddress = $request->companyaddress;
        $contactno = $request->contactno;
        $mobileno = $request->mobileno;
        $website = $request->website;
        $currency = $request->currency;

        $companylogofilepath = '';
        $footerfilepath = '';
        $companyheaderfilepath = '';
        $agreementpageonefilepath = '';
        $agreementpagetwofilepath = '';

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $companylogofilepath = '';
            // Allow certain file formats including SVG
            $allowTypes = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            if (in_array($fileType, $allowTypes)) {
                if ($fileType === 'svg') {
                    // No compression for SVG, just move the file
                    $companylogofilepath = $file->move($uploadPath, $imageUploadPath);
                    $status = 'success';
                    $statusMsg = "SVG file uploaded successfully.";
                } else {
                    // Compress non-SVG images
                    $logocompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($logocompressedImage) {
                        $companylogofilepath = $logocompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compression failed!";
                    }
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, and SVG files are allowed to upload.';
            }
        }

        if ($request->hasFile('header')) {
            $file = $request->file('header');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $companyheaderfilepath = '';
            // Allow certain file formats including SVG
            $allowTypes = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            if (in_array($fileType, $allowTypes)) {
                if ($fileType === 'svg') {
                    // No compression for SVG, just move the file
                    $companyheaderfilepath = $file->move($uploadPath, $imageUploadPath);
                    $status = 'success';
                    $statusMsg = "SVG file uploaded successfully.";
                } else {
                    // Compress non-SVG images
                    $headercompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($headercompressedImage) {
                        $companyheaderfilepath = $headercompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compression failed!";
                    }
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, and SVG files are allowed to upload.';
            }
        }

        if ($request->hasFile('footer')) {
            $file = $request->file('footer');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $footerfilepath = '';
            // Allow certain file formats including SVG
            $allowTypes = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            if (in_array($fileType, $allowTypes)) {
                if ($fileType === 'svg') {
                    // No compression for SVG, just move the file
                    $footerfilepath = $file->move($uploadPath, $imageUploadPath);
                    $status = 'success';
                    $statusMsg = "SVG file uploaded successfully.";
                } else {
                    // Compress non-SVG images
                    $footercompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($footercompressedImage) {
                        $footerfilepath = $footercompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compression failed!";
                    }
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, and SVG files are allowed to upload.';
            }
        }

        if ($request->hasFile('agreementimgone')) {
            $file = $request->file('agreementimgone');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $agreementpageonefilepath = '';
            // Allow certain file formats including SVG
            $allowTypes = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            if (in_array($fileType, $allowTypes)) {
                if ($fileType === 'svg') {
                    // No compression for SVG, just move the file
                    $agreementpageonefilepath = $file->move($uploadPath, $imageUploadPath);
                    $status = 'success';
                    $statusMsg = "SVG file uploaded successfully.";
                } else {
                    // Compress non-SVG images
                    $agreementcompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($agreementcompressedImage) {
                        $agreementpageonefilepath = $agreementcompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compression failed!";
                    }
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, and SVG files are allowed to upload.';
            }
        }

        if ($request->hasFile('agreementimgtwo')) {
            $file = $request->file('agreementimgtwo');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $agreementpagetwofilepath = '';
            // Allow certain file formats including SVG
            $allowTypes = ['jpg', 'png', 'jpeg', 'gif', 'svg'];
            if (in_array($fileType, $allowTypes)) {
                if ($fileType === 'svg') {
                    // No compression for SVG, just move the file
                    $agreementpagetwofilepath = $file->move($uploadPath, $imageUploadPath);
                    $status = 'success';
                    $statusMsg = "SVG file uploaded successfully.";
                } else {
                    // Compress non-SVG images
                    $agreementtwocompressedImage = $this->compressImage($file->getRealPath(), $imageUploadPath, 75);
                    if ($agreementtwocompressedImage) {
                        $agreementpagetwofilepath = $agreementtwocompressedImage;
                        $status = 'success';
                        $statusMsg = "Image compressed successfully.";
                    } else {
                        $statusMsg = "Image compression failed!";
                    }
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, and SVG files are allowed to upload.';
            }
        }

        $company = Company::where('id', $companyId)->first();
        $logopath = $company->logo;
        $headerpath = $company->header;
        $footerpath = $company->footer;
        $agreementsideonepath = $company->agreementsideone;
        $agreementsidetwopath = $company->agreementsidetwo;

        if (!empty($logopath) && file_exists(public_path('companylogo/' . $logopath))) {
            unlink(public_path('companylogo/' . $logopath));
        }

        if (!empty($headerpath) && file_exists(public_path('companylogo/' . $headerpath))) {
            unlink(public_path('companylogo/' . $headerpath));
        }

        if (!empty($footerpath) && file_exists(public_path('companylogo/' . $footerpath))) {
            unlink(public_path('companylogo/' . $footerpath));
        }

        if (!empty($agreementsideonepath) && file_exists(public_path('companylogo/' . $agreementsideonepath))) {
            unlink(public_path('companylogo/' . $agreementsideonepath));
        }

        if (!empty($agreementsidetwopath) && file_exists(public_path('companylogo/' . $agreementsidetwopath))) {
            unlink(public_path('companylogo/' . $agreementsidetwopath));
        }

        if ($company) {
            $company->name = $companyName;
            $company->address = $companyaddress;
            $company->contact_no = $contactno;
            $company->mobile_number = $mobileno;
            $company->website = $website;
            $company->logo = $companylogofilepath;
            $company->header = $companyheaderfilepath;
            $company->footer = $footerfilepath;
            $company->agreementsideone = $agreementpageonefilepath;
            $company->currency = $currency;

            $company->save();

            return view('setting.companysetting', compact('company'));
        }
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

    public function useradd(Request $request)
    {
        $name = $request->name;
        $email = $request->email_user;
        $password = $request->userpassword;
        $userType = 'User';
        $companyid = Auth::user()->company_id;

        $user = new User();

        $user->name = $name;
        $user->email  = $email;
        $user->usertype = $userType;
        $user->password = Hash::make($password);
        $user->company_id = $companyid;

        $user->save();

        return response()->json([
            "status" => 200,
            "message" => 'Registration Compleated'
        ]);
    }

    public function alignbill()
    {
        $companyid = Auth::user()->company_id;
        $company = Company::where('id', $companyid)->first();
        return view('setting.billalignment', compact('company'));
    }

    public function alignAgreement(Request $request)
    {
        $companyid = Auth::user()->company_id;
        $userid = Auth::user()->id;

        $positions = $request->all(); // This will retrieve the positions data
        // Process the data as needed, e.g., save to a database
        foreach ($positions as $elementid => $position) {
            // $id will be the element ID (e.g., 'name', 'address', etc.)
            // $position will be the position data (e.g., 'top' => value, 'left' => value)

            // Access the top and left values
            $top = $position['top'];
            $left = $position['left'];

            // You can now process the data, for example, storing it in a database
            // or performing any other operations
            // Example:
            // YourModel::create([
            //     'element_id' => $id,
            //     'top' => $top,
            //     'left' => $left,
            // ]);

            // For debugging or previewing, you can print the values
            echo "Element ID: $elementid | Top: $top | Left: $left<br>";

            $billelements = new Billalignment();
            $billelements->user_id = $userid;
            $billelements->company_id  = $companyid;
            $billelements->elementid  = $elementid;
            $billelements->element_top_possition  = $top;
            $billelements->element_left_possition  = $left;
            $billelements->display  = 'block';
            $billelements->save();
        }
        return response()->json(['message' => $positions]);
    }
}
