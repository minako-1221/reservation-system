<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;

class HomeController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::all();

        return view('index', compact('areas', 'genres', 'shops'));
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
