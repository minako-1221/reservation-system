<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Shop;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle($shopId)
    {
        $user = auth()->user();
        $favorite = Favorite::where('user_id', $user->id)->where('shop_id', $shopId)->first();

        if($favorite){
            $favorite->delete();
        }else{
            Favorite::create([
                'user_id' => $user->id,
                'shop_id' => $shopId,
            ]);
        }

        return redirect()->back();
    }

    public function getUserFavorites()
    {
        return auth()->check()
            ? Favorite::where('user_id', auth()->id())->pluck('shop_id')->toArray() : [];
    }
}
