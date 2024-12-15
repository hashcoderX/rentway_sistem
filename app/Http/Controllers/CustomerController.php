<?php

namespace App\Http\Controllers;

use App\Models\Cashflote;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

   public function index()
   {
      if (!Auth::check() || Auth::user()->id == '') {
         return view('index');
      } else {
         $userid = Auth::user()->id;
         $companyid = Auth::user()->company_id;

         $customers = Customer::where('company_id', $companyid)->get();
         return view('clientlist.addcustomer', compact('customers'));
      }
   }

   public function myclientlist()
   {
      if (!Auth::check() || Auth::user()->id == '') {
         return view('index');
      } else {
         $date = Carbon::now()->format('Y-m-d');
         $userid = Auth::user()->id;
         $companyid = Auth::user()->company_id;

         $customers = Customer::where('company_id', $companyid)->paginate(15);

         return view('clientlist.myclientlist', compact('customers'));
      }
   }

   public function register(Request $request)
   {
      $rules = [
         'customername' => 'required|string|max:400',
         'nic' => 'required|string|max:12',
         'telephone_number' => 'required|string|max:10',
      ];

      $request->validate($rules);

      $userid = Auth::user()->id;
      $companyid = Auth::user()->company_id;
      $date = Carbon::now()->format('Y-m-d');

      $customername = $request->customername;
      $nic = $request->nic;
      $paddress = $request->p_address;
      $taddress = $request->t_address;
      $telephone_number = $request->telephone_number;

      $customer = Customer::where('nic', $nic)->where('company_id', $companyid)->first();

      if ($customer) {
         return redirect()->back()->with('message', 'The Customer is already registerd!');
      } else {

         $uploadPath = "uploads/";

         if ($request->hasFile('customerphoto')) {
            $file = $request->file('customerphoto');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $customerfilepath = '';
            $drivinglicenfilepath = '';
            $verificationfilepath = '';

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

         $customer = new Customer();
         $customer->user_id = $userid;
         $customer->company_id = $companyid;
         $customer->full_name = $customername;
         $customer->reg_date = $date;
         $customer->nic = $nic;

         $customer->p_address = $paddress;
         $customer->t_address = $taddress;
         $customer->telephone_no = $telephone_number;

         $customer->driving_licen_photo = $drivinglicenfilepath;
         $customer->livingvarification = $verificationfilepath;
         $customer->customer_photo = $customerfilepath;

         $customer->save();

         $customerid = $customer->id;

         $customerAccount = new CustomerAccount();
         $customerAccount->company_id = $companyid;
         $customerAccount->user_id = $userid;
         $customerAccount->customer_id = $customerid;
         $customerAccount->accountbalance = 0;

         $customerAccount->save();

         return redirect()->back();
      }
   }

   function profile(Request $request)
   {

      if (!Auth::check() || Auth::user()->id == '') {
         return view('index');
      } else {
         $customerId  = $request->id;

         $invoices = Invoice::where('customer_id', $customerId)->orderBy('created_at', 'asc')->paginate(10);;
         $customer = Customer::where('id', $customerId)->first();
         return view('clientlist.customerprofile', compact('customer', 'invoices'));
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

   public function customerDetails(Request $request)
   {

      if (!Auth::check() || Auth::user()->id == '') {
         return view('index');
      } else {
         $nic =  $request->nic;
         $userid = Auth::user()->id;
         $companyid = Auth::user()->company_id;

         $customer = Customer::where('nic', $nic)->where('company_id', $companyid)->first();
         // Check if the customer exists
         if ($customer) {
            // Return the customer details as JSON
            return response()->json(['customer' => $customer], 201);
         } else {
            // If no customer is found, return a 404 response
            return response()->json(['error' => 'Customer not found'], 202);
         }
      }
   }

   public function update(Request $request)
   {
      $rules = [
         'customerid' => 'required',
         'fullname' => 'required|string|max:400',
         'nic' => 'required|string|max:12',
         'street' => 'required|string|max:344',
         'addresslinetwo' => 'required|string|max:344',
         'city' => 'required|string|max:344',
         'telephone' => 'required|string|max:10',
      ];

      $request->validate($rules);


      $userid = Auth::user()->id;
      $companyid = Auth::user()->company_id;
      $date = Carbon::now()->format('Y-m-d');

      $customername = $request->fullname;
      $nic = $request->nic;
      $street = $request->street;
      $address_line_one = $request->addresslinetwo;
      $city = $request->city;
      $telephone_number = $request->telephone;

      $customer = Customer::where('nic', $nic)->where('company_id', $companyid)->first();
      $customerimgurl = $customer->customer_photo;
      $customerverificationurl = $customer->livingvarification;
      $customerlicenurl = $customer->driving_licen_photo;

      if ($customer) {
         $uploadPath = "uploads/";

         // if (file_exists(public_path($customerimgurl))) {
         //    unlink(public_path($customerimgurl));
         // }else{

         // }
         // if (file_exists(public_path($customerverificationurl))) {
         //    unlink(public_path($customerverificationurl));
         // }
         // else{

         // }
         // if (file_exists(public_path($customerlicenurl))) {
         //    unlink(public_path($customerlicenurl));
         // }
         // else{

         // }

         if ($request->hasFile('customerphoto')) {
            $file = $request->file('customerphoto');
            $fileName = $file->getClientOriginalName();
            $imageUploadPath = $uploadPath . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileType = $file->getClientOriginalExtension();
            $customerfilepath = '';
            $drivinglicenfilepath = '';
            $verificationfilepath = '';

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

         $customer->full_name = $customername;
         $customer->nic = $nic;
         $customer->street = $street;
         $customer->address_line_one = $address_line_one;
         $customer->city = $city;
         $customer->telephone_no = $telephone_number;
         $customer->driving_licen_photo =  $drivinglicenfilepath;
         $customer->livingvarification =  $verificationfilepath;
         $customer->customer_photo =  $customerfilepath;

         $customer->save();

         return redirect()->back();
      } else {
      }
   }

   public function viewaccount(Request $request)
   {

      if (!Auth::check() || Auth::user()->id == '') {
         return view('index');
      } else {
         $customerid =  $request->id;
         $customer = Customer::where('id', $customerid)->first();
         $customerAccount = CustomerAccount::where('customer_id', $customerid)->first();
         $transactionhistorys = Cashflote::where('customer_id', $customerid)->get();
         return view('clientlist.customeraccount', compact('customer', 'customerAccount', 'transactionhistorys'));
      }
   }

   public function updateaccount(Request $request)
   {

      if (!Auth::check() || Auth::user()->id == '') {
         return view('index');
      } else {

         $userid = Auth::user()->id;
         $companyid = Auth::user()->company_id;
         $date = Carbon::now()->format('Y-m-d H:i:s');



         $customerid = $request->customerid;
         $starttype = $request->starttype;
         $starting_amount = $request->starting_amount;

         $topic = 'Starting Balance';

         $customeraccount = CustomerAccount::where('customer_id', $customerid)->first();
         if ($starttype == 'credit') {
            $accountbalance  = $starting_amount;
            $crediamount =  $starting_amount;
            $debitamount = 0;
            $balance = $starting_amount;
         }
         if ($starttype == 'debit') {
            $accountbalance  = 0 - $starting_amount;
            $crediamount =  0;
            $debitamount = $starting_amount;
            $balance = 0 - $starting_amount;
         }

         $customeraccount->accountbalance = $accountbalance;
         $customeraccount->save();

         $cashflote = new cashflote();
         $cashflote->company_id = $companyid;
         $cashflote->user_id = $userid;
         $cashflote->customer_id = $customerid;
         $cashflote->accountbalance = $balance;
         $cashflote->date_time = $date;
         $cashflote->credit = $crediamount;
         $cashflote->debit = $debitamount;
         $cashflote->note = $topic;
         $cashflote->description = 'Customer account starting balance';

         $cashflote->save();

         return redirect()->back();
      }
   }
}
