<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\ReservationStatus;
use Illuminate\Http\Request;
use PDF;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $reservation = Reservation::with('customer', 'service')->search(['reservation_code', 'reservation_time'], $search)->orderBy('reservation_time', 'desc')->groupBy('reservation_code')->get();
        } else {
            $reservation = Reservation::with('customer', 'service')->groupBy('reservation_code')->orderBy('reservation_time', 'desc')->get();
        }
        $reservationStatus = ReservationStatus::all();
        $reservationServices = Reservation::with('service')->get();
        $service = Service::all();
        return view('admin.reservationIndex', compact('reservation', 'service', 'reservationServices', 'reservationStatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service_id = $request->get('service_id');
        if (empty($service_id)) {
            return redirect()->route('reservation.index')
                ->with('fail', 'Cheack the service');
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]);
            $reservation_code = $this->checkIfAva();
            $customer = new Customer;
            if ($request->file('image')) {
                $image = $request->file('image')->store('images', 'public');
                $customer->image = $image;
            }
            $customer->name = $request->get('name');
            $customer->email = $request->get('email');
            $customer->phone = $request->get('phone');
            $customer->save();
            $total = 0;
            for ($i = 0; $i < count($service_id); $i++) {
                $reservation = new Reservation;
                $reservation->customer()->associate($customer);
                $service = new Service;
                $service->service_id = $service_id[$i];
                $reservation->service()->associate($service);

                $reservation->reservation_time = $request->get('reservation_time');
                $reservation->reservation_code = $reservation_code;
                $svcprice = Service::where('service_id', $service_id[$i])->first();
                $total += $svcprice->price;
                $reservation->save();
            }

            $reservationStatus = new ReservationStatus;
            $reservationStatus->reservation_code = $reservation_code;
            $reservationStatus->price = $total;
            $reservationStatus->status = 0;
            $reservationStatus->save();


            return redirect()->route('reservation.index')
                ->with('success', 'New Reservation Added Succesfully');
        }
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
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $reservationCustomer = Reservation::with('customer')->where('reservation_code', $reservation->reservation_code)->first();
        $reservationServices = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('service_id');
        $reservationServices = json_decode(json_encode($reservationServices), true);
        $reservation = Reservation::where('reservation_code', $reservation->reservation_code)->get();
        $services = Service::all();
        return view('admin.reservationEdit', ['reservation' => $reservation, 'services' => $services, 'reservationServices' => $reservationServices, 'reservationCustomer' => $reservationCustomer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservationServices = Reservation::where('reservation_code', $reservation->reservation_code)->pluck('service_id');
        $reservationServicesArray = json_decode(json_encode($reservationServices), true);
        $service_id = $request->get('service_id');
        if (empty($service_id)) {
            return redirect()->route('reservation.edit', $reservation)->with('fail', 'Nothing to Change');
        } else {
            $resultToDelete = array_diff($reservationServicesArray, $service_id);
            $resultToAdd = array_diff($service_id, $reservationServicesArray);
            if (!empty($resultToDelete)) {
                foreach ($resultToDelete as $key) {
                    $reservationsToDelete = Reservation::where('reservation_code', $reservation->reservation_code)->where('service_id', $key)->first();
                    $reservationsToDelete->delete();
                }
            }
            $total = 0;
            $reservationCustomer = Reservation::with('customer')->where('reservation_code', $reservation->reservation_code)->first();
            if (!empty($resultToAdd)) {
                foreach ($resultToAdd as $key) {
                    $reservation = new Reservation;
                    $reservation->customer()->associate($reservationCustomer->customer);
                    $service = new Service;
                    $service->service_id = $key;
                    $reservation->service()->associate($service);
                    $reservation->reservation_time = $reservationCustomer->reservation_time;
                    $reservation->reservation_code = $reservationCustomer->reservation_code;
                    $svcprice = Service::where('service_id', $key)->first();
                    $total += $svcprice->price;
                    $reservation->save();
                }
            }
            $reservationStatus = ReservationStatus::where('reservation_code', $reservation->reservation_code)->first();
            if ($reservationStatus) {
                $reservationStatus->price = $reservationStatus->price + $total;
                $reservationStatus->save();
            } else {
                $totalNew = 0;
                foreach ($service_id as $key) {
                    $svcprice = Service::where('service_id', $key)->first();
                    $totalNew += $svcprice->price;
                }
                $reservationStatus = new ReservationStatus;
                $reservationStatus->reservation_code = $reservationCustomer->reservation_code;
                $reservationStatus->price = $totalNew;
                $reservationStatus->status = 0;
                $reservationStatus->save();
            }
            if ($request->get('reservation_time')) {
                $reservations = Reservation::where('reservation_code', $reservation->reservation_code)->get();
                echo $reservations;
                foreach ($reservations as $key) {
                    $key->reservation_time = $request->get('reservation_time');
                    $key->save();
                }
            } else {
                return redirect()->route('reservation.edit', $reservation)->with('info', 'Cheack Reservation Time');
            }
            return redirect()->route('reservation.edit', $reservation)->with('success', 'Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservations = Reservation::where('reservation_code', $reservation->reservation_code)->get();
        foreach ($reservations as $r) {
            $r->delete();
        }
        return redirect()->route('reservation.index')
            ->with('success', 'Reservation seccesfully Deleted');
    }

    public function printReservationPDF(Reservation $reservation)
    {
        $reservationStatus = ReservationStatus::all();
        $reservationServices = Reservation::with('service')->get();
        $pdf = PDF::loadview('admin.printReservationPDF', ['r' => $reservation, 'reservationStatus' => $reservationStatus, 'reservationServices' => $reservationServices]);
        return $pdf->stream();
    }
}
