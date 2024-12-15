<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AttendenceController extends Controller
{
    public function index(){
        // Alert::success('Attendens Loading','Welcome Attendence Dashboard');
        return view('attendence.attendencelist');
    }
}
