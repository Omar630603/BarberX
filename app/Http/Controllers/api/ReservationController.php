<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\Reservation as MailReservation;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'reservation_time' => 'required',
            'services' => 'required',
        ]);
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $request->reservation_time)->format('Y-m-d H:i:s');
        $service_id = $request->services;
        $reservation_code = $this->checkIfAva();
        $total = 0;
        for ($i = 0; $i < count($service_id); $i++) {
            $reservation = new Reservation;
            $customer = User::where('user_id', $request->user_id)->first();
            $reservation->customer()->associate($customer);
            $service = new Service();
            $service->service_id = $service_id[$i];
            $reservation->service()->associate($service);
            $reservation->reservation_time = $date;
            $reservation->reservation_code = $reservation_code;
            $svcprice = Service::where('service_id', $service_id[$i])->first();
            $total += $svcprice->price;
            $reservation->save();
        }
        $reservationStatus = new ReservationStatus();
        $reservationStatus->reservation_code = $reservation_code;
        $reservationStatus->price = $total;
        $reservationStatus->status = 0;
        $reservationStatus->save();

        $reservationStatus = ReservationStatus::all();
        $reservationServices = Reservation::with('service')->get();
        $r = $reservation;
        Mail::to($reservation->customer->email)->send(new MailReservation($r, $reservationServices, $reservationStatus));
    }
    public function checkIfAva()
    {
        $reservations = Reservation::all();
        $reservation_code = "RBX" . "-" . $this->random_strings(8);
        $isAva = True;
        for ($i = 0; $i < count($reservations); $i++) {
            if ($reservations[$i]->reservation_code === $reservation_code) {
                $isAva = False;
            } else {
                $isAva = True;
            }
        }
        if ($isAva) {
            return $reservation_code;
        } else {
            $this->checkIfAva();
        }
        return $reservation_code;
    }
    public function random_strings($length_of_string)
    {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }
}
