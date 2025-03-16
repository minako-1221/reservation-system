<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request,$shop_id)
    {
        $reservation_datetime = Reservation::formatReservationDateTime(
            $request->reservation_date,
            $request->reservation_time
        );

        Reservation::create([
            'user_id' => Auth::id(),
            'shop_id' => $shop_id,
            'reservation_datetime' => $reservation_datetime,
            'number_of_people' => $request->number_of_people,
        ]);

        return redirect()->route('reservation.complete');
    }

    public function complete()
    {
        return view('done');
    }
}
