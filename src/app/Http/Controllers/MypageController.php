<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Reservation;
use Carbon\Carbon;

class MypageController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $user_name = $user->name;
        $today = now()->startOfDay();
        $shop=Shop::first();

        $favoriteShops = Shop::with(['area', 'genre'])
            ->whereIn('id', function ($query) use ($user) {
                $query->select('shop_id')
                    ->from('favorites')
                    ->where('user_id', $user->id);
            })
            ->get();

        $userReservations = Reservation::where('user_id', $user->id)
            ->where('reservation_datetime', '>=', $today)
            ->orderBy('reservation_datetime', 'asc')
            ->with('shop')
            ->get();

        return view('mypage',compact('user_name','userReservations','favoriteShops'));
    }
}
