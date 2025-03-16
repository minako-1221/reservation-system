<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function show($shop_id)
    {
        $shop = Shop::find($shop_id);

        return view('detail', compact('shop'));
    }
}
