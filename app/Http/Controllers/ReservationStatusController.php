<?php

namespace App\Http\Controllers;

use App\Models\ReservationStatus;
use Illuminate\Http\Request;

class ReservationStatusController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $reservationStatus = ReservationStatus::search(['reservation_code', 'price'], $search)->get();
        } else {
            $reservationStatus = ReservationStatus::get();;
        }
        return view ('admin.reservationStatusIndex', compact('reservationStatus', $reservationStatus));
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show(ReservationStatus $reservationStatus)
    {
        //
    }

    
    public function edit(ReservationStatus $reservationStatus)
    {
        //
    }

    
    public function update(Request $request, $idrStatus)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $rStatus = ReservationStatus::where('reservation_status_id', $idrStatus)->first();
        $rStatus->status = $request->get('status');
        $rStatus->save();

        return redirect()->route('reservationStatus.index')
            ->with('success', 'Status Successfully Updated');
    }

    
    public function destroy(ReservationStatus $reservationStatus)
    {
        //
    }
}
