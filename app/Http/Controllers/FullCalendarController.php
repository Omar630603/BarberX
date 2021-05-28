<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use Carbon\Carbon;

class FullCalendarController extends Controller
{
    public function index(Request $request)
    {

        $date = $request->tanggal;
        if($date){
        $reservation = Reservation::with('reservationStatus')->search(['reservation_time'], $date)->get();
        $selectDate = $date;
        }
        else{

            $today = Carbon::now()->toDateString();
            $reservation = Reservation::with('reservationStatus')->search(['reservation_time'], $today)->get();
            $selectDate = $today;
        }
        return view('admin.calendarIndex', compact('reservation', 'selectDate'));
        
    }
}
