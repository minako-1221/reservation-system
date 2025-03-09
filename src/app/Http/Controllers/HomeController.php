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
        $area = $request->input('area');
        $genre = $request->input('genre');
        $shop_name = $request->input('shop_name');

        $query = Shop::query();

        if ($area) {
            $query->where('area_id', $area);
        }

        if ($genre) {
            $query->where('genre_id', $genre);
        }

        if ($shop_name) {
            $query->where('name', 'like', "%{$shop_name}%");
        }

        $shops = $query->get();

        return view('search', compact('shops'));
    }
}
