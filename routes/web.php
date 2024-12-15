<?php

use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\BacklisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeHasLeaveController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PnlController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VehicalController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('index');
});

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'Done';
});

Route::get('/dashboard', function () {
    if (!Auth::check() || Auth::user()->id == '') {
        return view('index');
    } else {
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/candidates', [App\Http\Controllers\HomeController::class, 'regInterviewer'])->name('regInterviewer');
Route::get('/setting', [App\Http\Controllers\HomeController::class, 'setting'])->name('setting');
Route::get('/companysetting', [App\Http\Controllers\HomeController::class, 'comapnysetting'])->name('comapnysetting');
Route::POST('/uploadcompanyaccountbalance', [App\Http\Controllers\HomeController::class, 'updateStartingAmount'])->name('updateStartingAmount');

Route::POST('/updatedepositamount', [App\Http\Controllers\HomeController::class, 'updatedepositamount'])->name('updatedepositamount');
Route::POST('/updatewithdrawamount', [App\Http\Controllers\HomeController::class, 'updatewithdrawamount'])->name('updatewithdrawamount');  
Route::POST('/updatedonations', [App\Http\Controllers\HomeController::class, 'updatedonations'])->name('updatedonations');

Route::post('/registerbranch', [BranchController::class, 'register'])->name('register.branch');

// department 
Route::get('/department/{id}', [App\Http\Controllers\DepartmentController::class, 'index'])->name('index');
Route::post('/savedepartment', [App\Http\Controllers\DepartmentController::class, 'store']);


// Candidates Details 
Route::post('/savecandidates', [CandidateController::class, 'store'])->name('store');
Route::get('/getCandidateCv', [CandidateController::class, 'getCv'])->name('getCv');
Route::get('/deleteCandidate', [CandidateController::class, 'delete'])->name('delete');
Route::post('/updateCandidate', [CandidateController::class, 'update'])->name('update');
Route::get('/getCandidateDetails', [CandidateController::class, 'getCandidateDetails'])->name('getCandidateDetails');
Route::get('/cvpool', [CandidateController::class, 'cvpool'])->name('cvpool');

// user privilages 
Route::get('/createUserRoll', [App\Http\Controllers\PermitionController::class, 'createUserRoll']);


// Employee 
Route::get('/employee', [EmployeeController::class, 'index'])->name('index');
Route::post('/saveemployee', [EmployeeController::class, 'store'])->name('store');
Route::get('/getEmployeeDetails', [EmployeeController::class, 'getEmployee'])->name('getEmployee');
Route::post('/updateEmployee', [EmployeeController::class, 'updateEmployee'])->name('updateEmployee');
Route::get('/employeelist', [EmployeeController::class, 'employeelist'])->name('employeelist');
Route::get('/deleteEmployee', [EmployeeController::class, 'delete'])->name('delete');
Route::get('/employee/{id}', [EmployeeController::class, 'loadupdateprofile'])->name('loadupdateprofile');
Route::post('/updateemployeeresult', [EmployeeController::class, 'updateempqulificationol'])->name('updateempqulificationol');
Route::post('/updateemployeealresult', [EmployeeController::class, 'updateempqulificational'])->name('updateempqulificational');
Route::post('/saveotherqualification', [EmployeeController::class, 'updateempotherqualification'])->name('updateempotherqualification');
Route::post('/updateemployeeexperiance', [EmployeeController::class, 'updateemployeeexperiance'])->name('updateemployeeexperiance');
Route::post('/updateemployeesalary', [EmployeeController::class, 'updateemployeesalary'])->name('updateemployeesalary');

Route::post('/firstupdateEmployee', [EmployeeController::class, 'firstupdateEmployee'])->name('firstupdateEmployee');
Route::get('/secoundemployeeupdate/{id}', [EmployeeController::class, 'secoundemployeeupdate'])->name('secoundemployeeupdate');

// End 

// Interview   interviews
Route::get('/interviews', [InterviewController::class, 'index'])->name('index');
Route::post('/scheduleInterview', [InterviewController::class, 'sheduleInterview'])->name('sheduleInterview');
Route::post('/compleateInterview', [InterviewController::class, 'completInterview'])->name('completInterview');
Route::get('/completedintervies', [InterviewController::class, 'completedintervies'])->name('completedintervies');
Route::get('/secound_intervies', [InterviewController::class, 'secoundpending'])->name('secoundpending');
Route::post('/turntoemployee', [InterviewController::class, 'turntoemployee'])->name('turntoemployee');

// End 

// leave routes 
Route::post('/allowcateleaves', [EmployeeHasLeaveController::class, 'addinitialdataforleave'])->name('addinitialdataforleave');
Route::get('/requestleave', [EmployeeHasLeaveController::class, 'requestleave'])->name('requestleave');
Route::post('/requestleave', [EmployeeHasLeaveController::class, 'addleaverequest'])->name('addleaverequest');
Route::get('/requestleaveoffice', [EmployeeHasLeaveController::class, 'requestleaveoffice'])->name('requestleaveoffice');
// End 

// Level 
Route::post('/createstafflevel', [LevelController::class, 'createLevel'])->name('createLevel');

// End 

// Attendence  
Route::get('/attendence', [AttendenceController::class, 'index'])->name('index');
// End 

// Sallary    saveEmpsalary
Route::post('/saveEmpsalary', [EmployeeHasLeaveController::class, 'saveEmpSalary'])->name('saveEmpSalary');
// End 


// Rent Car routes 

// create company 

Route::get('/registercompany', [CompanyController::class, 'index'])->name('register.index');
Route::post('/registercompany', [CompanyController::class, 'register'])->name('register.company');
Route::post('/registeruser', [CompanyController::class, 'useradd'])->name('useradd.company');
Route::post('/updatecompnydetails', [CompanyController::class, 'updateCompany'])->name('updateCompany.company');
Route::get('/setting/alignbill', [CompanyController::class, 'alignbill'])->name('alignbill.company');



// end 
// End 

// Vehicle 
Route::get('/addvehicle', [VehicalController::class, 'index'])->name('index');
Route::POST('/savevehicleinitial', [VehicalController::class, 'savevehicle'])->name('savevehicle');
Route::get('/vehicle/{id}', [VehicalController::class, 'veiwvehicle'])->name('veiwvehicle');
Route::POST('/updatevehicleduration', [VehicalController::class, 'updatevehicleduration'])->name('updatevehicleduration');
Route::POST('/updatevehiclerentel', [VehicalController::class, 'updatevehiclerentel'])->name('updatevehiclerentel');
Route::POST('/updatevehiclephoto', [VehicalController::class, 'uploadphoto'])->name('uploadphoto');  
Route::POST('/updatevehicleaccessories', [VehicalController::class, 'vehicleAccessoriesupdate'])->name('vehicleAccessoriesupdate');


Route::get('/vehiclelist', [VehicalController::class, 'viewvehiclelist'])->name('viewvehiclelist');
Route::get('/vehicledetails/{id}', [VehicalController::class, 'viewvehiclefulldetails'])->name('viewvehiclefulldetails');
Route::get('/getvehicledetails', [VehicalController::class, 'getVehicleDetails'])->name('getVehicleDetails'); 
Route::get('/updatemeeter', [VehicalController::class, 'updatemeeter'])->name('updatemeeter');  
Route::get('/getrentaldetails', [VehicalController::class, 'rentalDetails'])->name('rentalDetails');

// Booking 
Route::get('/bookvehicle', [BookingController::class, 'bookvehicle'])->name('bookvehicle');
Route::post('/addbooking', [BookingController::class, 'addregister'])->name('addregister');
Route::get('/booking/{id}', [BookingController::class, 'viewbooking'])->name('viewbooking');
Route::get('/viewbooking', [BookingController::class, 'viewbookingdetails'])->name('viewbookingdetails');
Route::get('/getbookingbydate', [BookingController::class, 'bookingBydate'])->name('bookingBydate');
Route::get('/getbookingdetails', [BookingController::class, 'bookingDetails'])->name('bookingDetails');
Route::get('/cancelbooking', [BookingController::class, 'cancelbooking'])->name('cancelbooking');
Route::get('/ischeckcompletevehicle', [BookingController::class, 'ischeckvehicle'])->name('ischeckvehicle');   
Route::get('booking/editbooking/{id}', [BookingController::class, 'editBooking'])->name('editBooking');  
Route::post('/updatebooking', [BookingController::class, 'updateBooking'])->name('updateBooking');

Route::get('/getdetailsbooking', [BookingController::class, 'getbookingdetails'])->name('getbookingdetails');
Route::get('/bookinglistbyvehicle', [BookingController::class, 'getbookingbyvehicle'])->name('getbookingbyvehicle');  
Route::get('/booking/vehicledetails/{id}', [BookingController::class, 'bookingbyvehicle'])->name('bookingbyvehicle');
// End 

// Invoice 

Route::get('/newinvoice', [InvoiceController::class, 'index'])->name('index');
Route::post('/saveinvoice', [InvoiceController::class, 'saveinvoice'])->name('saveinvoice');
Route::post('/advanceinvoice', [InvoiceController::class, 'saveadvanceinvoice'])->name('saveadvanceinvoice');
Route::get('/viewinvoices', [InvoiceController::class, 'viewPendingInvoice'])->name('viewPendingInvoice');
Route::get('/getpreinvoicedetails', [InvoiceController::class, 'getPreinvoiceDetails'])->name('getPreinvoiceDetails');
Route::post('/saveinvoicefinal', [InvoiceController::class, 'completinvoicefinal'])->name('completinvoicefinal');
Route::get('/viewcompletedinvoice', [InvoiceController::class, 'completedInvoice'])->name('completedInvoice');
// Route::get('/cancelinvoice', [InvoiceController::class, 'cancelInvoice'])->name('cancelInvoice');  
Route::get('/cancelinvoicesource', [InvoiceController::class, 'cancelInvoice'])->name('cancelInvoice');   
Route::get('/viewagreement/{id}', [InvoiceController::class, 'viewAgreement'])->name('viewAgreement');  
Route::get('/getinvoicedetail', [InvoiceController::class, 'viewinvoice'])->name('viewinvoice');  
Route::get('/viewinvoicereport/{id}', [InvoiceController::class, 'viewInvoiceReport'])->name('viewInvoiceReport'); 
// End  0760735835 / chenukitoursandrent.com



// Get My client Details 
Route::get('/clientlists', [CustomerController::class, 'myclientlist'])->name('myclientlist');
Route::get('/getcustomerdetails', [CustomerController::class, 'customerDetails'])->name('customerDetails');
Route::get('/customer', [CustomerController::class, 'index'])->name('index');
Route::post('/savecustomer', [CustomerController::class, 'register'])->name('register');
Route::get('/customer/{id}', [CustomerController::class, 'profile'])->name('profile');
Route::post('/updatecustomer', [CustomerController::class, 'update'])->name('update');
Route::get('/viewaccount/{id}', [CustomerController::class, 'viewaccount'])->name('viewaccount');
Route::post('/updatecustomeraccount', [CustomerController::class, 'updateaccount'])->name('updateaccount');
// End 

// Payments   
Route::get('/historypayment', [PaymentController::class, 'viewpayhistory'])->name('viewpayhistory');
// End 

// Notification  
Route::get('/removenotification', [NotificationController::class, 'removeNotification'])->name('removeNotification');
Route::get('/notifications', [NotificationController::class, 'index'])->name('index');
Route::get('/getnotificationdetails', [NotificationController::class, 'getnotificationdetails'])->name('getnotificationdetails');

// End 

// User 
Route::get('/addnewuser', [WorkerController::class, 'regWorker'])->name('regWorker');
Route::post('/addsubusers', [WorkerController::class, 'adsubuser'])->name('adsubuser');

// End 

// Reports  
Route::get('/salesreport', [ReportController::class, 'index'])->name('index');
Route::get('/genarateearningreport', [ReportController::class, 'genarateearningreport'])->name('genarateearningreport');
// End   

Route::get('/blacklist', [BacklisterController::class, 'index'])->name('index');
Route::post('/saveblacklister', [BacklisterController::class, 'addblacklister'])->name('addblacklister');
Route::get('/findblacklist', [BacklisterController::class, 'findblacklisterindex'])->name('findblacklisterindex');
Route::get('/getblacklisterdetails', [BacklisterController::class, 'getblacklisterdetails'])->name('getblacklisterdetails');

// Expenses 

Route::get('/addexpenses', [ExpensesController::class, 'index'])->name('index');  
Route::post('/addexpenses', [ExpensesController::class, 'addExpenses'])->name('addExpenses');  
Route::get('/viewexpenses', [ExpensesController::class, 'viewExpenses'])->name('viewExpenses'); 
Route::post('/expenses/filter', [ExpensesController::class, 'filterExpenses'])->name('filterExpenses');   
Route::get('/getexpencedetails', [ExpensesController::class, 'expenseDetail'])->name('expenseDetail'); 

Route::get('/pnl', [PnlController::class, 'viewPnl'])->name('viewPnl'); 
Route::post('/pnl/filter', [PnlController::class, 'filterPnl'])->name('filterPnl');  
Route::get('/balancesheet', [PnlController::class, 'viewBalanceSheet'])->name('viewBalanceSheet');   
Route::post('/balancesheet/filter', [PnlController::class, 'filterBalanceSheet'])->name('filterBalanceSheet'); 
// End 

Route::get('/managevariable', [SettingController::class, 'index'])->name('index');  
// agreement possition 
Route::post('/saveagreementpossition', [CompanyController::class, 'alignAgreement'])->name('alignAgreement');  
Route::post('/savevariablevisibility', [SettingController::class, 'updateVariablevisibility'])->name('updateVariablevisibility');
// 2024.10.11 



require __DIR__ . '/auth.php';
