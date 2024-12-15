<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function viewpayhistory()
    {
        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;

        $payments = Payment::where('company_id',$companyid)->orderBy('id', 'DESC')->paginate(15);
        return view('payments.paymenthsitory', compact('payments'));
    }
}
