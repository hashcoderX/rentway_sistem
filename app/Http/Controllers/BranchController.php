<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Notifications\BranchRegistered;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        // Check if branch with provided email already exists
        $existingBranch = Branch::where('email', $request->email)->first();
        if ($existingBranch) {
            return response()->json([
                "status" => 201,
                "message" => 'Branch with this email already exists'
            ]);
        } else {

            echo $request->branchcode;

            $validatedData = $request->validate([
                'branchname' => 'required|string',
                'email' => 'required|email|unique:branches,email',
                'phone_number' => 'required|string',
                'fax' => 'required|string',

            ]);

            // Check if any of the input fields are empty
            if (empty($validatedData['branchname']) || empty($validatedData['email']) || empty($validatedData['phone_number']) || empty($validatedData['fax'])) {
                return response()->json([
                    "status" => 400,
                    "message" => 'Please fill in all required fields.'
                ]);
            }

            // Create a new branch
            $branch = Branch::create([
                'name' => $validatedData['branchname'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'fax' => $validatedData['fax'],
                'branchcode' => $request->branchcode,
                'unit_head' => $request->unit_head,
                'firstlawyer' => $request->firstlawyer,
                'secound_lawyer' => $request->secound_lawyer,
                'third_lawyer' => $request->third_lawyer,
                'forth_lawyer' => $request->forth_lawyer,
                'userid' => Auth::user()->id,
                'date_time' => Carbon::now(),
                
            ]);

            return response()->json([
                "status" => 200,
                "message" => 'Branch registered successfully.'
            ]);
        }
    }
}
