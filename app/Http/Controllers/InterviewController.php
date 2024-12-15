<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Employee;
use App\Models\Interview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InterviewController extends Controller
{
    //

    public function index()
    {
        $interviews = Interview::with(['candidate', 'firstInterviewer', 'secondInterviewer'])
            ->where('interview_stage', 'pending')
            ->get();

        return view('interview.interview', compact('interviews'));
    }

    public function secoundpending()
    {
        $interviews = Interview::with(['candidate', 'firstInterviewer', 'secondInterviewer'])
            ->where('remark', 'select_2')
            ->get();
        $interviewEmployees = Employee::where('interview_allow', 'yes')->get();

        return view('interview.secoundpending', compact('interviews', 'interviewEmployees'));
    }

    public function completInterview(Request $request)
    {
        $interviewid = $request->interviewid;
        $subject = $request->subject;
        $decision = $request->decision;
        $comminication_score = $request->comminication_score;
        $current_salary = $request->current_salary;
        $expectation_salary = $request->expectation_salary;
        $agreed_salary = $request->agreed_salary;
        $experience = $request->experience;
        $notice_period = $request->notice_period;
        $score = $request->score;
        $aboutinterview = $request->aboutinterview;

        $candidateid = '';

        $interviewDetails = Interview::where('id', $request->interviewid)->get();

        foreach ($interviewDetails as $interviews) {
            $candidateid = $interviews->candidateid;
        }

        $interview = Interview::where('id', $request->interviewid)->first();
        $candidate = Candidate::where('id', $candidateid)->first();

        $interview->interview_summery = $aboutinterview;
        $interview->remark = $decision;
        $interview->interview_stage = 'complete';

        $interview->save();


        $candidate->comminication_score = $comminication_score;
        $candidate->current_salary = $current_salary;
        $candidate->expectation = $expectation_salary;
        $candidate->agreed_amount = $agreed_salary;
        $candidate->experience_int = $experience;
        $candidate->score = $score;
        $candidate->interview_stage = $subject;
        $candidate->notis_period = $notice_period;

        $candidate->save();

        if ($candidate) {
            return response()->json([
                "status" => 200,
                "message" => "The Interview Is Complete",
            ]);
        }
    }

    public function sheduleInterview(Request $request)
    {
        $candidateId = $request->candidateId;


        $candidateInterview = Interview::where('candidateid', $candidateId)
            ->where('interview_stage', 'pending')->get();

        $resultCount = $candidateInterview->count();

        if ($resultCount == 0) {
            $topic = $request->topic;
            $date = $request->date;
            $time = $request->time;
            $first_interviewer = $request->first_interviewer;
            $secound_interviwer = $request->secound_interviwer;
            $third_interviwer = $request->third_interviwer;
            $meeting_link = $request->meeting_link;

            $interview = new Interview();

            $interview->candidateid = $candidateId;
            $interview->interviewdate = $date;
            $interview->interviewtime = $time;
            $interview->first_interviewer = $first_interviewer;
            $interview->secound_interviwer = $secound_interviwer;
            $interview->about_interview = $topic;
            $interview->interview_stage = 'pending';
            $interview->communication = '';
            $interview->score = '';
            $interview->third_interviwer = $third_interviwer;
            $interview->meeting_link = $meeting_link;

            $interview->save();

            return response()->json([
                "status" => 200,
                "message" => "The Interview Sheduled Successful",
                "meetingid" => $interview->id,

            ]);
        } else {
            return response()->json([
                "status" => 201,
                "message" => "Already have sheduled Interview.contact administration",
            ]);
        }
    }

    public function completedintervies()
    {
        $interviewEmployees = Employee::where('interview_allow', 'yes')->get();
        $interviews = Interview::where('interview_stage', 'complete')->orderBy('id', 'desc')->get();
        return view('interview.compleatedInterviewlist', compact('interviews', 'interviewEmployees'));
    }

    public function turntoemployee(Request $request)
    {
        $id = $request->candidateId;

        $candidatename = '';
        $candidateemail = '';
        $candidatedob = '';
        $candidatenic = '';
        $candidategender = '';
        $candidatenationality = '';
        $candidatenationality = '';

        //  get candidate details 
        $candidate = Candidate::where('id', $id)->get();
        foreach ($candidate as $x) {
            $candidatename = $x->name;
            $candidateemail = $x->email;
            $candidatedob = $x->dob;
            $candidatenic = $x->nic;
        }

        // turn to employee 
        $employee = new Employee();
        $user = new User();
        // Fill the employee data
        $employee->employeeID = '';
        $employee->fullName = $candidatename;
        $employee->email = $candidateemail;
        $employee->dateOfBirth = $candidatedob;
        $employee->nic = $candidatenic;
        $employee->gender = '';
        $employee->nationality = '';
        // Save the employee
        $user->name = $candidateemail;
        $user->email = $candidateemail;
        $user->password = Hash::make($candidatenic);
        $user->usertype = 'user';

        $employee->save();
        $user->save();
        // End 

        return response()->json([
            "status" => 201,
            "candidatename" => $candidatename,
        ]);
    }
}
