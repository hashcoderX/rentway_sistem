<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Pnl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PnlController extends Controller
{
    public function viewPnl()
    {
        $month = Carbon::now()->format('Y-m');
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;

        $totalincome = 0;

        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $expenses = Expenses::whereBetween('date_time', [$startOfMonth, $endOfMonth])
            ->where('company_id', $companyid)
            ->paginate(10);

        $income = Pnl::whereBetween('date_time', [$startOfMonth, $endOfMonth])
            ->where('company_id', $companyid)
            ->where('type', 'Income')
            ->paginate(10);

        $totalAmount = $expenses->sum('amount');
        $totalincome = $income->sum('credit');

        return view('reports.pnl', compact('expenses', 'totalAmount', 'totalincome', 'startOfMonth', 'endOfMonth'));
    }

    public function filterPnl(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $companyid = Auth::user()->company_id;

        $expenses = Expenses::where('company_id', $companyid)
            ->whereBetween('date_time', [$startDate . ' 00:00:00',  $endDate . ' 23:59:59'])
            ->get();

        $income = Pnl::where('company_id', $companyid)
            ->whereBetween('date_time', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();

        $totalAmount = Expenses::where('company_id', $companyid)
            ->whereBetween('date_time', [$startDate, $endDate])
            ->sum('amount');

        $totalincome = $income->sum('credit');

        return response()->json([
            'expenses' => $expenses,
            'total_amount' => $totalAmount,
            'total_income' => $totalincome
        ]);
    }

    public function viewBalanceSheet()
    {

        $month = Carbon::now()->format('Y-m');
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;

        $totalincome = 0;

        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $pnls = Pnl::where('company_id', $companyid)
            ->whereBetween('date_time', [$startOfMonth, $endOfMonth])
            ->get();

        return view('reports.balancesheet', compact('pnls', 'startOfMonth', 'endOfMonth'));
    }

    public function filterBalanceSheet(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $companyid = Auth::user()->company_id;

        $pnls = Pnl::where('company_id', $companyid)
            ->whereBetween('date_time', [$startDate . ' 00:00:00',  $endDate . ' 23:59:59'])
            ->get();

        return response()->json([
            'pnls' => $pnls,
        ]);
    }
}
