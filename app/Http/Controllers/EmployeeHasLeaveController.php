<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employee_has_leave;
use App\Models\Employeehasleaverecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeHasLeaveController extends Controller
{
    public function saveEmpSalary(Request $request)
    {
        // Validate the request data
        $request->validate([
            'annual_leave' => 'required',
            'sick_leave' => 'required',
            'personal' => 'required',
            'maternity' => 'required',
            'parental_leave' => 'required',
            'bereavement' => 'required',
            'unpaid_leave' => 'required',
            'special_leave' => 'required'
        ]);

        // Create or update the employee's leave details
        $employeeLeave = new Employee_has_leave();

        $employeeLeave->employee_id = $request->empid;
        $employeeLeave->annual_leave = $request->annual_leave;
        $employeeLeave->sick_leave = $request->sick_leave;
        $employeeLeave->personal_leave = $request->personal;
        $employeeLeave->maternity_leave = $request->maternity;
        $employeeLeave->parental_leave = $request->parental_leave;
        $employeeLeave->bereavement_leave = $request->bereavement;
        $employeeLeave->unpaid_leave = $request->unpaid_leave;
        $employeeLeave->special_leave = $request->special_leave;

        $employeeLeave->save();

        // Optionally, you can return a response to indicate success or failure
        return response()->json(['message' => 'Employee leave details saved successfully']);
    }

    public function addInitialDataForLeave(Request $request)
    {
        // Retrieve input data
        $leaveType = $request->leave_type;
        $leaveCount = $request->leave_count;
        $leaveApplicableYear = $request->leave_applicable_year;
        $employeeSystemId = $request->employeesystemid;

        // Check if a leave entry already exists for the employee and leave type
        $leaveEntryExists = Employee_has_leave::where('employee_id', $employeeSystemId)
            ->where('leave_type', $leaveType)
            ->exists();

        if ($leaveEntryExists) {
            // Leave entry already exists for the employee and leave type
            // Handle the scenario accordingly, such as returning an error response
            return response()->json(['error' => 'Leave entry already exists for the employee and leave type'], 400);
        }

        // Create a new leave entry
        $employeeLeave = new Employee_has_leave();
        $employeeLeave->employee_id = $employeeSystemId;
        $employeeLeave->leave_type = $leaveType;
        $employeeLeave->count = $leaveCount;
        $employeeLeave->applicable_year = $leaveApplicableYear;
        $employeeLeave->save();

        // Return a success response
        return response()->json(['message' => 'Leave entry added successfully'], 200);
    }

    public function requestleave()
    {
        $userid = Auth::user()->id;
        $myavelible_leaves = Employee_has_leave::where('employee_id', $userid)->get();
        return view('leave.requestleave', compact('myavelible_leaves'));
    }

    public function requestleaveoffice(){
        return view('leave.requestleaveoffice');
    }

    public function addleaverequest(Request $request)
    {
        $leave_type =  $request->leave_type;
        $leave_start_date =  $request->leave_start_date;
        $leave_end_date =  $request->leave_end_date;
        $datecount =  $request->datecount;
        $requester_id = Auth::user()->id;

        //   get employeee details 
        $employeeDetails = Employee::where('id', $requester_id)->get();
        foreach ($employeeDetails as $details) {
            $managerLevel = $details->manager;
        }
        // End 

        // get employee leave details 


        $addemployee_record =  new Employeehasleaverecord();
        $addemployee_record->employee_id = $requester_id;
        $addemployee_record->request_leave_type = $leave_type;
        $addemployee_record->leave_start = $leave_start_date;
        $addemployee_record->leave_end = $leave_end_date;
        $addemployee_record->leave_count = $datecount;
        $addemployee_record->isapprove_reporter = '';
        $addemployee_record->isapporve_manager = '';
        $addemployee_record->isapprovehr = '';

        $addemployee_record->save();
    }
}
