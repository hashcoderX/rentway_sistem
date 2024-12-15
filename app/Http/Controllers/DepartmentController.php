<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Level;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $branchId = $request->id;
        $branchDetails = Branch::where('id', $branchId)->get();
        foreach ($branchDetails as $branch) {
            $branchNme = $branch->name;
            $branchCode =  $branch->branchcode;
        }
        $levels = Level::all();
        $departmentMax = Department::max('id');

        $departmentMax = Department::max('id');

        // Check if $departmentMax is null
        if ($departmentMax === null) {
            // Provide a default value or handle the case as needed
            $departmentMax += 1; // For example, set it to 0
        }

        $departments = Department::where('branch_id', $branchId)->get();

        //  $departmentList 
        return view('setting.department.create', compact('branchNme', 'branchDetails', 'branchId', 'departments', 'levels', 'branchCode', 'departmentMax'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'departmentname' => 'required|string',
            'branch_id' => 'required|integer',
            'manager' => 'nullable',
            'description' => 'nullable|string',
            'department_code' => 'nullable|string',

        ]);

        // Create a new department
        $department = new Department();
        $department->departmentcode = $validatedData['department_code']; // You need to implement this method
        $department->name = $validatedData['departmentname'];
        $department->description = $validatedData['description'];
        $department->branch_id = $validatedData['branch_id'];
        $department->manager_id = $request->manager;
        $department->userid = auth()->user()->id; // Assuming you're using Laravel's authentication
        $department->firstlayer = $request->firstlyer;
        $department->secondlayer = $request->secoundlayer;
        $department->thirdlayer = $request->thirdlayer;
        $department->forthlayer = $request->forthlayer;
        // Save the department
        $department->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Department saved successfully.');
    }
}
