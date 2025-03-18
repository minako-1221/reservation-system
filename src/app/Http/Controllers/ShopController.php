<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    public function show($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);

        $reservations = Reservation::where('user_id', Auth::id())
            ->where('shop_id', $shop_id)
            ->where('reservation_datetime','>=',Carbon::today())
            ->orderBy('reservation_datetime','asc')
            ->get();

        return view('detail', compact('shop','reservations'));
    }
}
