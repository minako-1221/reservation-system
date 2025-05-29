<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($reservation_id)
    {
        $reservation = Reservation::with('shop','review')->findOrFail($reservation_id);

        if($reservation->review){
            return redirect()->route('mypage');
        }

        return view('review', compact('reservation'));
    }

    public function store(Request $request,$reservation_id)
    {
        $reservation = Reservation::with('review')->findOrFail($reservation_id);

        if($reservation->review){
            return redirect()->route('mypage');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:200',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'shop_id' => $reservation->shop_id,
            'reservation_id' => $reservation->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('mypage');
    }
}
