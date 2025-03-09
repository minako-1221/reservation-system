<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function show($id)
    {
        $shop = Shop::findOrFail($id);

        return view('shop.show', compact('shop'));
    }
}
