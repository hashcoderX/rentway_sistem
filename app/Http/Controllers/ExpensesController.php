<?php

namespace App\Http\Controllers;

use App\Models\Cashflote;
use App\Models\Expenses;
use App\Models\Pnl;
use App\Models\Vehical;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $userid = Auth::user()->id;
            $companyid = Auth::user()->company_id;
            $date = Carbon::now()->format('Y-m-d');

            $myvehicles = Vehical::where('company_id', $companyid)->get();

            $expenseslists = Expenses::where('company_id', $companyid)
                ->orderBy('date_time', 'asc')
                ->get();

            return view('expenses.addexpenses', compact('expenseslists', 'myvehicles'));
        }
    }

    public function addExpenses(Request $request)
    {

        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;
        $datetime = Carbon::now()->format('Y-m-d H:i:s');

        $expense_type = $request->expense_type;
        $expenses_amount = $request->expenses_amount;
        $expensesdate = $request->expensesdate;
        $reference = $request->reference;
        $note = $request->note;

        $expense = new Expenses();

        $expense->expenses_type = $expense_type;
        $expense->amount = $expenses_amount;
        $expense->company_id = $companyid = Auth::user()->company_id;
        $expense->date_time = $expensesdate;
        $expense->reference = $reference;
        $expense->description = $note;

        $expense->save();

        $lastBalance = Pnl::where('company_id', $companyid)
            ->orderBy('id', 'desc')
            ->value('balance');

        $newbalance = $lastBalance - $expenses_amount;

        // add pnl save
        $pnlfirstpayment = new Pnl();
        $pnlfirstpayment->description = $note;
        $pnlfirstpayment->credit = 0;
        $pnlfirstpayment->debit = $expenses_amount;
        $pnlfirstpayment->date_time = $datetime;
        $pnlfirstpayment->balance = $newbalance;
        $pnlfirstpayment->company_id = $companyid;
        $pnlfirstpayment->type = 'Expense';

        $pnlfirstpayment->save();

        if ($expense) {

            $myvehicles = Vehical::where('company_id', $companyid)->get();

            $expenseslists = Expenses::where('company_id', $companyid)
                ->orderBy('date_time', 'desc')
                ->get();

            return view('expenses.addexpenses', compact('expenseslists', 'myvehicles'));
        } else {
        }
    }

    public function viewExpenses()
    {
        $month = Carbon::now()->format('Y-m');
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;

        // Get the start and end of the current month
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        // Query to get expenses within the current month
        $expenses = Expenses::whereBetween('date_time', [$startOfMonth, $endOfMonth])
            ->where('company_id', $companyid)
            ->paginate(10);

        $totalAmount = $expenses->sum('amount');


        return view('expenses.viewexpenses', compact('expenses', 'totalAmount'));
    }

    public function expenseDetail(Request $request)
    {
        $expenceid = $request->expenceid;
        $expencedetails = Expenses::where('id', $expenceid)->first();
        $htmlContent = view('partials.expenseview', compact('expencedetails'))->render();
        return response()->json(['html' => $htmlContent]);
    }

    public function filterExpenses(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $companyid = Auth::user()->company_id;

        $expenses = Expenses::where('company_id', $companyid)
            ->whereBetween('date_time', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])
            ->get();

        $totalAmount = $expenses->sum('amount');

        return response()->json([
            'expenses' => $expenses,
            'total_amount' => $totalAmount
        ]);
    }
}
