<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Vehical;
use App\Models\Vehicle_has_booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index()
    {

        if (!Auth::check() || Auth::user()->id == '') {
            return view('index');
        } else {


            $date = Carbon::now()->format('Y-m-d');
            $userid = Auth::user()->id;
            $companyid = Auth::user()->company_id;


            $notifications = Notification::where(function ($query) use ($date, $companyid) {
                $query->where('notifiaction_date_start', '<=', $date)
                    ->where('notification_date_end', '>=', $date)
                    ->where('company_id', $companyid);
            })->get();

            $vehicleLists = Vehical::where('company_id', $companyid)->get();

            // pending Bookings
            $bookings = Vehicle_has_booking::join('customers', 'vehicle_has_bookings.customer_id', '=', 'customers.id')
                ->where('vehicle_has_bookings.company_id', $companyid)
                ->where('vehicle_has_bookings.status', 'pending')
                ->select('vehicle_has_bookings.*', 'customers.full_name', 'customers.telephone_no')->get();
            // End
            $issuedbookings = Vehicle_has_booking::join('customers', 'vehicle_has_bookings.customer_id', '=', 'customers.id')
                ->where('vehicle_has_bookings.company_id', $companyid)
                ->where('vehicle_has_bookings.status', 'Invoice Request')
                ->select('vehicle_has_bookings.*', 'customers.full_name', 'customers.telephone_no')->get();

            return view('notification.notification', compact('notifications'));
        }
    }

    public function removeNotification(Request $request)
    {
        echo $date = Carbon::now()->format('Y-m-d');
        $notificationid = $request->notificationid;

        $lxnoti = Carbon::parse($date)->addDays(2);
        $notificationStartDay = $lxnoti->format('Y-m-d');

        echo $notificationStartDay;

        $notification = Notification::where('id', $notificationid)->first();
        $notification->notifiaction_date_start =  $notificationStartDay;
        $notification->save();
    }

    public function getnotificationdetails(Request $request)
    {
        $notificationid = $request->notificationid;
        $notification = Notification::where('id', $notificationid)->first();

        $htmlContent = view('partials.notificationview', compact('notification'))->render();
        return response()->json(['html' => $htmlContent]);
    }
}
