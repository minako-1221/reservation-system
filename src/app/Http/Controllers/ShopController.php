<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        $reservation = Reservation::where('shop_id', $id)->first();

        return view('detail', compact('shop','reservation'));
    }
}
