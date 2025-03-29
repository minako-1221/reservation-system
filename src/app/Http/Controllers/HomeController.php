<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\Favorite;

class HomeController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();

        $favoriteShops = Auth::check()
            ? Favorite::where('user_id', Auth::id())->pluck('shop_id')->toArray() : [];

        return view('index', compact('areas', 'genres', 'shops', 'favoriteShops'));
    }

    public function search(Request $request)
    {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::query();

        if ($request->area) {
        $shops->where('area_id', $request->area);
        }

        if ($request->genre) {
        $shops->where('genre_id', $request->genre);
        }

        if ($request->keyword) {
        $shops->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        $shops = $shops->get();

        return view('index', compact('areas','genres','shops'));
    }
}
