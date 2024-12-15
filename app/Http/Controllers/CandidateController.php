<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'candidatename'  => 'required',
            'email'  => 'required',
            'phone_number'  => 'required',
            'dateofbirth'  => 'required',
            'possition'  => 'required',
            'experiance'  => 'required',
            'cv'  => 'required',
        ]);

        $candidate = new Candidate();

        $cv = time() . rand(1, 100) . '.' . $request->cv->extension();
        $request->cv->move(public_path('cv'), $cv);

        
        $nic = $request->nic;
        $dob = $request->dateofbirth;

        $date = Carbon::createFromFormat('Y-m-d', $dob);
        $birthyear = $date->year;

        // Check if birth year is before 2000
        if ($birthyear < 2000) {
            // Remove the first two digits
            $withoutFirstTwoDigits = substr($nic, 2);

            // Insert '0' after the 6th character
            $withZero = substr_replace($withoutFirstTwoDigits, '0', 3, 0);

            // Remove the last character
            $withoutLastChar = substr($withZero, 0, -1);

            // Combine birth year and modified NIC
            $benic = $birthyear . $withoutLastChar;

            // Ensure the length is correct (optional)
            if (strlen($benic) != 10) {
                // Handle incorrect length (e.g., log an error)
            }
        } else {
            // Use the original NIC
            $benic = $nic;
        }

        $candidate->name = $validatedData['candidatename'];
        $candidate->email = $validatedData['email'];
        $candidate->phonenumber = $validatedData['phone_number'];
        $candidate->dob = $validatedData['dateofbirth'];
        $candidate->possition = $validatedData['possition'];
        $candidate->experiance = $validatedData['experiance'];
        $candidate->cv_link = $cv;
        $candidate->interview_stage = 'Pending HR Meeting'; // Assuming initial stage is pending
        $candidate->stage = 'Pending';
        $candidate->reg_date = now()->toDateString();
        $candidate->nic = $request->nic;
        $candidate->benic = $benic;
        $candidate->description = $request->description;



        $candidate->save();

        return redirect()->back()->with('success', 'Candidate registered successfully.');
    }

    public function getCv(Request $request)
    {
        $id = $request->candidateId;

        $candidatecv = Candidate::where('id', $id)->get();
        foreach ($candidatecv as $candidatecvDetail) {
            $cvlink = $candidatecvDetail->cv_link;
        }

        return response()->json([
            'status' => 200,
            'cvlink' => $cvlink,
        ]);
    }

    public function update(Request $request)
    {

        $candidatename = $request->candidatenameed;
        $email = $request->emailed;
        $phone_number = $request->phone_numbered;
        $dob = $request->dateofbirthed;
        $possision = $request->possitioned;
        $experiance = $request->experianceed;
        $description = $request->descriptioned;
        $nic = $request->niced;




        $id = $request->candidateided;

        // Find the candidate by ID
        $candidate = Candidate::find($id);

        // Check if the candidate exists
        if (!$candidate) {
            return response()->json(['error' => 'Candidate not found'], 404);
        } else {
            $candidate->name = $candidatename;
            $candidate->email = $email;
            $candidate->phonenumber = $phone_number;
            $candidate->dob = $dob;
            $candidate->possition = $possision;
            $candidate->experiance = $experiance;
            $candidate->nic = $nic;
            $candidate->description = $description;

            $candidate->save();

            return response()->json(['success' => 'Candidate updated successfully']);
        }

        // Update candidate record
        // $candidate->update();

        // Optionally, return a response
        // return response()->json(['success' => 'Candidate updated successfully']);
    }

    public function delete(Request $request)
    {
        $id = $request->candidateId;

        // Find the candidate by ID
        $candidate = Candidate::find($id);
        $cvfilepath = $candidate->cv_link;
        // Check if the candidate exists
        if ($candidate) {
            // Delete the candidate
            $candidate->delete();

            if (file_exists(public_path('cv/' . $cvfilepath))) {
                unlink(public_path('cv/' . $cvfilepath));
            } else {
            }

            // Optionally, you can return a success message
            return response()->json(['success' => 'Candidate deleted successfully']);
        } else {
            // Optionally, you can return an error message if the candidate does not exist
            return response()->json(['error' => 'Candidate not found'], 404);
        }
    }

    public function getCandidateDetails(Request $request)
    {
        $candidateId = $request->candidateId;
        $candidate = Candidate::find($candidateId);

        if ($candidate) {
            return response()->json($candidate);
        } else {
            return response()->json(['error' => 'Candidate not found'], 404);
        }
    }

    public function cvpool()
    {
        $candidates = DB::table('candidates')->where('stage', 'Pending')->orderBy('reg_date', 'desc')->paginate(10);
        return view('candidates.cvpool', compact('candidates'));
    }
}
