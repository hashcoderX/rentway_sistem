<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Employee_has_education;
use App\Models\Employee_has_leave;
use App\Models\Emplyee_has_salary;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')->take(5)->get();
        $branches = Branch::all();
        $departments = Department::all();
        $staffLevels = Level::all();
        return view('employees.employee', compact('employees', 'branches', 'departments', 'staffLevels'));
    }

    public function loadupdateprofile(Request $request)
    {
        $id = $request->id;
        $branches = Branch::all();
        $departments = Department::all();
        $staffLevels = Level::all();
        $employee = Employee::where('id', $id)->first();

        $employeeStatus = $employee->profile_status;
        if ($employeeStatus == 'completed') {


            $employee = Employee::find($request->id); // Use 'id' instead of 'empid'
            $olresult =  Employee_has_education::where('employee_id', $request->id)->where('exam_name', 'O/L Exam')->first();
            $alresult =  Employee_has_education::where('employee_id', $request->id)->where('exam_name', 'A/L Exam')->first();
            $otherqualification = Employee_has_education::where('employee_id', $request->id)->where('exam_name', 'Other Qualification')->get();
            $experiances = Employee_has_education::where('employee_id', $request->id)->where('exam_name', 'Experiance')->get();
            $salaryDetails = Emplyee_has_salary::where('employee_id', $request->id)->get();
            $employee_leaves = Employee_has_leave::where('employee_id', $request->id)->get();

            if ($employee) {
                return view('employees.secoundupdate', compact('employee', 'olresult', 'alresult', 'experiances', 'otherqualification', 'salaryDetails','employee_leaves'));
            } else {
                return response()->json(['error' => 'Employee not found'], 404);
            }
        } else {
            return view('employees.updateemployee', compact('branches', 'departments', 'staffLevels', 'employee'));
        }
    }

    // public function store(Request $request){
    //   $empoyee_full_name = $request->empoyee_full_name;
    //   $email = $request->email;
    //   $nic  = $request->nic;  
    //   $gender  = $request->gender;




    // }

    public function store(Request $request)
    {
        // $request->validate([
        //     'employee_id' => 'required|string|max:255',
        //     'employee_full_name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:employees,email',
        //     'dob' => 'required|date',
        //     'nic' => 'required|string|max:12',
        //     'gender' => 'required|string|in:male,female,other',
        //     'nationality' => 'required|string|max:255',
        // ]);

        // Create new employee instance
        $employee = new Employee();
        $user = new User();
        // Fill the employee data
        $employee->employeeID = '';
        $employee->fullName = $request->name;
        $employee->email = $request->email;
        $employee->dateOfBirth = $request->dob;
        $employee->nic = $request->nic;
        $employee->gender = $request->gender;
        $employee->nationality = $request->nationality;
        // Save the employee
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->usertype = 'user';

        $employee->save();
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Employee saved successfully!');
    }

    public function getEmployee(Request $request)
    {
        $empid = $request->employeeId;
        $employee = Employee::find($empid);
        if ($employee) {
            return response()->json($employee);
        } else {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }

    public function updateEmployee(Request $request)
    {
        $empid = $request->empid;
        echo $empid;
        // Optionally, you can return a response to indicate success or failure
        // return response()->json(['message' => 'Employee record updated successfully']);
    }

    public function firstupdateEmployee(Request $request)
    {
        $branchid = $request->branch;
        $departmentid = $request->department;
        $emp_system_id = $request->empid;

        $branch = Branch::where('id', $branchid)->first();
        $branchcode = $branch->branchcode;

        $department = Department::where('id', $departmentid)->first();
        $departmentcode = $department->departmentcode;

        $employeeCode = $branchcode . "_" . $departmentcode . "_" . $emp_system_id;

        $employee = Employee::where('id', $request->empid)->first();

        $employee->employeeID = $employeeCode;

        $employee->maritalStatus = $request->maritalstatus;
        $employee->socialSecurityNumber = $request->social_sec_number;

        $employee->address = $request->address;
        $employee->phoneNumber = $request->phone_number;
        $employee->jobTitle = $request->jobtitle;
        $employee->branch = $request->branch;
        $employee->department = $request->department;
        $employee->employmentStatus = $request->employeementstatus;
        $employee->startDate = $request->employee_start_date;
        $employee->manager = $request->reported_manager;

        $employee->employmentType = $request->employeementtype;
        $employee->workSchedule = $request->workshedule;
        $employee->employmentHistory = $request->employeehistory;

        $employee->emergencyContactName = $request->emergency_contact_name;
        $employee->emergencyContactRelationship = $request->emergencyRelationship;
        $employee->emergencyContactPhone = $request->emergency_contact;
        $employee->emergencyContactAddress = $request->contactaddress;

        $employee->bankAccount = $request->bank_account_no;
        $employee->taxInformation = $request->taxfileno;
        $employee->healthInsurance = $request->helthpolicyno;

        $employee->emp_file_no = $request->employee_file_no;
        $employee->profile_status = 'completed';

        $employee->save();

        if ($employee) {
            return response()->json(['success' => 'Update successfully', 'data' => $employee]);
        }
    }

    public function secoundemployeeupdate(Request $request)
    {
        $employee = Employee::find($request->id); // Use 'id' instead of 'empid'
        $olresult =  Employee_has_education::where('employee_id', $request->id)->where('exam_name', 'O/L Exam')->first();
        $alresult =  Employee_has_education::where('employee_id', $request->id)->where('exam_name', 'A/L Exam')->first();
        $otherqualification = Employee_has_education::where('employee_id', $request->id)->where('exam_name', 'Other Qualification')->get();
        $experiances = Employee_has_education::where('employee_id', $request->id)->where('exam_name', 'Experiance')->get();
        $salaryDetails = Emplyee_has_salary::where('employee_id', $request->id)->get();
        
        // $sql = "SELECT * FROM `employee_has_leaves` WHERE `employee_id`=?";
        // $bindings = [$request->id];
        // $employee_leaves = DB::select($sql, $bindings);

        $employee_leaves = Employee_has_leave::where('employee_id', $request->id)->get();
       
        if ($employee) {
            return view('employees.secoundupdate', compact('employee', 'olresult', 'alresult', 'experiances', 'otherqualification', 'salaryDetails','employee_leaves'));
        } else {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }


    public function employeelist()
    {
        $employees = DB::table('employees')->where('employmentStatus', 'Active')->paginate(10);
        $branches = Branch::all();
        $departments = Department::all();
        $staffLevels = Level::all();
        return view('employees.employeelist', compact('employees', 'branches', 'departments', 'staffLevels'));
    }

    public function delete(Request $request)
    {
        $id = $request->candidateId;

        // Find the candidate by ID
        $employee = Employee::find($id);
        // Check if the candidate exists
        if ($employee) {
            // Delete the candidate
            $employee->delete();

            // Optionally, you can return a success message
            return response()->json(['success' => 'Candidate deleted successfully']);
        } else {
            // Optionally, you can return an error message if the candidate does not exist
            return response()->json(['error' => 'Candidate not found'], 404);
        }
    }

    public function updateempqulificationol(Request $request)
    {
        $empsysid = $request->employeesystemid;
        $index_no = $request->index_no;
        $ol_examyear = $request->ol_examyear;
        $results = $request->result;

        $employee_result = new Employee_has_education();
        $employee_result->employee_id = $empsysid;
        $employee_result->index_no = $index_no;
        $employee_result->exam_year = $ol_examyear;
        $employee_result->exam_name = 'O/L Exam';
        $employee_result->results = $results;

        $successsave = $employee_result->save();

        if ($successsave) {
            return response()->json(['success' => 'Employee Data Update Successfully']);
        } else {
            return response()->json(['danger' => 'The Update incompleted']);
        }
    }

    public function updateempqulificational(Request $request)
    {
        $empsysid = $request->employeesystemid;
        $index_no = $request->al_index_no;
        $al_examyear = $request->al_examyear;
        $result = $request->result;

        $employee_result = new Employee_has_education();
        $employee_result->employee_id = $empsysid;
        $employee_result->index_no = $index_no;
        $employee_result->exam_year = $al_examyear;
        $employee_result->exam_name = 'A/L Exam';
        $employee_result->results = $result;

        $successsave = $employee_result->save();

        if ($successsave) {
            return response()->json(['success' => 'Employee Data Update Successfully']);
        } else {
            return response()->json(['danger' => 'The Update incompleted']);
        }
    }

    public function updateempotherqualification(Request $request)
    {
        $empsysid = $request->employeesystemid;
        $qualification_other = $request->qualification_other;
        $qo_enddate = $request->qo_enddate;
        $qo_startdate = $request->qo_startdate;
        $isgraduate = $request->isgraduate;

        $employee_result = new Employee_has_education();
        $employee_result->employee_id = $empsysid;
        $employee_result->index_no = '';
        $employee_result->exam_year = $qo_enddate . '_' . $qo_startdate;
        $employee_result->exam_name = 'Other Qualification';
        $employee_result->results = $qualification_other;

        $successsave = $employee_result->save();

        if ($successsave) {
            return response()->json(['success' => 'Employee data update successfully']);
        } else {
            return response()->json(['danger' => 'The Update incompleted']);
        }
    }

    // companyname: companyname,
    // work_startdate: work_startdate,
    // work_enddate: work_enddate,
    // working_description: working_description,
    // employeesystemid: employeesystemid,

    public function updateemployeeexperiance(Request $request)
    {
        $empsysid = $request->employeesystemid;
        $companyname = $request->companyname;
        $work_startdate = $request->work_startdate;
        $work_enddate = $request->work_enddate;
        $working_description = $request->working_description;

        $employee_result = new Employee_has_education();
        $employee_result->employee_id = $empsysid;
        $employee_result->index_no = '';
        $employee_result->exam_year = $work_startdate . '_' . $work_enddate;
        $employee_result->exam_name = 'Experiance';
        $employee_result->results = $companyname;

        $successsave = $employee_result->save();

        if ($successsave) {
            return response()->json(['success' => 'Experiance update successfully']);
        } else {
            return response()->json(['danger' => 'The Update incompleted']);
        }
    }

    public function updateemployeesalary(Request $request)
    {
        $employeeid = $request->employeesystemid;
        $salary_category = $request->salary_category;
        $salary_amount = $request->salary_amount;
        $applicable_year = $request->applicable_year;
        $cat = '';
        if ($salary_category == 'deduction' || $salary_category == 'loan' || $salary_category == 'epf') {
            $cat = 'deduct';
        } else {
            $cat = 'plus';
        }

        $employee_salary = new Emplyee_has_salary();

        $employee_salary->employee_id = $employeeid;
        $employee_salary->salary_category = $salary_category;
        $employee_salary->amount = $salary_amount;
        $employee_salary->maths = $cat;
        $employee_salary->aplicable_year = $applicable_year;

        $successsave = $employee_salary->save();

        if ($successsave) {
            return response()->json(['success' => 'Experiance update successfully']);
        } else {
            return response()->json(['danger' => 'The Update incompleted']);
        }
    }
}
