<?php

namespace App\Http\Controllers;

use App\Models\Billalignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    //
    public function index()
    {

        $userid = Auth::user()->id;
        $companyid = Auth::user()->company_id;

        $variables = Billalignment::where('company_id', $companyid)->get();
        return view('setting.managevariable', compact('variables'));
    }

    public function updateVariablevisibility(Request $request)
    {
        $variableid = $request->variableid;
        $value = $request->value;

        $variables = Billalignment::where('id', $variableid)->first();
        $variables->display = $value;

        $variables->save();

        return redirect()->back();
    }
}
