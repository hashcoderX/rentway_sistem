<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    public function regWorker()
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $userid = Auth::user()->id;
            $companyid = Auth::user()->company_id;
            $users = User::where('company_id', $companyid)->get();
            return view('user.createuser', compact('users'));
        }
    }

    public function adsubuser(Request $request)
    {
        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {
            $companyid = Auth::user()->company_id;

            $username = $request->username;
            $email = $request->email;
            $password = $request->password;
            $usertype = $request->usertype;

            $user = new User();

            $user->name = $username;
            $user->email = $email;
            $user->usertype = $usertype;
            $user->password = Hash::make($password);
            $user->company_id = $companyid;

            $user->save();
        }
    }
}
