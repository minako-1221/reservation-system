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

        return redirect()->route('reservation.complete',['shop_id'=>$shop_id]);
    }

    public function complete($shop_id)
    {
        return view('done',compact('shop_id'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if($reservation){
            $reservation->delete();

            return redirect()->route('mypage');
        }

    }

    public function change($id)
    {
        $reservation = Reservation::with('shop')->findOrFail($id);

        return view('change',compact('reservation'));
    }

    public function update(Request $request,Reservation $reservation)
    {
        $validated = $request->validate([
            'reservation_date' => ['required', 'date', 'after_or_equal:today'],
            'reservation_time' => ['required', 'date_format:H:i'],
            'number_of_people' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $reservationDateTime = \Carbon\Carbon::createFromFormat(
            'Y/m/d H:i',
            $validated['reservation_date'] . ' ' . $validated['reservation_time']
        );

        $reservation->update([
            'reservation_datetime' => $reservationDateTime,
            'number_of_people' => $validated['number_of_people'],
        ]);

        return redirect()->route('reservation.changed',['reservation'=>$reservation->id]);
    }

    public function changeComplete($reservaiton_id)
    {
        return view('change_complete', compact('reservation_id'));
    }
}
