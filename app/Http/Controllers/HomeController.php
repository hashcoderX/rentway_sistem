<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Companyaccount;
use App\Models\Employee;
use App\Models\Expenses;
use App\Models\Level;
use App\Models\Pnl;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function regInterviewer()
    {
        $candidates = Candidate::where('stage', 'Pending')->orderBy('reg_date', 'desc')->get();
        $interviewEmployees = Employee::where('interview_allow', 'yes')->get();
        return view('candidates.create', compact('candidates', 'interviewEmployees'));
    }

    public function setting()
    {
        if (Auth::user()->usertype == 'superAdmin') {
            $companys = Company::all();
            $users = [];
        }
        if (Auth::user()->usertype == 'Admin') {
            $companyId = Auth::user()->company_id;
            $companys = Company::where('id', $companyId)->get();
            $users = User::where('company_id', $companyId)->get();
        }
        if (Auth::user()->usertype == 'User') {
            $companyId = Auth::user()->company_id;
            $userId = Auth::user()->id;
            $companys = Company::where('id', $companyId)->get();
            $users = User::where('id', $userId)->get();
        }


        return view('setting.index', compact('companys', 'users'));
    }


    public function updateStartingAmount(Request $request)
    {
        // Validate the incoming request
        $date = Carbon::now()->format('Y-m-d');
        $month = Carbon::now()->format('Y-m');
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;
        $datetime = Carbon::now()->format('Y-m-d H:i:s');

        $request->validate([
            'startingamount' => 'required|numeric|min:0',
        ]);

        // Get the authenticated user's company
        $companyId = Auth::user()->company_id;

        // Update the starting amount for the company
        $company = Companyaccount::where('company_id', $companyId)->first();
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        $company->amount = $request->startingamount;
        $company->save();

        $pnl = new Pnl();
        $pnl->description = 'Starting Amount';
        $pnl->credit = $request->startingamount;
        $pnl->debit = 0;
        $pnl->date_time = $datetime;
        $pnl->balance = $request->startingamount;
        $pnl->company_id = $companyid;
        $pnl->type = 'Starting';

        $pnl->save();

        // Return success response
        return response()->json(['success' => 'Starting amount updated successfully.']);
    }


    public function updatedepositamount(Request $request)
    {
        // Validate the incoming request
        $date = Carbon::now()->format('Y-m-d');
        $month = Carbon::now()->format('Y-m');
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;
        $datetime = Carbon::now()->format('Y-m-d H:i:s');

        $request->validate([
            'depositamount' => 'required|numeric|min:0',
        ]);

        // Get the authenticated user's company
        $companyId = Auth::user()->company_id;

        // Update the starting amount for the company
        $companyAccountmain = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
        $companyAccountmain->amount = $companyAccountmain->amount + $request->depositamount;
        $companyAccountmain->save();

        $lastBalance = Pnl::where('company_id', $companyid)
            ->orderBy('id', 'desc')
            ->value('balance');

        $newbalance = $lastBalance + ($request->depositamount);

        // add pnl save
        $pnlfirstpayment = new Pnl();
        $pnlfirstpayment->description = 'Diposit | - ' . $request->deposit_description;
        $pnlfirstpayment->credit = $request->depositamount;
        $pnlfirstpayment->debit = 0;
        $pnlfirstpayment->date_time = $datetime;
        $pnlfirstpayment->balance = $newbalance;
        $pnlfirstpayment->company_id = $companyid;
        $pnlfirstpayment->type = 'Diposit';

        $pnlfirstpayment->save();

        // Return success response
        return response()->json(['success' => 'Deposit Payment updated successfully.']);
    }

    public function updatewithdrawamount(Request $request)
    {
        // Validate the incoming request
        $date = Carbon::now()->format('Y-m-d');
        $month = Carbon::now()->format('Y-m');
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;
        $datetime = Carbon::now()->format('Y-m-d H:i:s');

        $request->validate([
            'withdrawelamount' => 'required|numeric|min:0',
        ]);

        // Get the authenticated user's company
        $companyId = Auth::user()->company_id;

        // Update the starting amount for the company
        $companyAccountmain = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
        $companyAccountmain->amount = $companyAccountmain->amount + $request->withdrawelamount;
        $companyAccountmain->save();

        $lastBalance = Pnl::where('company_id', $companyid)
            ->orderBy('id', 'desc')
            ->value('balance');

        $newbalance = $lastBalance - ($request->withdrawelamount);

        // add pnl save
        $pnlfirstpayment = new Pnl();
        $pnlfirstpayment->description = 'Withdraw | - ' . $request->withdrawelamount;
        $pnlfirstpayment->credit = 0;
        $pnlfirstpayment->debit = $request->depositamount;
        $pnlfirstpayment->date_time = $datetime;
        $pnlfirstpayment->balance = $newbalance;
        $pnlfirstpayment->company_id = $companyid;
        $pnlfirstpayment->type = 'Withdraw';

        $pnlfirstpayment->save();

        // Return success response
        return response()->json(['success' => 'Withdraw Payment updated successfully.']);
    }


    public function updatedonations(Request $request)
    {
        // Validate the incoming request
        $date = Carbon::now()->format('Y-m-d');
        $month = Carbon::now()->format('Y-m');
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;
        $datetime = Carbon::now()->format('Y-m-d H:i:s');

        $request->validate([
            'donateamount' => 'required|numeric|min:0',
        ]);

        // Get the authenticated user's company
        $companyId = Auth::user()->company_id;

        // Update the starting amount for the company
        $companyAccountmain = Companyaccount::where('company_id', $companyid)->where('account_type', 'main')->first();
        $companyAccountmain->amount = $companyAccountmain->amount + $request->donateamount;
        $companyAccountmain->save();

        $expense_type = 'Donation';
        $expenses_amount = $request->donateamount;
        $expensesdate = $datetime;
        $reference = 'Company';
        $note = $request->donation_description;

        $expense = new Expenses();

        $expense->expenses_type = $expense_type;
        $expense->amount = $expenses_amount;
        $expense->company_id = $companyid = Auth::user()->company_id;
        $expense->date_time = $expensesdate;
        $expense->reference = $reference;
        $expense->description = 'Donation | ' . $note;

        $expense->save();

        $lastBalance = Pnl::where('company_id', $companyid)
            ->orderBy('id', 'desc')
            ->value('balance');

        $newbalance = $lastBalance - ($request->donateamount);

        // add pnl save
        $pnlfirstpayment = new Pnl();
        $pnlfirstpayment->description = 'Donation | - ' . $request->donation_description;
        $pnlfirstpayment->credit = 0;
        $pnlfirstpayment->debit = $request->donateamount;
        $pnlfirstpayment->date_time = $datetime;
        $pnlfirstpayment->balance = $newbalance;
        $pnlfirstpayment->company_id = $companyid;
        $pnlfirstpayment->type = 'Donation';

        $pnlfirstpayment->save();

        // Return success response
        return response()->json(['success' => 'Donation Payment updated successfully.']);
    }

    public function comapnysetting()
    {
        $companyId = Auth::user()->company_id;

        $company = Company::where('id', $companyId)->first();
        $users = User::where('company_id', $companyId)->get();

        // return $company;

        return view('setting.companysetting', compact('company', 'users'));
    }
}
